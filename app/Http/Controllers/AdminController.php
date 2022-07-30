<?php

namespace App\Http\Controllers;
use App\Models\KhachHang;
use App\Models\HoaDon;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $countHD = HoaDon::count();
        $countKH = KhachHang::count();
        return view('layouts.dashboard')->with('countHD', $countHD)->with('countKH', $countKH);
    }
}
