<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Pemasukan;
use App\User;
use App\Periode;
use App\BuktiPemasukan;

class PemasukanController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $users = User::all();
        $periode = Periode::where('status',1)->first();
        $pemasukans = Pemasukan::join('kas','kas.id','pemasukans.kas_id')
                                    ->join('users','users.id','pemasukans.user_id')
                                    ->join('periodes','periodes.id','pemasukans.periode_id')
                                    ->select('pemasukans.id as id','nm_user','periode','jumlah_pemasukan','sumber_pemasukan','tanggal_pemasukan','periodes.id as periode_id')
                                    ->where('kas.id',Auth::user()->kas_id)->get();
        return view('admin/pemasukans.index',compact('pemasukans','users','periode'));
    }

    public function post(Request $request){
        $model = $request->all();
        $pemasukan = new Pemasukan;
        $pemasukan->kas_id = Auth::user()->kas_id;
        $pemasukan->user_id =   $model['user_id'];
        $pemasukan->tanggal_pemasukan =   $model['tanggal_pemasukan'];
        $pemasukan->periode_id =   $model['periode_id'];
        $pemasukan->sumber_pemasukan =   $model['sumber_pemasukan'];
        $pemasukan->jumlah_pemasukan =   $model['jumlah_pemasukan'];
        $pemasukan->save();

        $model['bukti_pemasukan'] = null;

        if ($request->hasFile('bukti_pemasukan')){
            $model['bukti_pemasukan'] = '/upload/bukti_pemasukan/'.$model['user_id'].'-'.$model['tanggal_pemasukan'].'-'.$model['periode_id'].'.'.$request->bukti_pemasukan->getClientOriginalExtension();
            $request->bukti_pemasukan->move(public_path('/upload/bukti_pemasukan/'), $model['bukti_pemasukan']);
        }

        $bukti = new BuktiPemasukan;
        $bukti->bukti_pemasukan = $model['bukti_pemasukan'];
        $bukti->kas_id = Auth::user()->kas_id;
        $bukti->save();

        return redirect()->route('admin.pemasukan')->with(['success'    =>  'Pemasukan berhasil ditambahkan !!']);
    }

    public function edit($id){
        $users = User::all();
        $pemasukan = Pemasukan::leftJoin('bukti_pemasukans','bukti_pemasukans.pemasukan_id','pemasukans.id')->where('pemasukans.id',$id)
                    ->get();
        $periode = Periode::where('status',1)->first();
        return view('admin/pemasukans.form_edit',compact('pemasukan','users','periode'));
    }

    // public function update(){
    //     return 'a';
    // }
}
