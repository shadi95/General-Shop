<?php

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataImportController;
use App\Models\City;
use App\Models\Country;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
