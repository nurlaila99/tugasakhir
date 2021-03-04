<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;
use Carbon\Carbon;
use PDF;

class KeuanganController extends Controller
{
    public function report(){
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        if (request()->date != '') {
            //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:00';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $user = DB::table('user')->get();
        $pembelian = DB::table('pembelian')->whereBetween('TGL_PEMBELIAN', [$start, $end])->get();
        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $pengeluaran_bulanan = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->get();
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->get();
        $detail_pembelian = DB::table('detail_pembelian')->get();
        $bahan_baku = DB::table('bahan_baku')->get();
        $total_penjualan = DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->SUM('TOTAL_PENJUALAN');
        $total_pembelian = DB::table('pembelian')->whereBetween('TGL_PEMBELIAN', [$start, $end])->SUM('TOTAL_PEMBELIAN');
        $total_pengeluaran = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->SUM('TOTAL_PENGELUARAN');
        $total = $total_pembelian + $total_pengeluaran;
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('keuangan/keuangan',[
                'user'=>$user, 
                'pembelian'=>$pembelian, 
                'produk'=>$produk, 
                'penjualan'=>$penjualan,
                'detail_penjualan'=>$detail_penjualan,
                'pengeluaran_bulanan'=>$pengeluaran_bulanan,
                'jenis_pengeluaran'=>$jenis_pengeluaran,
                'detail_pembelian'=>$detail_pembelian,
                'bahan_baku'=>$bahan_baku,
                'total_penjualan'=>$total_penjualan,
                'total_pembelian'=>$total_pembelian,
                'total_pengeluaran'=>$total_pengeluaran,
                'total'=>$total
            ]);
        }
    }

    public function reportPDF($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:00';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $user = DB::table('user')->get();
        $pembelian = DB::table('pembelian')->whereBetween('TGL_PEMBELIAN', [$start, $end])->get();
        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $pengeluaran_bulanan = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->get();
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->get();
        $detail_pembelian = DB::table('detail_pembelian')->get();
        $bahan_baku = DB::table('bahan_baku')->get();
        $total_penjualan = DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->SUM('TOTAL_PENJUALAN');
        $total_pembelian = DB::table('pembelian')->whereBetween('TGL_PEMBELIAN', [$start, $end])->SUM('TOTAL_PEMBELIAN');
        $total_pengeluaran = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->SUM('TOTAL_PENGELUARAN');
        $total = $total_pembelian + $total_pengeluaran;
        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        $pdf = PDF::loadView('keuangan/reportPDF',[
            'user'=>$user, 
            'pembelian'=>$pembelian, 
            'produk'=>$produk, 
            'penjualan'=>$penjualan,
            'detail_penjualan'=>$detail_penjualan,
            'pengeluaran_bulanan'=>$pengeluaran_bulanan,
            'jenis_pengeluaran'=>$jenis_pengeluaran,
            'detail_pembelian'=>$detail_pembelian,
            'bahan_baku'=>$bahan_baku,
            'total_penjualan'=>$total_penjualan,
            'total_pembelian'=>$total_pembelian,
            'total_pengeluaran'=>$total_pengeluaran,
            'total'=>$total,
            'date'=>$date
        ]);
        //GENERATE PDF-NYA
        return $pdf->stream();
    }
}
