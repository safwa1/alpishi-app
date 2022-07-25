<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PurchaseMethodsController;
use App\Http\Livewire\Commercials\CommercialsBrowser;
use App\Http\Livewire\Commercials\CommercialViewer;
use App\Http\Livewire\Commercials\CreateCommercial;
use App\Http\Livewire\Home;
use App\Http\Livewire\Public\ContactUsPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ======================================================= //
// ====================== Public Routes ================== //
// ======================================================= //
Route::get('/', Home::class)->name('home');
Route::get('/contactus', ContactUsPage::class)->name('contactus');
Route::get('/commercials', CommercialsBrowser::class)->name('commercials');
Route::get('/view/commercial/{id}', CommercialViewer::class)->name('commercial');
Route::get('/purchase-methods', [PurchaseMethodsController::class, 'index'])->name('purchase-methods');
Route::get('/auction', [AuctionController::class, 'index'])->name('auction');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// ======================================================= //
// ==================== End Public Routes ================ //
// ======================================================= //

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // links
    Route::get('/manage/links', [LinksController::class, 'index'])->name('manage-links');

    // notifications
    Route::get('/manage/notifications', function () {
        return view('control-panel.notifications.index');
    })->name('manage-notifications');

    // cars
    Route::get('/manage/cars', function () {
        return view('control-panel.cars.index');
    })->name('manage-cars');

    // commercials
    Route::get('/manage/commercials', function () {
        return view('control-panel.commercials.index');
    })->name('manage-commercials');

    // modify
    Route::get(
        '/manage/commercials/manage/{mode}/{id}', CreateCommercial::class
    )->name('modify-commercials');

    // reports
    Route::get('/manage/reports', function () {
        return view('control-panel.reports.index');
    })->name('manage-reports');

});
