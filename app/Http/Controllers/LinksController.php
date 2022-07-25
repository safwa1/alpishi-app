<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    // index
    public function index()
    {
        return view('control-panel.links.index');
    }
}
