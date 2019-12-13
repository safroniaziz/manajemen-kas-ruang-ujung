<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kas;
use App\Pemasukan;
use App\Pengeluaran;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function dashboard(){
        $saldo_awal = Kas::select('dana_awal')->where('id',1)->first();
        $jumlah_pemasukan = Pemasukan::join('kas','kas.id','pemasukans.kas_id')
                                            ->select(DB::raw('sum(jumlah_pemasukan) as jumlah_pemasukan'))->where('kas.id',Auth::user()->kas_id)->get(); 
        $jumlah_pengeluaran = Pengeluaran::join('kas','kas.id','pengeluarans.kas_id')
                                            ->select(DB::raw('sum(jumlah_pengeluaran) as jumlah_pengeluaran'))->where('kas.id',Auth::user()->kas_id)->get(); 

        $saldo_akhir = $saldo_awal->dana_awal + $jumlah_pemasukan[0]->jumlah_pemasukan - $jumlah_pengeluaran[0]->jumlah_pengeluaran;
        $pemasukans = Pemasukan::join('kas','kas.id','pemasukans.kas_id')
                                        ->join('users','users.id','pemasukans.user_id')
                                        ->join('periodes','periodes.id','pemasukans.periode_id')
                                        ->select('nm_kas','tanggal_pemasukan','nm_user','periode','jumlah_pemasukan','sumber_pemasukan')
                                        ->where('kas.id',Auth::user()->kas_id)
                                        ->get();

        $pengeluarans = Pengeluaran::rightJoin('kas','kas.id','pengeluarans.kas_id')
                                        ->join('periodes','periodes.id','pengeluarans.periode_id')
                                        ->select('nm_kas','tanggal_pengeluaran','jumlah_pengeluaran','periode','keperluan')
                                        ->where('kas.id',Auth::user()->kas_id)
                                        ->get();
        return view('admin.dashboard',compact('saldo_awal','jumlah_pemasukan','jumlah_pengeluaran','saldo_akhir','pemasukans','pengeluarans'));
    }
}
