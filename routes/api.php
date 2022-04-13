<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BeritaBencanaController;
use App\Http\Controllers\API\BeritaController;
use App\Http\Controllers\API\LaporanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// register user api
Route::post('/auth/register', [AuthController::class, 'register']);
// login user
Route::post('/auth/login', [AuthController::class, 'login']);

// list Kategori
Route::get('/list-kategori', [BeritaBencanaController::class, 'listKategori']);
// Notifikasi Bencana
Route::get('/bencana', [BeritaBencanaController::class, 'databencanaall']);
Route::get('/bencana/{kecamatan}/{kategori}', [BeritaBencanaController::class, 'databencana']);
Route::get('/bencana-kecamatan/{kecamatan}', [BeritaBencanaController::class, 'databencanakecamatan']);
Route::get('/search-bencana/{kecamatan}/{title}', [BeritaBencanaController::class, 'searchbencana']);
Route::get('/search-bencana/{kecamatan}/{kategori}/{title}', [BeritaBencanaController::class, 'searchbencanakategori']);
// Mitigasi Bencana
Route::get('/mitigasi-bencana', [BeritaBencanaController::class, 'mitigasibencanaall']);
Route::get('/mitigasi-bencana/{id}', [BeritaBencanaController::class, 'mitigasibencana']);

// Berita
Route::get('/berita/{kategori}', [BeritaController::class, 'beritakategori']);
Route::get('/berita/{kategori}/{title}', [BeritaController::class, 'beritakategorititle']);
Route::get('/berita', [BeritaController::class, 'beritaall']);
Route::post('/search-berita', [BeritaController::class, 'searchBerita']);
Route::get('add-visitor/{id_user}', [AuthController::class, 'visitor']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Route::middleware(['auth'])->group(function () {
    // // list Kategori
    // Route::get('/list-kategori',[BeritaBencanaController::class,'listKategori']);
    // // Notifikasi Bencana
    // Route::get('/bencana',[BeritaBencanaController::class,'databencanaall']);
    // Route::get('/bencana/{kategori}',[BeritaBencanaController::class,'databencana']);
    // // Mitigasi Bencana
    // Route::get('/mitigasi-bencana',[BeritaBencanaController::class,'mitigasibencanaall']);
    // Route::get('/mitigasi-bencana/{id}',[BeritaBencanaController::class,'mitigasibencana']);

    // update profile
    Route::get('/profile/{id}', [AuthController::class, 'getprofile']);
    Route::post('/update-profile/{id}', [AuthController::class, 'updateprofile']);
    // download pdf
    Route::get('/laporan-download',[LaporanController::class,'laporanTahun']);
    // laporan bencana
    Route::apiResource('/laporan-bencana', LaporanController::class);
    // Logout
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    // // update profile
    // Route::get('/profile/{id}',[AuthController::class,'getprofile']);
    // Route::post('/update-profile/{id}',[AuthController::class,'updateprofile']);
    // // Berita
    // Route::get('/berita/{kategori}',[BeritaController::class,'beritakategori']);
    // Route::get('/berita',[BeritaController::class,'beritaall']);
    // Route::post('/search-berita',[BeritaController::class,'searchBerita']);

});

// Route::post('login', [AuthController::class, 'login']);
// Route::get('logout', [AuthController::class, 'logout']);
