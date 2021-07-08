<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Redirect;
use Storage;
use DB;
use Session;

class UserController extends Controller
{

    public function tampil(){
        $user = DB::table('user')->get();
        $jabatan = DB::table('jabatan')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('user/tabel',['user'=>$user, 'jabatan'=>$jabatan]);
        }
    }

    public function profile($id){
        $userx = DB::table('user')->where('ID_USER', $id)->first();
        if($userx){
            $pass = Crypt::decryptString($userx->PASSWORD);
        }
        $user = DB::table('user')->where('ID_USER', $id)->get();
        $jabatan = DB::table('jabatan')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('user/profile',['user'=>$user, 'jabatan'=>$jabatan, 'pass'=>$pass]);
        }
    }

    public function editpassword($id){
        $user = DB::table('user')->where('ID_USER', $id)->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('user/editpw',['user'=>$user]);
        }
    }

    public function editpasswordproses(Request $request){
        $password = Crypt::encryptString($request->password2);
        $user = DB::table('user')->where('ID_USER', $request->id_user)->update([
            'PASSWORD' => $password
        ]);

        $user = DB::table('user')->where('ID_USER', $request->id_user)->get();
        Session::flash('success','Password berhasil diedit');
        return view('user/editpw',['user'=>$user]);
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'jabatan' => 'required',
            'nama' => 'required|max:30',
            'no_tlp' => 'required|min:10|max:13',
            'alamat' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
		$id = (DB::table('user')->count('ID_USER'))+1;
		
        $user_id = "US".str_pad($id,3,"0",STR_PAD_LEFT);
        $password = Crypt::encryptString($request->password);
        DB::table('user')->insert([
            'ID_USER' => $user_id,
            'ID_JABATAN' => $request->jabatan,
            'NAMA_USER' => $request->nama,
            'TLP_USER' => $request->no_tlp,
            'ALAMAT_USER' => $request->alamat,
            'EMAIL_USER' => $request->email,
            'USERNAME' => $request->username,
            'PASSWORD' => $password,
            'STATUS_PEGAWAI' => 1
        ]);
        Session::flash('success','Data berhasil ditambahkan');
        return redirect('/user');
    }

    public function update(Request $request){
        $user = DB::table('user')->where('ID_USER', $request->id_user)->update([
            'ID_JABATAN' => $request->jabatan,
            'NAMA_USER' => $request->nama,
            'TLP_USER' => $request->no_tlp,
            'ALAMAT_USER' => $request->alamat,
            'EMAIL_USER' => $request->email,
            'USERNAME' => $request->username,
            'STATUS_PEGAWAI' => $request->status
        ]);
        Session::flash('success','Data berhasil diubah');
        return redirect('user');
    }   

    public function profileupdate(Request $request){
        $this->validate($request, [
            'jabatan' => 'required',
            'nama' => 'required|max:30',
            'no_tlp' => 'required|min:10|max:13',
            'alamat' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password2' => 'required'
        ]);
        $password = Crypt::encryptString($request->password2);
        $user = DB::table('user')->where('ID_USER', $request->id_user)->update([
            'ID_JABATAN' => $request->jabatan,
            'NAMA_USER' => $request->nama,
            'TLP_USER' => $request->no_tlp,
            'ALAMAT_USER' => $request->alamat,
            'EMAIL_USER' => $request->email,
            'USERNAME' => $request->username,
            'PASSWORD' => $password
        ]);

        $userx = DB::table('user')->where('ID_USER', $request->id_user)->first();
        if($userx){
            $pass = Crypt::decryptString($userx->PASSWORD);
        }
        $user = DB::table('user')->where('ID_USER', $request->id_user)->get();
        $jabatan = DB::table('jabatan')->get();
        Session::flash('success','Data berhasil diubah');
        return view('user/profile',['user'=>$user, 'jabatan'=>$jabatan, 'pass'=>$pass]);
    }   
}
