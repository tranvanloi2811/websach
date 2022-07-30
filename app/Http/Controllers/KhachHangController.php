<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KhachHangController extends Controller
{
    public function index(Request $request){
        $paginates = $request->pagination ?? 5;
        $khachhangs = KhachHang::join('users', 'users.id','=','khachhang.id_user')
        ->select('khachhang.*', 'users.email', 'users.password')
        ->orderBy('khachhang.id', 'ASC')
        ->paginate($paginates);
        // ->get();

        return view('khachhang_admin.index')->with('khachhangs', $khachhangs)
        ->with('paginates', $paginates);
    }

    public function create(){
        return view('khachhang_admin.addkhachhang');
    }

    public function store(Request $request)
    {
       
        $this->validate($request,[
            'TenKH' => 'required',
            'email' => 'required',
            'password' => 'required',
            // 'Img_Sach' => 'image|nullable|max:1999',
        ],[
            'TenKH.required' => 'Bạn phải nhập tên sách!',
            'email.required' => 'Bạn phải nhập tác giả!',
            'password.required' => 'Bạn phải nhập giá bán sách!',
            // 'Img_Sach.image' => 'Bạn phải nhập file hình ảnh!',
        ]);
        // dd($request->TenSach);
        // dd($request->Ima_Sach);

        if($request->hasFile('Img_KH')){
            //get file name with extension - lấy tên file với phần mở rộng
            $filenameWithExt = $request->file('Img_KH')->getClientOriginalName();
            //get just filename - chỉ lấy tên tệp
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('Img_KH')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //uplaod image
            $path = $request->file('Img_KH')->storeAs('public/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $khachhang = new KhachHang;
        $user = new User;

        $khachhang->TenKH = $request->input('TenKH');
        $khachhang->DienThoai = $request->input('DienThoai');
        $khachhang->DiaChi = $request->input('DiaChi');
        $khachhang->Img_KH = $fileNameToStore;

        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        $user->role = 0;
        $user->save();

        $khachhang->id_user = $user->id;
        $khachhang->save();

        return redirect('admin/khachhangs')->with('success', 'Thêm mới khách hàng thành công!');
    }

    public function edit($id){
        $khachhang = KhachHang::join('users', 'users.id','=','khachhang.id_user')
        ->select('khachhang.*', 'users.email', 'users.password')->find($id);
        return view('khachhang_admin.editkhachhang')->with('khachhang', $khachhang);
    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request,[
            'TenKH' => 'required',
            'email' => 'required',
            // 'password' => 'required',
            // 'Img_Sach' => 'image|nullable|max:1999',
        ],[
            'TenKH.required' => 'Bạn phải nhập tên khách hàng!',
            'email.required' => 'Bạn phải nhập email!',
            // 'password.required' => 'Bạn phải nhập mật khẩu!',
            // 'Img_Sach.image' => 'Bạn phải nhập file hình ảnh!',
        ]);
        // dd($request->TenSach);
        // dd($request->file('Img_Sach'));

        $khachhang = KhachHang::find($id);
        $old_image = $khachhang->Img_KH;
        // dd($old_image);

        if($request->hasFile('Img_KH')){
            //nếu file hình đang là noimage.jpg thì không xóa ảnh, còn ko phải thì sẽ xóa
            if($old_image != 'noimage.jpg')
            {
                $old_images = public_path("storage/images/". $old_image);
                if (File::exists($old_images)) { 
                    unlink($old_images);
                }
            }
            //xóa file cũ khỏi thư mục để thêm file mới vào 
            

            //get file name with extension - lấy tên file với phần mở rộng
            $filenameWithExt = $request->file('Img_KH')->getClientOriginalName();
            //get just filename - chỉ lấy tên tệp
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('Img_KH')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //uplaod image
            $path = $request->file('Img_KH')->storeAs('public/images', $fileNameToStore);
        }

        
        $user = User::find($khachhang->id_user);

        $old_password = $user->password;
        
        $khachhang->TenKH = $request->input('TenKH');
        $khachhang->DienThoai = $request->input('DienThoai');
        $khachhang->DiaChi = $request->input('DiaChi');

        if($request->hasFile('Img_KH')){
            $khachhang->Img_KH = $fileNameToStore;
        }
        else{
            $khachhang->Img_KH = $old_image;
        }

        $user->email = $request->input('email');

        // nếu nhập mật khẩu mới thì đổi, không thì dữ nguyên
        if($request->password == ''){
            $user->password = $old_password;
        }
        else{
            $user->password = Hash::make($request->password);
        }
        $user->role = 0;
        $user->save();

        $khachhang->id_user = $user->id;
        $khachhang->save();

        return redirect('admin/khachhangs')->with('success', 'Cập nhập thông tin khách hàng thành công!');
    }

    public function destroy($id)
    {
        //
        $khachhang = KhachHang::find($id);

        $user = User::find($khachhang->id_user);

        // dd($sach->Img_Sach);

        if($khachhang->Img_KH != 'noimage.jpg'){
            Storage::delete('public/images/'.$khachhang->Img_KH);
        }
        
        $khachhang->delete();
        $user->delete();
        
        return redirect('admin/khachhangs')->with('success', 'Xóa thành công');
    }
}
