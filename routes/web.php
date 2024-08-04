<?php

use App\Http\Controllers\BlankoController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'blanko'], function(){
    Route::get('/', [BlankoController::class, 'index'])->name('blanko.index');
    Route::get('/create', [BlankoController::class, 'create'])->name('blanko.create');
    Route::post('/store', [BlankoController::class, 'store'])->name('blanko.store');
    Route::get('/edit/{id}', [BlankoController::class, 'edit'])->name('blanko.edit');
    Route::post('/update/{id}', [BlankoController::class, 'update'])->name('blanko.update');
    Route::get('/delete/{id}', [BlankoController::class, 'delete'])->name('blanko.delete');

    Route::get('/{id}', [BlankoController::class, 'show'])->name('blanko.show');

});

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/about', function () {
//     return view('about');
// });
