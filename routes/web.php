<?php
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;
use App\Models\Gallery;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard/admin', function () {
    return view('dashboard');
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
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    
    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


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

Route::middleware(['auth', 'verified','role:admin|manager'])->group(function () {
    // Prefix URL with '/gallery' and route names with 'gallery.'
 
        Route::get('/GalleryIndex', [GalleryController::class, 'Index'])->name('index'); 
        Route::post('/saveGallery', [GalleryController::class, 'storegallery'])->name('gallery.store');
        Route::post('/galleryUpdate', [GalleryController::class, 'updategallery'])->name('gallery.update');
        Route::get('/deleteGallery/{id}', [GalleryController::class, 'deletegallery'])->name('gallery.delete');
});


Route::middleware(['auth', 'verified','role:admin'])->group(function () {

 
        Route::get('/permissionIndex', [PermissionController::class, 'index'])->name('index'); 
        Route::post('/savePermission', [PermissionController::class, 'storePermission'])->name('permission.store');
        Route::post('/updatePermission', [PermissionController::class, 'updatePermission'])->name('permission.update');
        Route::get('/deletePermission/{id}', [PermissionController::class, 'deletePermission'])->name('permission.delete');
});


Route::middleware(['auth', 'verified','role:admin'])->group(function () {

        Route::get('/roleIndex', [RoleController::class, 'index'])->name('index'); 
        Route::post('/saveRole', [RoleController::class, 'storeRole'])->name('role.store');
        Route::post('/updateRole', [RoleController::class, 'updateRole'])->name('role.update');
        Route::get('/deleteRole/{id}', [RoleController::class, 'deleteRole'])->name('role.delete');
        Route::get('/permissionToRole/{id}', [RoleController::class, 'givePermissionToRole'])->name('role.givePermissionToRole');

        Route::put('/givePermissionToRole/{id}', [RoleController::class, 'giveRoleToPermission'])->name('role.giveRoleToPermission');

});

Route::middleware(['auth', 'verified','role:admin'])->group(function () {

        Route::get('/userIndex', [UserController::class, 'index'])->name('index'); 
        Route::post('/saveUser', [UserController::class, 'storeUser'])->name('user.store');
        Route::post('/updateUser', [UserController::class, 'updateUser'])->name('user.update');
        Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('user.delete');

});

// 'role:admin'


require __DIR__.'/auth.php';

