<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PictureController;
use App\Http\Controllers\Admin\PropertyController;

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

// Définition des regex
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';



Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [App\Http\Controllers\PropertyController::class, 'index'])->name('property.index');
Route::get('/biens/{slug}-{property}', [App\Http\Controllers\PropertyController::class, 'show'])->name('property.show')->where([
    'property' =>$idRegex ,
    'slug' =>  $slugRegex
]);
// Route pour le formulaire de contact
Route::post('/biens/{property}/contact', [App\Http\Controllers\PropertyController::class, 'contact'])->name('property.contact')->where([
    'property' =>$idRegex 
]);

// Les routes pour l'authenfication 
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/images/{path}', [ImageController::class, 'show'])->where('path', '.*');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () use($idRegex) {

    Route::resource('property', PropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);
    Route::delete('picture/{picture}', [PictureController::class, 'destroy'])
    ->name('picture.destroy')
    ->where([
        'picture' => $idRegex,
    ]);
});