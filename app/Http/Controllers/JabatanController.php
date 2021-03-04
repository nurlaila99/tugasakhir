<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;

class JabatanController extends Controller
{

    public function tampil(){
        $jabatan = DB::table('jabatan')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('jabatan/tabel',['jabatan'=>$jabatan]);
        }
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required|max:30'
        ]);
		$id = (DB::table('jabatan')->count('ID_JABATAN'))+1;
		
        $id_jabatan = "JBT".str_pad($id,2,"0",STR_PAD_LEFT);
        DB::table('jabatan')->insert([
            'ID_JABATAN' => $id_jabatan,
            'NAMA_JABATAN' => $request->nama
        ]);
        Session::flash('success','Data berhasil ditambahkan');
        return redirect('/jabatan');
    }

    public function update(Request $request){
        $jabatan = DB::table('jabatan')->where('ID_JABATAN', $request->id_jabatan)->update([
            'NAMA_JABATAN' => $request->nama
        ]);

        return redirect('jabatan');
    }    
}
