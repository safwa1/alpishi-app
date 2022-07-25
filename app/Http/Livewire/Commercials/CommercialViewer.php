<?php

namespace App\Http\Livewire\Commercials;

use App\Models\Commercial;
use App\Utils\Hashed;
use App\Utils\MediableArrayHelper;
use App\View\Components\HomeGuest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CommercialViewer extends Component
{
    public $commercialId;
    public $commercial;
    public array $commercialMedia = [];
    public array $currentMedia = [];
    public $currentMediaIndex = 0;

    public $whatsappUrl = "https://wa.me/+966562100009?text=https://albishi9.com/view/commercial/";

    public function changeCurrentMedia($index)
    {
        $this->currentMediaIndex = $index;
        $this->currentMedia = $this->commercialMedia[$index];
    }

    public function previous()
    {
        $this->currentMedia = MediableArrayHelper::previous($this->commercialMedia, $this->currentMediaIndex);
    }

    public function next() {
        $this->currentMedia = MediableArrayHelper::next($this->commercialMedia, $this->currentMediaIndex);
    }

    public function mount($id)
    {
        $this->whatsappUrl .= $id;
        $this->commercialId = is_numeric($id) ? $id : Hashed::new()->decode($id);
        $this->commercial = Commercial::with('car', 'car.mediable', 'mediable')
            ->firstWhere('id', $this->commercialId);
        $this->commercialMedia = $this->commercial->toArray()['mediable'];
        $this->currentMedia = $this->commercialMedia[0];
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.commercials.commercial-viewer')
            ->layout(HomeGuest::class);
    }
}
