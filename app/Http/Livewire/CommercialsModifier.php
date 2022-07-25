<?php

namespace App\Http\Livewire;

use App\Models\Commercial;
use App\Services\MediaService;
use App\Utils\ArrayList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CommercialsModifier extends Component
{
    public $deletedCommercial;

    public $commercialIndexBeingDeleted;

    public $commercialIndexBeingUpdated = null;

    public bool $confirmingCommercialDeletion = false;

    public array $commercials = [];

    // show car deletion dialog and set index of car to being deleted
    public function confirmingCommercialDeletion($index): void
    {
        $this->confirmingCommercialDeletion = true;
        $this->commercialIndexBeingDeleted = $index;
    }

    // remove deleted car from cars array by index
    private function removeCurrentCommercial(): void
    {
        unset($this->commercials[$this->commercialIndexBeingDeleted]);
    }

    public function idBeingDeleted()
    {
        return $this->commercials[$this->commercialIndexBeingDeleted]['id'];
    }

    public function changeCommercialState($index): void
    {
        $commercial = $this->commercials[$index] ?? NULL;
        $commercial['sold'] = $commercial['sold'] == 0;
        if (!is_null($commercial)) {
            optional(Commercial::query()->find($commercial['id']))->update($commercial);
        }
        $this->commercials[$index] = $commercial;
    }


    public function deleteCommercial()
    {
        // get commercial to delete it
        $commercial = Commercial::with('mediable')
            ->where('id', $this->idBeingDeleted())
            ->first();

        // try to delete car
        if ($commercial->delete()) {

            // hide deletion model
            $this->confirmingCommercialDeletion = false;

            // save last removed item (use it in the future to undo delete)
            $this->deletedCommercial = $this->commercials[$this->commercialIndexBeingDeleted];

            // remove deleted commercial from array
            $this->removeCurrentCommercial();

            // get all media of deleted commercial
            $mediables = $commercial->mediable;

            foreach($mediables as $media) {
                $path = $media->path;
                // delete image
                if ($media->delete()) {
                    // delete file from storage folder
                    MediaService::delete($path);
                }
            }

            $this->commercials = ArrayList::reIndex($this->commercials);
        }
    }

    public function fetchCommercialsAsArray(): array
    {
        return Commercial::with('car', 'car.mediable', 'mediable')->get()->toArray();
    }

    public function mount()
    {
        $this->commercials = $this->fetchCommercialsAsArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.commercials-modifier');
    }
}
