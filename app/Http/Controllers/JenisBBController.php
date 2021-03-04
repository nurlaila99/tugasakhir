<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;

class JenisBBController extends Controller
{

    public function tampil(){
        $jenis_bahan_baku = DB::table('jenis_bahan_baku')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('jenis_bahan_baku/tabel',['jenis_bahan_baku'=>$jenis_bahan_baku]);
        }
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required|max:30'
        ]);
		$id = (DB::table('jenis_bahan_baku')->count('ID_JENIS_BAHAN_BAKU'))+1;
		
        $jenis_id = "JB".str_pad($id,3,"0",STR_PAD_LEFT);
        DB::table('jenis_bahan_baku')->insert([
            'ID_JENIS_BAHAN_BAKU' => $jenis_id,
            'NAMA_JENIS_BAHAN_BAKU' => $request->nama
        ]);
        Session::flash('success','Data berhasil ditambahkan');
        return redirect('/jenis_bahan_baku');
    }

    public function update(Request $request){
        $jenis_bahan_baku = DB::table('jenis_bahan_baku')->where('ID_JENIS_BAHAN_BAKU', $request->id_jenis)->update([
            'NAMA_JENIS_BAHAN_BAKU' => $request->nama
        ]);

        return redirect('jenis_bahan_baku');
    }    
}
