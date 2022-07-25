<?php

namespace App\Http\Livewire;

use App\Models\ContactUs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ContactUsControl extends Component
{

    public $indexBeingDeleted;

    public $idBeingDeleted;

    public $customersMessages;

    public $confirmingDelete = false;

    public function confirmingDelete($index)
    {
        $this->indexBeingDeleted = $index;
        $this->idBeingDeleted = $this->customersMessages[$index];
        $this->confirmingDelete = true;
    }

    public function deleteMessage()
    {
        if (optional(ContactUs::query()->firstWhere('id', $this->idBeingDeleted))->delete()) {

            unset($this->customersMessages[$this->indexBeingDeleted]);
            $this->customersMessages = arrayList()::reIndex($this->customersMessages);
            $this->idBeingDeleted = null;
            $this->confirmingDelete = false;
        }
    }

    public function mount()
    {
        $this->customersMessages = ContactUs::all()->toArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.contact-us-control');
    }
}
