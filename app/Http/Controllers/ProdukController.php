<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;

class ProdukController extends Controller
{

    public function tampil(){
        $produk = DB::table('produk')->get();
        $jenis_produk = DB::table('jenis_produk')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('produk/tabel',['produk'=>$produk, 'jenis_produk'=>$jenis_produk]);
        }
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required|max:30',
            'jenis_produk' => 'required',
            'harga' => 'required'
        ]);
		$id = (DB::table('produk')->count('ID_PRODUK'))+1;
		
        $id_produk = "P".str_pad($id,4,"0",STR_PAD_LEFT);
        DB::table('produk')->insert([
            'ID_PRODUK' => $id_produk,
            'ID_JENIS_PRODUK' => $request->jenis_produk,
            'NAMA_PRODUK' => $request->nama,
            'HARGA' => $request->harga
        ]);
        Session::flash('success','Data berhasil ditambahkan');
        return redirect('/produk');
    }

    public function update(Request $request){
        $produk = DB::table('produk')->where('ID_PRODUK', $request->id_produk)->update([
            'ID_JENIS_PRODUK' => $request->jenis_produk,
            'NAMA_PRODUK' => $request->nama,
            'HARGA' => $request->harga
        ]);

        return redirect('produk');
    }    
}
