<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Unitcontroller;
use App\Models\City;
use App\Models\Country;
use App\Models\Role;
use App\Models\State;
use App\Models\Tag;
use GuzzleHttp\Middleware;

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

/*
Route::get('users', function () {
    return User::paginate(10);
});

Route::get('products', function () {
    return Product::with(['images'])->paginate(3);
});

Route::get('images', function () {
    return Image::paginate(10);
});

Route::get('city', function () {
    return State::with(['country', 'cities'])-> paginate(5);    
});

Route::get('tag_test', function () {
    $tag = Tag::find(2);
    return $tag->products;
});

Route::get('role_test', function () {
    $user = User::find(1);
    return $user->roles;
});

//Route::get('units-test', [DataImportController::class, 'importUnits']);

Route::get('test_email', function() {
    return 'Hello';    
})->Middleware(['auth', 'user_is_support']);

Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'user_is_admin'])->group(function () {

    //Units
    Route::get('units',[Unitcontroller::class, 'index'])->name('units');
    
    //Categories 
    Route::get('categories',[CategoryController::class, 'index'])->name('categories');

    //Products 
    Route::get('products',[ProductController::class, 'index'])->name('products');

    //Tags 
    Route::get('tags',[TagController::class, 'index'])->name('tags');

    //Payments 
    Route::get('payments',[PaymentController::class, 'index'])->name('payments');

    //Orders 
    Route::get('orders',[OrderController::class, 'index'])->name('orders');

    //Shipments 
    Route::get('shipments',[ShipmentController::class, 'index'])->name('shipments');

    //Countries 
    Route::get('countries',[CountryController::class, 'index'])->name('countries');

    //Cities 
    Route::get('cities',[CityController::class, 'index'])->name('cities');

    //States 
    Route::get('states',[StateController::class, 'index'])->name('states');

    //Reviews 
    Route::get('reviews',[ReviewController::class, 'index'])->name('reviews');

    //tickets 
    Route::get('tickets',[TicketController::class, 'index'])->name('tickets');

    //Roles
    Route::get('roles',[RoleController::class, 'index'])->name('roles');

});
