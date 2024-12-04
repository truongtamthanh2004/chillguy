<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetInTouchController;
use App\Models\GetInTouch;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/submit-contact', [GetInTouchController::class, 'submitContact'])
    ->name('submit.contact')
    ->middleware(['web']);
Route::get('/', function () {
        return view('home');
    })->name('home');
