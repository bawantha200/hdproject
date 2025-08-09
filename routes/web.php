<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\customer\ProviderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard/admin', function () {
    return view('dashboard');
});
Route::get('/dashboard/customer', function () {
    return view('customer.dashboard');
});

// Route::get('/dashboard', function () {
//     return view('customer.dashboard');
// })->middleware(['auth', 'verified','role:provider|renter']);

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth', 'verified','role:admin|manager']);

Route::get('/', function () {
    $sliders = Slider::all();
    $users = User::all();
    return view('frontend.home',compact('sliders','users'));
});

Route::get('/gallery', function () {
    $galleries = Gallery::all();
        return view('frontend.gallery',compact('galleries'));
});

Route::get('/vehicle', function () {
    $vehicles = Vehicle::paginate(12);
    $categories = Category::all();
    $statuses = Vehicle::query('status');
    $search = Vehicle::when('search');

    return view('frontend.vehicle',['vehicles'=>$vehicles,'categories'=>$categories,'statuses'=>$statuses,'search'=>$search]);
});


Route::get('/showVehicle', function () {
    $vehicles = Vehicle::paginate(12);
    $types = Vehicle::query('type');
    $statuses = Vehicle::query('status');


    return view('frontend.showVehicle',['vehicles'=>$vehicles,'types'=>$types,'statuses'=>$statuses]);
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


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Profile routes
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profileIndex', [ProfileController::class, 'index'])->name('index');
    Route::put('/profileUpdate', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});


Route::middleware(['auth', 'verified','role:admin|manager'])->group(function () {
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

Route::middleware(['auth', 'verified','role:admin|manager'])->group(function () {
 
        Route::get('/CategoryIndex', [CategoryController::class, 'Index'])->name('category.index'); 
        Route::post('/saveCategory', [CategoryController::class, 'storeCategory'])->name('category.store');
        Route::post('/updateCategory', [CategoryController::class, 'updateCategory'])->name('category.update');
        Route::get('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
});

// 'role:admin'
// Route::get('/profile', function () {
//     return view('profile');
// })->middleware(['auth'])->name('profile');

// Laravel Breeze/Fortify already provides these:
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


// Route::get('/vehicles', function () {
//     return view('customer.vehicles');
// });


// Route::middleware(['auth'])->group(function () {
//     Route::resource('vehicles', VehicleController::class);
// });

// OR if you're using resource routes (recommended for full CRUD)
// Route::resource('vehicles', VehicleController::class)->names([
//     'index' => 'customer.vehicles',
// ]);

// Remove or update this if it exists
// Route::get('/vehicles', [VehicleController::class, 'index']);

// // Keep these
// Route::get('/vehicles/create', [VehicleController::class, 'create']);
// Route::post('/vehicles', [VehicleController::class, 'store']);
Route::get('/homeIndex', [VehicleController::class, 'homeIndex'])->name('vehicle.home');

Route::middleware(['auth', 'verified'])->group(function () {


        
        Route::get('/myVehicles', [VehicleController::class, 'myVehicles'])->name('vehicles.my');
        Route::get('/vehicleIndex', [VehicleController::class, 'index'])->name('vehicle.index'); 
        Route::post('/storeVehicle', [VehicleController::class, 'storeVehicle'])->name('vehicle.store');
        Route::post('/updateVehicle', [VehicleController::class, 'updateVehicle'])->name('vehicle.update');
        Route::get('/deleteVehicle/{id}', [VehicleController::class, 'deleteVehicle'])->name('vehicle.delete');
});

Route::middleware(['auth', 'verified','role:admin|manager'])->group(function () {

        Route::get('/customer', [UserController::class, 'indexCustomer'])->name('customer.index'); 
});


require __DIR__.'/auth.php';

