<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;

class JenisPengeluaranController extends Controller
{

    public function tampil(){
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('jenis_pengeluaran/tabel',['jenis_pengeluaran'=>$jenis_pengeluaran]);
        }
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required|max:30'
        ]);
		$id = (DB::table('jenis_pengeluaran')->count('ID_JENIS_PENGELUARAN'))+1;
		
        $jenis_id = "JP".str_pad($id,3,"0",STR_PAD_LEFT);
        DB::table('jenis_pengeluaran')->insert([
            'ID_JENIS_PENGELUARAN' => $jenis_id,
            'NAMA_JENIS_PENGELUARAN' => $request->nama
        ]);
        Session::flash('success','Data berhasil ditambahkan');
        return redirect('/jenis_pengeluaran');
    }

    public function update(Request $request){
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->where('ID_JENIS_PENGELUARAN', $request->id_jenis)->update([
            'NAMA_JENIS_PENGELUARAN' => $request->nama
        ]);

        return redirect('jenis_pengeluaran');
    }    
}
