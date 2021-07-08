<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;

class JenisProdukController extends Controller
{

    public function tampil(){
        $jenis_produk = DB::table('jenis_produk')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('jenis_produk/tabel',['jenis_produk'=>$jenis_produk]);
        }
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required|max:30'
        ]);
		$id = (DB::table('jenis_produk')->count('ID_JENIS_PRODUK'))+1;
		
        $jenis_id = "JPR".str_pad($id,2,"0",STR_PAD_LEFT);
        DB::table('jenis_produk')->insert([
            'ID_JENIS_PRODUK' => $jenis_id,
            'NAMA_JENIS_PRODUK' => $request->nama
        ]);
        Session::flash('success','Data berhasil ditambahkan');
        return redirect('/jenis_produk');
    }

    public function update(Request $request){
        $jenis_produk = DB::table('jenis_produk')->where('ID_JENIS_PRODUK', $request->id_jenis)->update([
            'NAMA_JENIS_PRODUK' => $request->nama
        ]);

        return redirect('jenis_produk');
    }    
}
