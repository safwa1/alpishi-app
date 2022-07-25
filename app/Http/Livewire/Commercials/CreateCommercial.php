<?php

namespace App\Http\Livewire\Commercials;

use App\Models\Car;
use App\Models\Commercial;
use App\Models\Media;
use App\Services\MediaService;
use App\Utils\FileUtil;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCommercial extends Component
{
    use WithFileUploads;

    public $mode;

    public $commercialId;

    public $route;

    public array $cars = [];

    public mixed $commercialMediables = null;

    public mixed $commercialMediablesForUploading = null;

    public array $deletedMediables = [];

    public array $selectedCar = [
        'id' => '',
        'brand' => '',
        'model' => '',
        'releaseDate' => '',
        'mediable' => [
            'path' => ''
        ]
    ];

    public array $commercial = [
        'car_id' => '',
        'price' => '',
        'counter' => '',
        'cost' => '',
        'sold' => false,
        'description' => '',
        'location' => ''
    ];

    protected $rules = [
        'commercial.car_id' => 'required|exists:cars,id',
        'commercial.price' => 'required|numeric',
        'commercial.counter' => 'required|string',
        'commercial.cost' => 'required|numeric',
        'commercial.sold' => 'required|boolean',
        'commercial.description' => 'required|string',
        'commercial.location' => 'required|string',
        'commercialMediables' => 'required'
    ];

    protected $validationAttributes = [
        'commercial.car_id' => 'car_id',
        'commercial.price' => 'price',
        'commercial.counter' => 'counter',
        'commercial.cost' => 'cost',
        'commercial.sold' => 'sold',
        'commercial.description' => 'description',
        'commercial.location' => 'location',
    ];

    public function updatedCommercialMediablesForUploading($data)
    {
        foreach ($data as $d) {
            $type = FileUtil::typeOf($d);
            $path = FileUtil::tempUrlOf($d);
            $this->commercialMediables[] = [
                'type' => $type,
                'path' => $path,
                'previewOnly' => true
            ];
        }
    }

    #[NoReturn] public function removeUploadedImage($index): void
    {
        if ($this->mode == 'update') {
            $this->deletedMediables[] = $this->commercialMediables[$index];
        }
        unset($this->commercialMediables[$index]);
        arrayList()::reIndex($this->commercialMediables);
    }

    public function carChanged()
    {
        $selected = arrayList()::first($this->cars, function ($value, $key) {
            return $value['id'] == $this->selectedCar['id'];
        });
        $this->selectedCar = $selected;
    }

    public function modifyCommercial()
    {
        $this->commercial['car_id'] = $this->selectedCar['id'];

        $this->validate();

        match ($this->mode) {
            'create' => $this->createNewCommercial(),
            'update' => $this->updateCommercial(),
        };
    }

    #[NoReturn] public function createNewCommercial(): void
    {
        $createdCommercial = Commercial::create($this->commercial);

        if ($createdCommercial) {

            foreach ($this->commercialMediables as $image) {
                // store image
                $path = $image->store('commercials', 'public');
                $type = FileUtil::typeOf($image);

                // create mediable of created commercial
                $media = $createdCommercial->mediable()->create([
                    'type' => $type,
                    'path' => $path
                ]);
            }
        }

        redirect($this->route);
    }

    public function updateCommercial()
    {
        $commercialForUpdate = Commercial::query()->firstWhere('id', $this->commercial['id']);

        if (optional($commercialForUpdate)->update($this->commercial)) {

            // check if uer delete any image of old
            if (count($this->deletedMediables) != 0) {
                // delete db records
                foreach ($this->deletedMediables as $media) {
                    $id = $media['id'];

                    // delete files
                    if (Media::query()->where('id', $id)->delete()) {
                        MediaService::delete($media['path']);
                    }
                }
            }

            // update mediable if it has new
            if (isset($this->commercialMediablesForUploading) && !empty($this->commercialMediablesForUploading)) {

                foreach ($this->commercialMediablesForUploading as $image) {
                    // store image
                    $path = $image->store('commercials', 'public');
                    $type = FileUtil::typeOf($image);

                    // create mediable of created commercial
                    $media = $commercialForUpdate->mediable()->create([
                        'type' => $type,
                        'path' => $path
                    ]);
                }
            }
        }

        redirect($this->route);
    }

    public function mount($mode, $id)
    {
        $this->route = url()->previous();

        $this->mode = $mode;
        $this->commercialId = $id;

        $this->cars = Car::with('mediable')->get()->toArray();

        if ($this->mode == 'create') {
            if (!empty($this->cars)) {
                $this->selectedCar = $this->cars[0];
            }
        }

        if ($this->mode == 'update') {
            $data = Commercial::with('car', 'car.mediable', 'mediable')->firstWhere('id', $this->commercialId);
            $this->commercial = $data->toArray();
            $this->selectedCar = $this->commercial['car'];
            $this->commercialMediables = $this->commercial['mediable'];
            // remove
            unset($this->commercial['car'], $this->commercial['mediable']);
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.commercials.create-commercial');
    }
}
