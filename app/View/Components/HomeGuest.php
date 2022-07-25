<?php

namespace App\View\Components;

use App\Models\Social;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use JetBrains\PhpStorm\NoReturn;

class HomeGuest extends Component
{
    public ?array $socials = null;

    #[NoReturn]
    public function __construct()
    {
        $this->socials ??= $this->getSocials();
    }

    private function getSocials() : array {
        $result = [];
        $data = Social::all();
        foreach ($data as $item) {
            if (isset($item->name)) {
                arrayList()::addOrSet($result, $item->name, $item->data);
            }
        }
        return $result;
    }

    public function render(): View|Factory|Htmlable|\Closure|string|Application
    {
        return view('layouts.home-guest');
    }
}
