<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Crypt;
use DB;
use Carbon\Carbon;


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
        $start = Carbon::now()->format('Y-m-d H:i:s');
        $end = Carbon::now()->format('Y-m-d H:i:s');
        $start2 = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end2 = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        $totalpenjualan = DB::table('pembayaran')->whereBetween('WAKTU_PEMBAYARAN', [$start2, $end2])->SUM('TOTAL_PEMBAYARAN');
        $total_pembelian = DB::table('pembelian')->whereBetween('TGL_PEMBELIAN', [$start2, $end2])->SUM('TOTAL_PEMBELIAN');
        $total_pengeluaran = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start2, $end2])->SUM('TOTAL_PENGELUARAN');
        $total = $total_pembelian + $total_pengeluaran;
        $banyakpenjualan = DB::table('detail_penjualan')->join('penjualan', 'penjualan.ID_PENJUALAN', '=', 'detail_penjualan.ID_PENJUALAN')
                        ->where('.penjualan.STATUS_PEMBAYARAN','=','1')
                        ->whereBetween('penjualan.TGL_PENJUALAN', [$start2, $end2])
                        ->sum('detail_penjualan.JUMLAH');
        $bahan_baku = DB::table('bahan_baku')->get();

        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('body',[
                'banyakpenjualan'=>$banyakpenjualan,
                'totalpenjualan'=>$totalpenjualan,
                'total'=>$total,
                'bahan_baku'=>$bahan_baku
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