<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenerateQrCodeController;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
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

Route::get('/', [GenerateQrCodeController::class,'index'])->name('index');


Route::get('/lang/{lang}',  [LangController::class, 'change'])->name('change.lang');

Route::get('/view/{uuid}', [GenerateQrCodeController::class, 'view']);
Route::get('/show', [GenerateQrCodeController::class, 'show']);
Route::get('/show/{uuid}', [GenerateQrCodeController::class, 'show']);
Route::post('/save', [GenerateQrCodeController::class, 'saveDetails'])->name('save-qr');
Route::get('/edit/{uuid}', [GenerateQrCodeController::class, 'editDetails'])->name('edit-qr');
Route::post('/update', [GenerateQrCodeController::class, 'updateDetails'])->name('update-qr');
Route::get('/delete/{uuid}', [GenerateQrCodeController::class, 'delete'])->name('delete-qr');

Route::get('/dashboard', function () {
    return redirect('show');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
