<?php

namespace App\Http\Livewire;

use App\Models\Social;
use App\Utils\ArrayList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LinksDataTable extends Component
{
    public $oldLink;

    public $deletedLink;

    public $linkIndexBeingDeleted;

    public $linkIndexBeingUpdated = null;

    public bool $confirmingLinkDeletion = false;

    public array $links = [];

    protected $listeners = [
        'linkDeleted' => 'linkDeleted',
    ];

    protected $rules = [
        'links.*.data' => ['required']
    ];

    protected $validationAttributes = [
        'links.*.data' => 'data'
    ];

    private function cacheCurrentLink(): void
    {
        $this->deletedLink = $this->links[$this->linkIndexBeingDeleted];
    }

    private function removeCurrentLink(): void
    {
        unset($this->links[$this->linkIndexBeingDeleted]);
    }

    private function getCurrentId()
    {
        return $this->links[$this->linkIndexBeingDeleted]['id'];
    }

    public function loadLinks(): array
    {
        return Social::all()->toArray();
    }

    public function editable($index): void
    {
        $this->linkIndexBeingUpdated = $index;
        $this->oldLink = $this->links[$index];
    }

    public function cancelEdit(): void
    {
        $this->links[$this->linkIndexBeingUpdated] = $this->oldLink;
        $this->linkIndexBeingUpdated = null;
        $this->oldLink = null;

    }

    public function confirmingLinkDeletion($index): void
    {
        $this->confirmingLinkDeletion = true;
        $this->linkIndexBeingDeleted = $index;
    }

    public function saveLink($index): void
    {
        $this->validate();
        $link = $this->links[$index] ?? NULL;
        if (!is_null($link)) {
            optional(Social::query()->find($link['id']))->update($link);
        }
        $this->linkIndexBeingUpdated = null;
        $this->oldLink = null;
    }

    public function deleteLink(): void
    {
        // get id of link
        $id = $this->getCurrentId();

        // delete link
        if (Social::query()->where('id', $id)->first()->delete()) {

            // hide deletion model
            $this->confirmingLinkDeletion = false;

            // save last removed item (use it in the future to undo delete)
            $this->cacheCurrentLink();

            // remove deleted link from links array
            $this->removeCurrentLink();

            // emit event
            $this->emit('linkDeleted');
        }
    }

    // event handler
    public function linkDeleted(): void
    {
        // re-index links array after delete element from it
        $this->links = ArrayList::reIndex($this->links);

        // show toast message with undo button
        // ...
    }

    public function mount()
    {
        $this->links = $this->loadLinks();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.links.data-table');
    }
}
