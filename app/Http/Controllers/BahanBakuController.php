<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;

class BahanBakuController extends Controller
{

    public function tampil(){
        $bahan_baku = DB::table('bahan_baku')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('bahan_baku/tabel',['bahan_baku'=>$bahan_baku]);
        }
    }
    
    public function store(Request $request){

        $this->validate($request, [
            'nama' => 'required|max:30',
            'harga' => 'required',
            'stok' => 'required',
            'satuan' => 'required'
        ]);

		$id = (DB::table('bahan_baku')->count('ID_BAHAN_BAKU'))+1;
		
        $id_bahan_baku = "BB".str_pad($id,3,"0",STR_PAD_LEFT);
        DB::table('bahan_baku')->insert([
            'ID_BAHAN_BAKU' => $id_bahan_baku,
            'NAMA_BAHAN_BAKU' => $request->nama,
            'HARGA' => $request->harga,
            'STOK' => $request->stok,
            'SATUAN' => $request->satuan
        ]);
        Session::flash('success','Data berhasil ditambahkan');
        return redirect('/bahan_baku');
    }

    public function update(Request $request){
        $bahan_baku = DB::table('bahan_baku')->where('ID_BAHAN_BAKU', $request->id_bahan_baku)->update([
            'NAMA_BAHAN_BAKU' => $request->nama,
            'HARGA' => $request->harga,
            'SATUAN' => $request->satuan
        ]);

        return redirect('bahan_baku');
    }    
}
