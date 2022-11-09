<?php

use App\Http\Controllers\DasLapanganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DasTransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DasRoleController;
use App\Http\Controllers\DasUser;

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

Route::get('/logout', [AuthController::class, "destroy"])->name("logout");
Route::group(["middleware" => "guest"], function () {
    Route::get('/login', [AuthController::class, "index"])->name("login");
    Route::post("/store", [AuthController::class, "store"]);
});
Route::group(["middleware" => "auth"], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get("/user", [DasUser::class, "index"]);
    Route::delete("/user/{user}", [DasUser::class, "destroy"]);
    Route::get("/user/add", [DasUser::class, "add"]);
    Route::post("/user", [DasUser::class, "store"]);
    Route::get("/user/{user}/edit", [DasUser::class, "edit"]);
    Route::put("/user/{user}", [DasUser::class, "update"]);

    // MANAGE ROLE DASHBOARD
    Route::get("/access-control", [DasRoleController::class, "index"]);
    Route::delete("/access-control/{role}", [DasRoleController::class, "destroy"]);
    Route::get("/access-control/add", [DasRoleController::class, "add"]);
    Route::post("/access-control", [DasRoleController::class, "store"]);
    Route::get("/access-control/{role}/edit", [DasRoleController::class, "edit"]);
    Route::put("/access-control/{role}", [DasRoleController::class, "update"]);
    // MANAGE PELANGGAN
    Route::get("/pelanggan", [DasPelangganControler::class, "index"]);
    Route::delete("/pelanggan/{pelanggan}", [DasPelangganControler::class, "destroy"]);
    Route::get("/pelanggan/add", [DasPelangganControler::class, "add"]);
    Route::post("/pelanggan", [DasPelangganControler::class, "store"]);
    Route::get("/pelanggan/{pelanggan}/edit", [DasPelangganControler::class, "edit"]);
    Route::put("/pelanggan/{pelanggan}", [DasPelangganControler::class, "update"]);

    // MANAGE DATA LAPANGAN
    Route::get("/lapangan", [DasLapanganController::class, "index"]);
    Route::delete("/lapangan/{lapangan}", [DasLapanganController::class, "destroy"]);
    Route::get("/lapangan/add", [DasLapanganController::class, "add"]);
    Route::post("/lapangan", [DasLapanganController::class, "store"]);
    Route::get("/lapangan/{lapangan}/edit", [DasLapanganController::class, "edit"]);
    Route::put("/lapangan/{lapangan}", [DasLapanganController::class, "update"]);

    // MANAGE DATA TRANSAKSI
    Route::get("/jadwal", [DasTransaksiController::class, "index"]);
    Route::delete("/transaksi/{transaksi}", [DasTransaksiController::class, "destroy"]);
    Route::get("/transaksi/add", [DasTransaksiController::class, "add"]);
    Route::post("/transaksi", [DasTransaksiController::class, "store"]);
    Route::get("/transaksi/{transaksi}/edit", [DasTransaksiController::class, "edit"]);
    // Route::put("/transaksi/{transaksi}", [DasTransaksiController::class, "update"]);
    Route::post("/transaksi/{transaksi}", [DasTransaksiController::class, "update"])->name('updatebukti');
    Route::get("/upload_bukti/{transaksi}", [DasTransaksiController::class, "upload_bukti"]);
    Route::get("/riwayat", [DasTransaksiController::class, "riwayat"]);
    Route::get("/riwayat/cetak/{riwayat}", [DasTransaksiController::class, "cetakPDF"])->name('cetakPDF');;
    Route::get("/data_pesan", [DasTransaksiController::class, "data_pesan"]);
    Route::get("/data_pesan/{transaksi}", [DasTransaksiController::class, "change_condition"])->name('terima');
});
