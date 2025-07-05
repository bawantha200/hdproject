<?php
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;
use App\Models\Gallery;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard/admin', function () {
    return view('admin.dashboard');
});

Route::get('/', function () {
    $sliders = Slider::all();

    return view('frontend.home',compact('sliders'));
});

Route::get('/gallery', function () {
    $galleries = Gallery::all();
        return view('frontend.gallery',compact('galleries'));
});

// Route::get('/gallery', function () {
//     return view('frontend.gallery');
// });

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


Route::middleware(['auth', 'verified'])->group(function () {
    // Prefix URL with '/slider' and route names with 'slider.'
 
        Route::get('/SliderIndex', [SliderController::class, 'Index'])->name('index'); // URL: /slider/index
        Route::post('/saveSlider', [SliderController::class, 'storeslider'])->name('slider.store');
        Route::post('/sliderUpdate', [SliderController::class, 'updateslider'])->name('slider.update');
        Route::get('/deleteSlider/{id}', [SliderController::class, 'deleteslider'])->name('slider.delete');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Prefix URL with '/gallery' and route names with 'gallery.'
 
        Route::get('/GalleryIndex', [GalleryController::class, 'Index'])->name('index'); // URL: /slider/index
        Route::post('/saveGallery', [GalleryController::class, 'storegallery'])->name('gallery.store');
        Route::post('/galleryUpdate', [GalleryController::class, 'updategallery'])->name('gallery.update');
        Route::get('/deleteGallery/{id}', [GalleryController::class, 'deletegallery'])->name('gallery.delete');
});


Route::middleware(['auth', 'verified'])->group(function () {
    // Prefix URL with '/gallery' and route names with 'gallery.'
 
        Route::get('/permissionIndex', [PermissionController::class, 'index'])->name('index'); // URL: /slider/index
        Route::post('/savePermission', [PermissionController::class, 'storePermission'])->name('permission.store');
        Route::post('/updatePermission', [PermissionController::class, 'updatePermission'])->name('permission.update');
        Route::get('/deletePermission/{id}', [PermissionController::class, 'deletePermission'])->name('permission.delete');
});




require __DIR__.'/auth.php';

