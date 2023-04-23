<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;
use App\Models\ContactForm;
use App\Models\Test;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('contacts', ContactFormController::class);

// Route::get('contacts',[ContactFormControlller::class, 'index'])->name('contacts.index');

Route::prefix('contacts')
->middleware(['auth'])
->controller(ContactFormController::class)
->name('contacts.')
->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/','store')->name('store');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tests/test',[ TestController::class,'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
