<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'LoginController@index');

Route::post('login', 'LoginController@proses');

Route::get('logout', 'LoginController@logout');

Route::get('home','LoginController@dashboard');

//User

Route::get('user', 'UserController@tampil');
Route::post('user/store','UserController@store');
Route::post('user/update','UserController@update');

//Jabatan

Route::get('jabatan', 'JabatanController@tampil');
Route::post('jabatan/store','JabatanController@store');
Route::post('jabatan/update','JabatanController@update');

//Jenis Bahan Baku

Route::get('jenis_bahan_baku', 'JenisBBController@tampil');
Route::post('jenis_bahan_baku/store','JenisBBController@store');
Route::post('jenis_bahan_baku/update','JenisBBController@update');

//Bahan Baku

Route::get('bahan_baku', 'BahanBakuController@tampil');
Route::post('bahan_baku/store','BahanBakuController@store');
Route::post('bahan_baku/update','BahanBakuController@update');

//Jenis Pengeluaran

Route::get('jenis_pengeluaran', 'JenisPengeluaranController@tampil');
Route::post('jenis_pengeluaran/store','JenisPengeluaranController@store');
Route::post('jenis_pengeluaran/update','JenisPengeluaranController@update');

//Produk

Route::get('produk', 'ProdukController@tampil');
Route::post('produk/store','ProdukController@store');
Route::post('produk/update','ProdukController@update');

//Penjualan

Route::get('penjualan', 'PenjualanController@tampil');
Route::post('penjualan/submit', 'PenjualanController@store');
Route::get('penjualan/invoice', 'PenjualanController@invoice');
Route::get('penjualan/invoice/cetak/{id}', 'PenjualanController@invoicePDF');
Route::get('penjualan/struk/cetak/{id}', 'PenjualanController@strukPDF');
Route::get('pembayaran', 'PenjualanController@pembayaran');
Route::post('pembayaran/store', 'PenjualanController@store_bayar');
Route::get('penjualan/report', 'PenjualanController@report');

//Pengeluaran

Route::get('pengeluaran', 'PengeluaranController@tampil');
Route::post('pengeluaran/store', 'PengeluaranController@store');
Route::get('pengeluaran/report', 'PengeluaranController@report');

//Pembelian

Route::get('pembelian', 'PembelianController@tampil');
Route::post('pembelian/store', 'PembelianController@store');
Route::get('pembelian/report', 'PembelianController@report');
Route::get('update_stok', 'PembelianController@update_stok');
Route::post('update_stok/store', 'PembelianController@update_store');

//Keuangan

Route::get('keuangan/report', 'KeuanganController@report');
Route::get('keuangan/pdf/{daterange}', 'KeuanganController@reportPDF');