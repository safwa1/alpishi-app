<?php

namespace App\Http\Livewire\Commercials;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ImagesBrowser extends Component
{
    public $commercialId;


    public function render(): Factory|View|Application
    {
        return view('livewire.commercials.images-browser');
    }
}
