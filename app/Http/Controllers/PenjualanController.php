<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;
use Carbon\Carbon;
use PDF;

class PenjualanController extends Controller
{

    public function tampil(){
        $user = DB::table('user')->get();
        $produk = DB::table('produk')->get();
        $jenis_produk = DB::table('jenis_produk')->get();
        $start = Carbon::now()->format('Y-m-d').' 00:00:00';
        $end = Carbon::now()->format('Y-m-d').' 23:59:59';
		$id = (DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->count('ID_PENJUALAN'))+1;
		$d = date('d');
        $m = date('m');
        $y = date('y');
        $nota_id = str_pad($y,2,"0",STR_PAD_LEFT).str_pad($m,2,"0",STR_PAD_LEFT).str_pad($d,2,"0",STR_PAD_LEFT)."-".str_pad($id,3,"0",STR_PAD_LEFT);
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('penjualan/penjualan',['user'=>$user, 'produk'=>$produk, 'jenis_produk'=>$jenis_produk, 'nota_id'=>$nota_id]);
        }
    }

    public function store(Request $request)
    {
        $start = Carbon::now()->format('Y-m-d').' 00:00:00';
        $end = Carbon::now()->format('Y-m-d').' 23:59:59';
		$id = (DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->count('ID_PENJUALAN'))+1;
		$d = date('d');
        $m = date('m');
        $y = date('y');
        $nota_id = str_pad($y,2,"0",STR_PAD_LEFT).str_pad($m,2,"0",STR_PAD_LEFT).str_pad($d,2,"0",STR_PAD_LEFT)."-".str_pad($id,3,"0",STR_PAD_LEFT);
        
            DB::table('penjualan')->insert([
	            'ID_PENJUALAN'   => $nota_id,
	            'ID_USER' => $request->userid,
                'TOTAL_PENJUALAN'=> $request->totalpayment,
                'NO_MEJA'=> $request->no_meja,
                'STATUS_PEMBAYARAN'=> '0'
        	]);
            foreach ($request['id'] as $key) {
		            DB::table('detail_penjualan')->insert([
		            'ID_PENJUALAN'   => $nota_id,
		            'ID_PRODUK'  => $key,
		            'JUMLAH' => $request['qty'][$key],
		            'HARGA_JUAL'=> $request['harga'][$key],
		            'DISC'=> $request['discount'][$key],
		            'SUBTOTAL'=> $request['subtotal'][$key]
	            ]);
            }
            $user = DB::table('user')->get();
            $produk = DB::table('produk')->get();
            $penjualan = DB::table('penjualan')->where('ID_PENJUALAN', $nota_id)->get();
            $detail_penjualan = DB::table('detail_penjualan')->get();

	        return view('penjualan/invoice',['user'=>$user, 'produk'=>$produk, 'penjualan'=>$penjualan, 'detail_penjualan'=>$detail_penjualan]);
    }

    public function invoicePDF($id)
    {
        $user = DB::table('user')->get();
        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->where('ID_PENJUALAN', $id)->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();

        $pdf = PDF::loadView('penjualan/invoicePDF',[
            'user'=>$user, 
            'produk'=>$produk, 
            'penjualan'=>$penjualan, 
            'detail_penjualan'=>$detail_penjualan
        ]);
        return $pdf->stream();
    }

    public function invoice($id)
    {
        $user = DB::table('user')->get();
        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->where('ID_PENJUALAN', $id)->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();

        return view('penjualan/invoice',['user'=>$user, 'produk'=>$produk, 'penjualan'=>$penjualan, 'detail_penjualan'=>$detail_penjualan]);
    }

    public function strukPDF($id)
    {
        $user = DB::table('user')->get();
        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->where('ID_PENJUALAN', $id)->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $pembayaran = DB::table('pembayaran')->get();

        $pdf = PDF::loadView('penjualan/strukPDF',[
            'user'=>$user, 
            'produk'=>$produk, 
            'penjualan'=>$penjualan, 
            'detail_penjualan'=>$detail_penjualan,
            'pembayaran'=>$pembayaran
        ]);
        return $pdf->stream();
    }

    public function pembayaran(){
        $user = DB::table('user')->get();
        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('penjualan/pembayaran',['user'=>$user, 'produk'=>$produk, 'penjualan'=>$penjualan, 'detail_penjualan'=>$detail_penjualan]);
        }
    }
    
    public function store_bayar(Request $request)
    {
        $date = date('Y-m-d').'%';
		$id = (DB::table('pembayaran')->where('WAKTU_PEMBAYARAN', 'like', $date)->count('ID_PEMBAYARAN'))+1;
		$d = date('d');
        $m = date('m');
        $y = date('y');
        $nota_id = str_pad($y,2,"0",STR_PAD_LEFT).str_pad($m,2,"0",STR_PAD_LEFT).str_pad($d,2,"0",STR_PAD_LEFT)."B".str_pad($id,3,"0",STR_PAD_LEFT);
        
            DB::table('pembayaran')->insert([
                'ID_PEMBAYARAN' => $nota_id,
	            'ID_PENJUALAN' => $request->nota_id,
	            'ID_USER' => $request->userid,
                'TOTAL_PEMBAYARAN'=> $request->total_bayar
            ]);
            
            DB::table('penjualan')->where('ID_PENJUALAN', $request->nota_id)->update([
                'STATUS_PEMBAYARAN' => '1'
            ]);

            $user = DB::table('user')->get();
            $produk = DB::table('produk')->get();
            $penjualan = DB::table('penjualan')->where('ID_PENJUALAN', $request->nota_id)->get();
            $detail_penjualan = DB::table('detail_penjualan')->get();
            $pembayaran = DB::table('pembayaran')->get();

	        return view('penjualan/struk',['user'=>$user, 'produk'=>$produk, 'penjualan'=>$penjualan, 'detail_penjualan'=>$detail_penjualan, 'pembayaran'=>$pembayaran]);
    }

    public function report(){
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        if (request()->date != '') {
            //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
            $date = explode(' - ' ,request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:00';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $total_penjualan = DB::table('penjualan')->where('STATUS_PEMBAYARAN','=','1')->whereBetween('TGL_PENJUALAN', [$start, $end])->SUM('TOTAL_PENJUALAN');
        $jumlah = DB::table('detail_penjualan')->join('penjualan', 'penjualan.ID_PENJUALAN', '=', 'detail_penjualan.ID_PENJUALAN')
                ->where('.penjualan.STATUS_PEMBAYARAN','=','1')
                ->whereBetween('penjualan.TGL_PENJUALAN', [$start, $end])
                ->sum('detail_penjualan.JUMLAH');
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('penjualan/tabel',['produk'=>$produk, 'penjualan'=>$penjualan, 'detail_penjualan'=>$detail_penjualan, 'total_penjualan'=>$total_penjualan, 'jumlah'=>$jumlah]);
        }
    }

    public function reportPDF($daterange){
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:00';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $produk = DB::table('produk')->get();
        $penjualan = DB::table('penjualan')->whereBetween('TGL_PENJUALAN', [$start, $end])->get();
        $detail_penjualan = DB::table('detail_penjualan')->get();
        $total_penjualan = DB::table('penjualan')->where('STATUS_PEMBAYARAN','=','1')->whereBetween('TGL_PENJUALAN', [$start, $end])->SUM('TOTAL_PENJUALAN');
        $jumlah = DB::table('detail_penjualan')->join('penjualan', 'penjualan.ID_PENJUALAN', '=', 'detail_penjualan.ID_PENJUALAN')
                ->where('.penjualan.STATUS_PEMBAYARAN','=','1')
                ->whereBetween('penjualan.TGL_PENJUALAN', [$start, $end])
                ->sum('detail_penjualan.JUMLAH');
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            $pdf=PDF::loadview('penjualan/cetakLaporanPDF', ['start'=>$start, 'end'=>$end, 'produk'=>$produk, 'penjualan'=>$penjualan, 'detail_penjualan'=>$detail_penjualan, 'total_penjualan'=>$total_penjualan, 'jumlah'=>$jumlah]);
            //GENERATE PDF-NYA
            return $pdf->stream();
        }
    }
}
