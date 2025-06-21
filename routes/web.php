<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard/admin', function () {
    return view('admin.dashboard');
});

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/gallery', function () {
    return view('frontend.gallery');
});

Route::get('/vehicle', function () {
    return view('frontend.vehicle');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::controller(SliderController::class)->middleware(['auth','verified'])->group(function(){
//     Route::get('/SliderIndex',[SliderController::class, 'Index'])->name('slider.index');
// }); 





use App\Http\Controllers\admin\SliderController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Prefix URL with '/slider' and route names with 'slider.'
 
        Route::get('/SliderIndex', [SliderController::class, 'Index'])->name('index'); // URL: /slider/index
        Route::post('/saveslider', [SliderController::class, 'storeslider'])->name('slider.store');
});



require __DIR__.'/auth.php';

