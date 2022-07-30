<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sach;
use App\Models\LoaiSach;
use App\Models\KhachHang;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $sachs = Sach::paginate(5);
        $loaisachs = LoaiSach::all();
        if(Auth::check())
        {
            $khachhang = KhachHang::where('id_user', Auth::id())->first();
        }

        return view('layouts.app_listsach')->with('sachs', $sachs)->with('loaisachs', $loaisachs)->with('khachhang', $khachhang);
    }
    public function detail($id){
        $khachhang = KhachHang::find($id);

        // dd($khachhang);

        return view('user.detailuser')->with('khachhang', $khachhang);
    }
    public function locloaisach($id){
        $sachs = Sach::join('loaisach', 'loaisach.id','=','sach.id_LoaiSach')
        ->select('sach.*', 'loaisach.TenLoaiSach')
        ->where('sach.id_LoaiSach','=',$id)
        ->get();

        $tenloaisach = LoaiSach::select('TenLoaiSach')
        ->where('id','=',$id)->get();
        // dd($tenloaisach);

        // dd($sachs);

        $loaisachs = LoaiSach::all();

        if(Auth::check())
        {
            $khachhang = KhachHang::where('id_user', Auth::id())->first();
        }
        // dd($loaisachs);
        return view('user.listloaisach')->with('sachs', $sachs)->with('loaisachs', $loaisachs)->with('tenloaisach', $tenloaisach)->with('khachhang', $khachhang);
    }

    public function searchsach(Request $request){
        $search = $request->input('search');

        $sachs = Sach::where('TenSach', 'LIKE', "%{$search}%")
        ->get();

        $loaisachs = LoaiSach::all();

        if(Auth::check())
        {
            $khachhang = KhachHang::where('id_user', Auth::id())->first();
        }
        
        return view('user.listsearch')->with('sachs', $sachs)->with('loaisachs', $loaisachs)->with('search', $search)->with('khachhang', $khachhang);
    }
}
