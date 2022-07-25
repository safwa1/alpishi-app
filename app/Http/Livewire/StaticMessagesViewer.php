<?php

namespace App\Http\Livewire;

use App\Models\StaticMessages;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class StaticMessagesViewer extends Component
{
    public array $messages = [];

    private function loadMessages(): array
    {
        return StaticMessages::all()->toArray();
    }

    public function mount() {
        $this->messages = $this->loadMessages();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.static-messages.viewer');
    }

}
