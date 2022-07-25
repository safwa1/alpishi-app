<?php

namespace App\Http\Livewire\Commercials;

use App\Models\Commercial;
use App\View\Components\HomeGuest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CommercialsBrowser extends Component
{
    public $allCommercials = [];

    public function mount()
    {
        $this->allCommercials = Commercial::with('car', 'car.mediable')->orderBy('created_at', 'desc')->get();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.commercials.commercials-browser')->layout(HomeGuest::class);
    }
}
