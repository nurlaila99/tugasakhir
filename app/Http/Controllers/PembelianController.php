<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;
use Carbon\Carbon;

class PembelianController extends Controller
{

    public function tampil(){
        $user = DB::table('user')->get();
        $bahan_baku = DB::table('bahan_baku')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('pembelian/pembelian',['user'=>$user, 'bahan_baku'=>$bahan_baku]);
        }
    }

    public function store(Request $request)
    {
        $message = [
            'mimes' => 'Hanya menerima File dengan format .jpeg/.jpg/.png',
        ];
        $this->validate($request, [
            'file' => 'required|mimes:jpeg,jpg,png'
        ],$message);
        $date = date('Y-m-d').'%';
		$id = (DB::table('pembelian')->where('TGL_PEMBELIAN', 'like', $date)->count('ID_PEMBELIAN'))+1;
		$d = date('d');
        $m = date('m');
        $y = date('y');
        $pembelian_id = str_pad($y,2,"0",STR_PAD_LEFT).str_pad($m,2,"0",STR_PAD_LEFT).str_pad($d,2,"0",STR_PAD_LEFT).str_pad($id,2,"0",STR_PAD_LEFT);
        
        $file = $request->file('file');
        $nama_foto = $pembelian_id.'_'.$request->file('file')->getClientOriginalName();
        $path_foto = '/Foto/'.$nama_foto;

        // Simpan file ke public
        $file->move('Foto', $nama_foto);

            DB::table('pembelian')->insert([
	            'ID_PEMBELIAN'   => $pembelian_id,
	            'ID_USER' => $request->userid,
                'TOTAL_PEMBELIAN'=> $request->totalpayment,
                'BUKTI_PEMBELIAN'=> $path_foto
        	]);
            foreach ($request['id'] as $key) {
		        DB::table('detail_pembelian')->insert([
		            'ID_PEMBELIAN' => $pembelian_id,
		            'ID_BAHAN_BAKU' => $key,
		            'JUMLAH' => $request['qty'][$key],
		            'HARGA_BELI'=> $request['harga'][$key],
		            'DISC'=> $request['discount'][$key],
		            'SUBTOTAL'=> $request['subtotal'][$key]
                ]);
            }
            Session::flash('success','Input pembelian bahan baku berhasil');
	        return redirect('pembelian');
    }

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
        $bahan_baku = DB::table('bahan_baku')->get();
        $detail_pembelian = DB::table('detail_pembelian')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('pembelian/tabel',['user'=>$user, 'pembelian'=>$pembelian, 'bahan_baku'=>$bahan_baku, 'detail_pembelian'=>$detail_pembelian]);
        }
    }

    public function update_stok(){
        $bahan_baku = DB::table('bahan_baku')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('pembelian/update_stok',['bahan_baku'=>$bahan_baku]);
        }
    }

    public function update_store(Request $request){
        
        DB::table('bahan_baku')->where('ID_BAHAN_BAKU', $request->bahan_baku)->update([
            'STOK' => $request->stok
        ]);
        Session::flash('success','Update stok berhasil');
        return redirect('update_stok');
    }
}
