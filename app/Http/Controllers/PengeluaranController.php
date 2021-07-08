<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Redirect;
use Storage;
use DB;
use Session;
use Carbon\Carbon;
use PDF;

class PengeluaranController extends Controller
{

    public function tampil(){
        $user = DB::table('user')->get();
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->get();
        $pengeluaran_bulanan = DB::table('pengeluaran_bulanan')->get();
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
    	    return view('pengeluaran/pengeluaran',['user'=>$user, 'jenis_pengeluaran'=>$jenis_pengeluaran, 'pengeluaran_bulanan'=>$pengeluaran_bulanan]);
        }
    }

    public function store(Request $request)
    {
        
        $message = [
            'mimes' => 'Hanya menerima File dengan format .jpeg/.jpg/.png',
        ];
        $this->validate($request, [
            'user' => 'required',
            'jenis_pengeluaran' => 'required',
            'total' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png'
        ],$message);
        $date = date('Y-m-d').'%';
		$id = (DB::table('pengeluaran_bulanan')->where('TGL_PENGELUARAN', 'like', $date)->count('ID_PENGELUARAN'))+1;
		$d = date('d');
        $m = date('m');
        $y = date('y');
        $pengeluaran_id = str_pad($y,2,"0",STR_PAD_LEFT).str_pad($m,2,"0",STR_PAD_LEFT).str_pad($d,2,"0",STR_PAD_LEFT)."PL".str_pad($id,2,"0",STR_PAD_LEFT);
        
        $file = $request->file('file');
        $nama_foto = $pengeluaran_id.'_'.$request->file('file')->getClientOriginalName();
        $path_foto = '/Foto/'.$nama_foto;

        // Simpan file ke public
        $file->move('Foto', $nama_foto);

            DB::table('pengeluaran_bulanan')->insert([
	            'ID_PENGELUARAN'   => $pengeluaran_id,
                'ID_USER' => $request->user,
                'ID_JENIS_PENGELUARAN' => $request->jenis_pengeluaran,
                'TOTAL_PENGELUARAN'=> $request->total,
                'KETERANGAN'=> $request->keterangan,
                'BUKTI_PENGELUARAN' => $path_foto
        	]);
            Session::flash('success','Input pengeluaran berhasil');
            return redirect('pengeluaran');
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

        $pengeluaran_bulanan = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->get();
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->get();
        $total_pengeluaran = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->SUM('TOTAL_PENGELUARAN');
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            return view('pengeluaran/tabel',['pengeluaran_bulanan'=>$pengeluaran_bulanan, 'jenis_pengeluaran'=>$jenis_pengeluaran, 'total_pengeluaran'=>$total_pengeluaran]);
        }
    }

    public function reportPDF($daterange){
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:00';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        $pengeluaran_bulanan = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->get();
        $jenis_pengeluaran = DB::table('jenis_pengeluaran')->get();
        $total_pengeluaran = DB::table('pengeluaran_bulanan')->whereBetween('TGL_PENGELUARAN', [$start, $end])->SUM('TOTAL_PENGELUARAN');
        if(!Session::get('login')){
	        return redirect('/')->with('alert','Anda harus login terlebih dahulu');
	    }else{
            $pdf=PDF::loadview('pengeluaran/cetakLaporanPDF', ['start'=>$start, 'end'=>$end, 'pengeluaran_bulanan'=>$pengeluaran_bulanan, 'jenis_pengeluaran'=>$jenis_pengeluaran, 'total_pengeluaran'=>$total_pengeluaran]);
            //GENERATE PDF-NYA
            return $pdf->stream();
        }
    }
}
