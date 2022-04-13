<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBencanaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LaporanBencanaController;
use App\Http\Controllers\LaporanTahunController;
use App\Http\Controllers\MitigasiBencanaController;
use App\Http\Controllers\UserController;
use App\Models\LaporanTahun;

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

Route::get('/', function () {
    return redirect()->route('login');
});
//Data array
// Route::get('/data-array',[BeritaController::class,'dataarray']);
Route::middleware(['auth'])->group(function () {
    Route::get('/back-dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* kategori */
    Route::get('/back-kategori-bencana', [KategoriBencanaController::class, 'index']);
    Route::get('/back-kategori-bencana/create', [KategoriBencanaController::class, 'create']);
    Route::post('/back-kategori-bencana/save', [KategoriBencanaController::class, 'store']);
    Route::post('/back-kategori-bencana/{kategoriBencana}/edit', [KategoriBencanaController::class, 'edit']);
    Route::put('/back-kategori-bencana/update/{kategoriBencana}', [KategoriBencanaController::class, 'update']);
    Route::delete('/back-kategori-bencana/{kategoriBencana}/drop', [KategoriBencanaController::class, 'destroy']);

    /* berita */
    Route::resource('/back-berita', BeritaController::class);

    /* mitigasi */
    Route::resource('/back-mitigasi', MitigasiBencanaController::class);
    Route::get('export-mitigasi', [MitigasiBencanaController::class, 'export'])->name('back-mitigasi.export');

    /* laporan bencana */
    Route::resource('/back-laporan-bencana', LaporanBencanaController::class);

    /* instagram */
    Route::get('/back-instagram-embed', [InstagramController::class, 'index']);
    Route::post('/back-instagram-embed/save', [InstagramController::class, 'store']);
    Route::post('/back-instagram-embed/{instagram}/edit', [InstagramController::class, 'edit']);
    Route::put('/back-instagram-embed/update/{instagram}', [InstagramController::class, 'update']);
    Route::delete('/back-instagram-embed/{instagram}/drop', [InstagramController::class, 'destroy']);

    /* feedback */
    Route::get('/back-feedback', [FeedbackController::class, 'index']);
    Route::post('/back-feedback/save', [FeedbackController::class, 'store']);
    Route::put('/back-feedback/{feedback}/read', [FeedbackController::class, 'update']);
    Route::delete('/back-feedback/{feedback}/drop', [FeedbackController::class, 'destroy']);

    // LaporanTahun
    Route::resource('/back-laporan',LaporanTahunController::class);

    //Update Profile
    Route::resource('/update-profile',UserController::class);
});

require __DIR__.'/auth.php';
