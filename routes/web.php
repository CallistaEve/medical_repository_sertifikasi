<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/item/create/obat', [ItemController::class, 'createObat'])->name('item.create.obat');
Route::get('/item/create/peralatan', [ItemController::class, 'createPeralatan'])->name('item.create.peralatan');
Route::get('/item/create/consumable', [ItemController::class, 'createConsumable'])->name('item.create.consumable');

// Rute Dashboard, hanya bisa diakses oleh pengguna yang sudah terautentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard'); // Menampilkan dashboard dengan item

    // Rute untuk Item (CRUD)
    Route::resource('item', ItemController::class);
});

require __DIR__.'/auth.php';
