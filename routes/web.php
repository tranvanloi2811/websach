<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SachController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\LoaiSachController;
use App\Http\Controllers\NhaXuatBanController;

use App\Models\Sach;
use App\Models\LoaiSach;
use App\Models\KhachHang;

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $sachs = Sach::paginate(5);
    $loaisachs = LoaiSach::all();
    // dd($loaisachs);
    return view('layouts.app_listsach')->with('sachs', $sachs)->with('loaisachs', $loaisachs);
    
});

Route::get('/loaisach/{loaisach}', function ($id) {
    // $sachs = Sach::join('loaisach', 'loaisach.id','=','sach.id_LoaiSach')
    // ->join('nhaxuatban', 'nhaxuatban.id','=','sach.id_NhaXB')
    // ->select('sach.*', 'loaisach.TenLoaiSach', 'nhaxuatban.TenNhaXB')->find($id);

    $sachs = Sach::join('loaisach', 'loaisach.id','=','sach.id_LoaiSach')
    ->select('sach.*', 'loaisach.TenLoaiSach')
    ->where('sach.id_LoaiSach','=',$id)
    ->get();

    $tenloaisach = LoaiSach::select('TenLoaiSach')
    ->where('id','=',$id)->get();
    // dd($tenloaisach);

    // dd($sachs);

    $loaisachs = LoaiSach::all();
    // dd($loaisachs);
    return view('user.listloaisach')->with('sachs', $sachs)->with('loaisachs', $loaisachs)->with('tenloaisach', $tenloaisach);
});

Route::get('/sach/{sach}', function($id) {
    $loaisachs = LoaiSach::all();
    $sach = Sach::join('loaisach', 'loaisach.id','=','sach.id_LoaiSach')
    ->join('nhaxuatban', 'nhaxuatban.id','=','sach.id_NhaXB')
    ->select('sach.*', 'loaisach.TenLoaiSach', 'nhaxuatban.TenNhaXB')->find($id);
    if(Auth::check())
    {
        $khachhang = KhachHang::where('id_user', Auth::id())->first();
    }
    return view('user.detail_sach')->with('sach', $sach)->with('loaisachs', $loaisachs)->with('khachhang', $khachhang);
});

Route::get('/search', function(Request $request) {
    $search = $request->input('search');

    $sachs = Sach::where('TenSach', 'LIKE', "%{$search}%")
    ->get();

    $loaisachs = LoaiSach::all();

    return view('user.listsearch')->with('sachs', $sachs)->with('loaisachs', $loaisachs)->with('search', $search);
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/registers', [RegisterController::class, 'create'])->name('registers');

Route::get('/test', [UserController::class, 'index1'])->name('test');

Route::group(['prefix'=>'admin', 'middleware'=>'isAdmin'], function(){
    Route::get('/',[AdminController::class, 'index'])->name('admin');
    Route::get('/sachs',[SachController::class, 'index'])->name('admin.sachs');
    Route::get('/sach', [SachController::class, 'create'])->name('admin.addsach');
    Route::post('/sach', [SachController::class, 'store'])->name('admin.addsachs');
    Route::get('/sach/{sach}/edit', [SachController::class, 'edit'])->name('admin.editsach');
    Route::put('/sach/{sach}', [SachController::class, 'update'])->name('admin.updatesach');
    Route::delete('/sach/{sach}', [SachController::class, 'destroy'])->name('admin.deletesach');

    Route::get('/khachhangs',[KhachHangController::class, 'index'])->name('admin.khachhangs');
    Route::get('/khachhang', [KhachHangController::class, 'create'])->name('admin.addkhachhang');
    Route::post('/khachhang', [KhachHangController::class, 'store'])->name('admin.addkhachhangs');
    Route::get('/khachhang/{khachhang}/edit', [KhachHangController::class, 'edit'])->name('admin.editkhachhang');
    Route::put('/khachhang/{khachhang}', [KhachHangController::class, 'update'])->name('admin.updatekhachhang');
    Route::delete('/khachhang/{khachhang}', [KhachHangController::class, 'destroy'])->name('admin.deletekhachhang');

    Route::get('/loaisachs',[LoaiSachController::class, 'index'])->name('admin.loaisachs');
    Route::get('/loaisach', [LoaiSachController::class, 'create'])->name('admin.addloaisach');
    Route::post('/loaisach', [LoaiSachController::class, 'store'])->name('admin.addloaisachs');
    Route::get('/loaisach/{loaisach}/edit', [LoaiSachController::class, 'edit'])->name('admin.editloaisach');
    Route::put('/loaisach/{loaisach}', [LoaiSachController::class, 'update'])->name('admin.updateloaisach');
    Route::delete('/loaisach/{loaisach}', [LoaiSachController::class, 'destroy'])->name('admin.deleteloaisach');

    Route::get('/nhaxuatbans',[NhaXuatBanController::class, 'index'])->name('admin.nhaxuatbans');
    Route::get('/nhaxuatban', [NhaXuatBanController::class, 'create'])->name('admin.addnhaxuatban');
    Route::post('/nhaxuatban', [NhaXuatBanController::class, 'store'])->name('admin.addnhaxuatbans');
    Route::get('/nhaxuatban/{nhaxuatban}/edit', [NhaXuatBanController::class, 'edit'])->name('admin.editnhaxuatban');
    Route::put('/nhaxuatban/{nhaxuatban}', [NhaXuatBanController::class, 'update'])->name('admin.updatenhaxuatban');
    Route::delete('/nhaxuatban/{nhaxuatban}', [NhaXuatBanController::class, 'destroy'])->name('admin.deletenhaxuatban');

    Route::get('/hoadons',[HoaDonController::class, 'index'])->name('admin.hoadons');
    Route::get('/hoadon/{hoadon}/detail', [HoaDonController::class, 'detail'])->name('admin.detailhoadon');
});

Route::group(['prefix'=>'user', 'middleware'=>'isUser'], function(){
    Route::get('/',[UserController::class, 'index'])->name('user');
    Route::get('/thongtinkh/{kh}',[UserController::class, 'detail'])->name('user.detail');
    Route::get('/loaisach/{loaisach}',[UserController::class, 'locloaisach']);
    Route::get('/search',[UserController::class, 'searchsach']);

    Route::get('/cart', [CartController::class, 'viewcart'])->name('viewcart');
    Route::post('/ordercart', [CartController::class, 'add_order_oddetail'])->name('ordercart');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('user.deletecart');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updatecart');
});

Route::post('/add-to-cart', [CartController::class, 'addSach'])->name('addtocart');

