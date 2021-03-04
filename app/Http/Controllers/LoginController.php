<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Crypt;
use DB;


class LoginController extends Controller
{
	public function index(){
        if(!Session::get('login')){
            return view('login');
	    }else{
            return redirect('/home');
        }
	        
    }
    
    public function dashboard(){
        $banyakpenjualan = DB::table('penjualan')->COUNT('ID_PENJUALAN');
        $totalpenjualan = DB::table('pembayaran')->SUM('TOTAL_PEMBAYARAN');
        $total_pembelian = DB::table('pembelian')->SUM('TOTAL_PEMBELIAN');
        $total_pengeluaran = DB::table('pengeluaran_bulanan')->SUM('TOTAL_PENGELUARAN');
        $total = $total_pembelian + $total_pengeluaran;
        $user = DB::table('user')->COUNT('ID_USER');
        $totalpcs = DB::table('detail_penjualan')->SUM('JUMLAH');
        $totalthaitea = DB::table('detail_penjualan')->where('ID_PRODUK', 'P0001')->SUM('JUMLAH');
        $totalchoco = DB::table('detail_penjualan')->where('ID_PRODUK', 'P0002')->SUM('JUMLAH');
        $totalgreentea = DB::table('detail_penjualan')->where('ID_PRODUK', 'P0003')->SUM('JUMLAH');
        $totalavocado = DB::table('detail_penjualan')->where('ID_PRODUK', 'P0004')->SUM('JUMLAH');
        $persenthaitea = ($totalthaitea/$totalpcs)*100;
        $persenchoco = ($totalchoco/$totalpcs)*100;
        $persengreentea = ($totalgreentea/$totalpcs)*100;
        $persenavocado = ($totalavocado/$totalpcs)*100;
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('body',[
                'banyakpenjualan'=>$banyakpenjualan,
                'totalpenjualan'=>$totalpenjualan,
                'total'=>$total,
                'user'=>$user,
                'totalthaitea'=>$totalthaitea,
                'totalchoco'=>$totalchoco,
                'totalgreentea'=>$totalgreentea,
                'totalavocado'=>$totalavocado,
                'persenthaitea'=>$persenthaitea,
                'persenchoco'=>$persenchoco,
                'persengreentea'=>$persengreentea,
                'persenavocado'=>$persenavocado
            ]);
        }
	}

    public function proses(Request $req){
        $username = $req->username;
        $password = $req->password;
        $data = DB::table('user')->where('USERNAME',$username)->first();
        if($data){
            $pass = Crypt::decryptString($data->PASSWORD);
            if($pass == $password){
                Session::put('nama',$data->NAMA_USER);
                Session::put('id',$data->ID_USER);
                Session::put('login',TRUE);
                if($data->ID_JABATAN == 'JBT01'){
                    Session::put('owner',TRUE);
                    return redirect('home');
                }else if($data->ID_JABATAN == 'JBT02'){
                    Session::put('admin',TRUE);
                    return redirect('home');
                }else if($data->ID_JABATAN == 'JBT03'){
                    Session::put('pegawai',TRUE);
                    return redirect('home');
                }
            }else{
                return redirect('/')->with('alert','Password salah!');
            }
        }else{
            return redirect('/')->with('alert','Username salah!');
        }
    }
    
    public function logout(){
        Session::flush();
        return redirect('/')->with('alert-success','Anda berhasil logout');
    }
}

?>