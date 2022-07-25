<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseMethodsController extends Controller
{
    public function index()
    {
        return view('public.purchase-methods-page');
    }
}
