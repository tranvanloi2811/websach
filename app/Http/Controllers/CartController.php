<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\LoaiSach;
use App\Models\Sach;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\KhachHang;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CartController extends Controller
{
    public function addSach(Request $request)
    {
        $id_sach = $request ->input('sach_id');
        $sach_quantity = $request -> input('sach_qty');
        // $sach = Sach::find($id_sach);

        

        if(Auth::check())
        {
            
            $sach_check = Sach::where('id', $id_sach)->first();
            
            if(Cart::where('id_sach', $id_sach)->where('id_user', Auth::id())->exists())
            {
                return response()->json(
                    ['status' => $sach_check->name."Đã có trong giỏ hàng!"
                ]);
                // return view('user.detail_sach')->with('sach', $sach)->with('success', 'Đã có trong giỏ hàng!'); 
            }
            else
            {
                // dd('hello');
                $cartItem = new Cart();
                $cartItem->id_sach = $id_sach;
                $cartItem->id_user = Auth::id();
                $cartItem->sach_quantity = $sach_quantity;
                $cartItem->save();
                return response()->json([
                    'status' => $sach_check->TenSach."Thêm thành công vào giỏ!"
                ]);
            }
        }
        else
        {
            return response()->json(
                ['status' => "Hãy đăng nhập để tiếp tục!"]
            );
        }   
    }

    public function viewcart()
    {
        $id = Auth::id();
        // dd($id);
        // $carts = Cart::where('id_user', Auth::id());
        $carts = Cart::where('id_user', $id)
        ->join('sach', 'sach.id','=','carts.id_sach')
        ->select('carts.*', 'sach.TenSach', 'sach.Img_Sach', 'sach.GiaBan')->get();
        // dd($carts);
        // $total = 0;
        // foreach($carts as $cart)
        // {
        //     $total += ($cart->GiaBan * $cart->sach_quantity);
        // }

        $loaisachs = LoaiSach::all();
        if(Auth::check())
        {
            $khachhang = KhachHang::where('id_user', Auth::id())->first();
        }

        return view('user.listcart')->with('carts', $carts)->with('loaisachs', $loaisachs)->with('khachhang', $khachhang); 
        // ->with('total', $total)
    }

    public function add_order_oddetail(Request $request){
        $total = $request ->input('total');
        $hoadon = new HoaDon();
        $datetime = Carbon::now();
        $datenow = $datetime->format("Y-m-d");
        $hoadon->NgayMua = $datenow;
        $hoadon->TrangThai = "Đang giao hàng";
        $hoadon->TongTien = $total;

        // dd($hoadon->TongTien);

        $id_kh = KhachHang::where('id_user', '=', Auth::id())
        ->select('khachhang.id')->get();

        $id_khachhang = 0;
        foreach($id_kh as $id)
        {
            $id_khachhang = $id->id;
        }

        // dd($id_khachhang);

        $hoadon->id_KhachHang = $id_khachhang;

        $hoadon->save();

        $id_hd = $hoadon->id;


        
        // dd($hoadon);
        

        $cartitems = Cart::where('id_user', Auth::id())->get();

        foreach($cartitems as $item)
        {

            $sachban = Sach::where('id', '=', $item->id_sach)
            ->select('sach.GiaBan')->get();
            $giaban = 0;
            foreach($sachban as $sb)
            {
                $giaban = $sb->GiaBan;
            }

            // dd($giaban);

            // dd($hoadon->id);

            $cthd = new ChiTietHoaDon;
            $cthd->GiaBan = $giaban;
            $cthd->SoLuong = $item->sach_quantity;
            $cthd->id_HoaDon = $id_hd;
            $cthd->id_Sach = $item->id_sach;
            $cthd->save();

            // ChiTietHoaDon::create([
            //     'GiaBan' => $giaban,
            //     'SoLuong' => $item->sach_quantity,
            //     'id_HoaDon' => $hoadon->id,
            //     'id_Sach' => $item->id_sach,
            // ]);

            $item->delete();
        }

        // $cartitems->delete();

        // $cartitems->save();

        // $request->session()->forget($cart);
         
        return redirect('user/cart')->with('success', 'Đặt hàng thành công');
    }
    
    public function updateCart(Request $request)
    {
        $id_cart = $request ->input('id_cart');
        $sach_quantity = $request -> input('sach_qty');
        // $sach = Sach::find($id_sach);

        // dd($id_cart);

        if(Auth::check())
        {
            
            if(Cart::where('id', $id_cart)->where('id_user', Auth::id())->exists())
            {
                $cart = Cart::where('id', $id_cart)->where('id_user', Auth::id())->first();
                $cart->sach_quantity = $sach_quantity;
                $cart->update();
                return response()->json([
                    'status' => "Sửa số lượng thành công!"
                ]);
            }
        }
        // else
        // {
        //     return response()->json(
        //         ['status' => "Hãy đăng nhập để tiếp tục!"]
        //     );
        // }   
    }

    public function destroy($id)
    {
        //
        $cart = Cart::find($id);

        $cart->delete();
        return redirect('user/cart')->with('success', 'Xóa thành công');
    }
}
