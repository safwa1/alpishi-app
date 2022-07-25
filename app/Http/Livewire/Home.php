<?php

namespace App\Http\Livewire;

use App\Models\Commercial;
use App\Models\Social;
use App\View\Components\HomeGuest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Home extends Component
{
    public $allCommercials = [];
    public $latestCommercials = [];
    public ?string $phoneNumber = null;

    public function mount()
    {
        $this->latestCommercials = Commercial::with('car', 'car.mediable')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $this->phoneNumber ??= Social::getPhoneNumber();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.home')->layout(HomeGuest::class);
    }
}
