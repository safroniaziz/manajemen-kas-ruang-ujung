<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Periode;

class PengaturanPeriodeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $periodes = Periode::select('id','periode','status')->get();
        return view('admin/pengaturan_periode.index',compact('periodes'));
    }
}
