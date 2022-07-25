<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\Media;
use App\Services\MediaService;
use App\Utils\ArrayList;
use App\Utils\FileUtil;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarsModifier extends Component
{
    use WithFileUploads;

    public $carModel;

    public $carPhoto;

    public $deletedCar;

    public $carIndexBeingDeleted;

    public $carIndexBeingUpdated = null;

    public bool $confirmingCarDeletion = false;

    public bool $managingCars = false;

    public bool $editMode = false;

    public array $cars = [];

    // events
    protected $listeners = [
        'car:created' => 'carCreated',
        'car:updated' => 'carUpdated',
        'car:deleted' => 'carDeleted',
    ];

    // validation
    protected $validationAttributes = [
        'carModel.brand' => 'brand',
        'carModel.model' => 'model',
        'carModel.releaseDate' => 'releaseDate'
    ];

    // save deleted car to be able restored it
    private function cacheCurrentCar(): void
    {
        $this->deletedCar = $this->cars[$this->carIndexBeingDeleted];
    }

    // remove deleted car from cars array by index
    private function removeCurrentCar(): void
    {
        unset($this->cars[$this->carIndexBeingDeleted]);
    }

    // get id of deletable car by index
    private function getCurrentIdForDelete(): string
    {
        return $this->cars[$this->carIndexBeingDeleted]['id'];
    }

    // get id of updatable car by index
    private function getCurrentIdForUpdate(): string
    {
        return $this->cars[$this->carIndexBeingUpdated]['id'];
    }

    // fetch cars from database as array
    private function fetchCarsAsArray(): array
    {
        return Car::with('mediable')->get()->toArray();
    }

    // show car deletion dialog and set index of car to being deleted
    public function confirmingCarDeletion($index): void
    {
        $this->confirmingCarDeletion = true;
        $this->carIndexBeingDeleted = $index;
    }

    // hide car create/update dialog and reset state
    public function managingCancel()
    {
        $this->managingCars = false;
        $this->carPhoto = null;
        $this->carIndexBeingUpdated = null;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    // show car create/update dialog and set index of car to being deleted
    public function managingCars(int|string|null $index = null): void
    {
        // show dialog
        $this->managingCars = true;

        // set index of car to being updated
        $this->carIndexBeingUpdated = $index;

        // detect mode [create/update]
        $this->editMode = isset($this->carIndexBeingUpdated);

        // check set carModel based on mode [update/create] by update index
        $this->carModel = !$this->editMode
            ? $this->defaultCar()
            : $this->cars[$this->carIndexBeingUpdated];


        // set carPhoto to current car mediable path if mode is update
        if ($this->editMode) {
            $this->carPhoto = Storage::url($this->carModel['mediable']['path']);
        }
    }

    // update of insert car
    public function saveCar()
    {
        $rules = [
            'carModel.brand' => 'required',
            'carModel.releaseDate' => 'required|numeric|min:1900|max:2099',
            'carPhoto' => "required"
        ];

        // only work with insert
        if (!$this->editMode) {
            $rules['carModel.model'] = 'required|unique:cars,model';
            $rules['carPhoto'] = "required|image|mimes:jpg,jpeg,png,svg,gif|max:2048";
        }

        $this->validate($rules);

        if ($this->editMode && isset($this->carIndexBeingUpdated)) {
            $this->updateCar();
            return;
        }
        $this->createCar();
    }

    // update car
    private function updateCar()
    {
        // get current car
        $car = $this->carModel ?? NULL;

        // extract mediable from current car
        $mediable = $car['mediable'];

        // extract current car image path from current car mediable
        $oldPath = $mediable['path'];

        if (!is_null($car)) {

            // remove mediable key from current car array
            if(isset($car['mediable'])) unset($car['mediable']);

            // update car
            if(optional(Car::query()->find($this->getCurrentIdForUpdate()))->update($car)) {

                // check if user update car image
                if(!str($this->carPhoto)->contains($oldPath))
                {
                    // store updated image and get url of it
                    $path = $this->carPhoto->store('cars', 'public');

                    // update filetype in current mediable array
                    $mediable['type'] = FileUtil::typeOf($this->carPhoto);

                    // update file path in current mediable array
                    $mediable['path'] = $path;

                    // save updated mediable of current car
                    if(optional(Media::query()->find($mediable['id']))->update($mediable)) {

                        // delete old image of current car after updated one uploaded & saved.
                        MediaService::delete($oldPath);
                    }
                }
            }
        }

        // put updated mediable again in current car array
        $car['mediable'] = $mediable;

        // replace old current car with updated one in cars array
        $this->cars[$this->carIndexBeingUpdated] = $car;

        // reset carPhoto
        $this->carPhoto = null;

        // hide modifier ui dialog
        $this->managingCars = false;

        // reset index of updatable car
        $this->carIndexBeingUpdated = null;
    }

    // create new car
    private function createCar()
    {
        $createdCar = Car::create($this->carModel);

        if ($createdCar) {

            // store image
            $path = $this->carPhoto->store('cars', 'public');

            // create mediable of created car
            $media = $createdCar->mediable()->create([
                'type' => FileUtil::typeOf($this->carPhoto),
                'path' => $path
            ]);

            // convert car response to array
            $createCarArray = $createdCar->toArray();

            // append mediable array to created car array
            $createCarArray['mediable'] = $media->toArray();

            // push created car to cars array
            $this->cars[] = $createCarArray;
        }

        // reset car image
        $this->carPhoto = null;

        // hide ui dialog
        $this->managingCars = false;
    }

    // delete car from database
    public function deleteCar(): void
    {
        // get car to delete it
        $car = Car::query()
            ->where('id', $this->getCurrentIdForDelete())
            ->first();

        // try to delete car
        if ($car->delete()) {

            // hide deletion model
            $this->confirmingCarDeletion = false;

            // save last removed item (use it in the future to undo delete)
            $this->cacheCurrentCar();

            // remove deleted car from cars array
            $this->removeCurrentCar();

            // grep image local path
            $path = $car->mediable->path;

            // delete image
            if ($car->mediable->delete()) {
                // delete file from storage folder
                MediaService::delete($path);
            }

            // emit event
            $this->emit('car:deleted');
        }
    }

    public function carDeleted(): void
    {
        // re-index cars array after delete element from it
        $this->cars = ArrayList::reIndex($this->cars);


        // show toast message with undo button
        // ...
    }

    public function mount()
    {
        $this->cars = $this->fetchCarsAsArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.cars-modifier');
    }

    #[ArrayShape(['id' => "string", 'brand' => "string", 'model' => "string", 'releaseDate' => "string"])]
    private function defaultCar(): array
    {
        return [
            'id' => '',
            'brand' => '',
            'model' => '',
            'releaseDate' => '',
        ];
    }

}
