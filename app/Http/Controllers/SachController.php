<?php

namespace App\Http\Controllers;

use App\Models\Sach;
use App\Models\LoaiSach;
use App\Models\NhaXuatBan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

class SachController extends Controller
{
    public function index(Request $request) {
        $paginates = $request->pagination ?? 5;
        $sachs = Sach::join('loaisach', 'loaisach.id','=','sach.id_LoaiSach')
        ->join('nhaxuatban', 'nhaxuatban.id','=','sach.id_NhaXB')
        ->select('sach.*', 'loaisach.TenLoaiSach', 'nhaxuatban.TenNhaXB')
        ->orderBy('sach.id', 'ASC')
        ->paginate($paginates);
        // ->get();

        return view('sach_admin.index')->with('sachs', $sachs)
        ->with('paginates', $paginates);
    }

    public function create(){
        $loaisachs = LoaiSach::all();
        $nhaxuatbans = NhaXuatBan::all();
        return view('sach_admin.addsach')->with('loaisachs', $loaisachs)->with('nhaxuatbans', $nhaxuatbans);
    }

    public function store(Request $request)
    {
       
        $this->validate($request,[
            'TenSach' => 'required',
            'TacGia' => 'required',
            'GiaBan' => 'required',
            'id_LoaiSach' => 'required',
            'id_NhaXB' => 'required',
            // 'Img_Sach' => 'image|nullable|max:1999',
        ],[
            'TenSach.required' => 'Bạn phải nhập tên sách!',
            'TacGia.required' => 'Bạn phải nhập tác giả!',
            'GiaBan.required' => 'Bạn phải nhập giá bán sách!',
            'id_LoaiSach.required' => 'Bạn phải nhập mã loại sách!',
            'id_NhaXB.required' => 'Bạn phải nhập mã nhà xuất bản!',
            // 'Img_Sach.image' => 'Bạn phải nhập file hình ảnh!',
        ]);
        // dd($request->TenSach);
        // dd($request->Ima_Sach);

        if($request->hasFile('Img_Sach')){
            //get file name with extension - lấy tên file với phần mở rộng
            $filenameWithExt = $request->file('Img_Sach')->getClientOriginalName();
            //get just filename - chỉ lấy tên tệp
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('Img_Sach')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //uplaod image
            $path = $request->file('Img_Sach')->storeAs('public/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $sach = new Sach;
        $sach->TenSach = $request->input('TenSach');
        $sach->TacGia = $request->input('TacGia');
        $sach->GiaBan = $request->input('GiaBan');
        $sach->Img_Sach = $request->input('Img_Sach');
        $sach->id_LoaiSach = $request->input('id_LoaiSach');
        $sach->id_NhaXB = $request->input('id_NhaXB');
        $sach->Img_Sach = $fileNameToStore;
        $sach->save();

        return redirect('admin/sachs')->with('success', 'Thêm mới sách thành công!');
    }

    public function edit($id){
        $sach = Sach::join('loaisach', 'loaisach.id','=','sach.id_LoaiSach')
        ->join('nhaxuatban', 'nhaxuatban.id','=','sach.id_NhaXB')
        ->select('sach.*', 'loaisach.TenLoaiSach', 'nhaxuatban.TenNhaXB')->find($id);
        $loaisachs = LoaiSach::all();
        $nhaxuatbans = NhaXuatBan::all();
        return view('sach_admin.editsach')->with('sach', $sach)->with('loaisachs', $loaisachs)->with('nhaxuatbans', $nhaxuatbans);
    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request,[
            'TenSach' => 'required',
            'TacGia' => 'required',
            'GiaBan' => 'required',
            'id_LoaiSach' => 'required',
            'id_NhaXB' => 'required',
            // 'Img_Sach' => 'image|nullable|max:1999',
        ],[
            'TenSach.required' => 'Bạn phải nhập tên sách!',
            'TacGia.required' => 'Bạn phải nhập tác giả!',
            'GiaBan.required' => 'Bạn phải nhập giá bán sách!',
            'id_LoaiSach.required' => 'Bạn phải nhập mã loại sách!',
            'id_NhaXB.required' => 'Bạn phải nhập mã nhà xuất bản!',
            // 'Img_Sach.image' => 'Bạn phải nhập file hình ảnh!',
        ]);
        // dd($request->TenSach);
        // dd($request->file('Img_Sach'));

        $sach = Sach::find($id);
        $old_image = $sach->Img_Sach;
        // dd($old_image);

        if($request->hasFile('Img_Sach')){
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
            $filenameWithExt = $request->file('Img_Sach')->getClientOriginalName();
            //get just filename - chỉ lấy tên tệp
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('Img_Sach')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            //uplaod image
            $path = $request->file('Img_Sach')->storeAs('public/images', $fileNameToStore);
        }

        

        
        $sach->TenSach = $request->input('TenSach');
        $sach->TacGia = $request->input('TacGia');
        $sach->GiaBan = $request->input('GiaBan');
        $sach->Img_Sach = $request->input('Img_Sach');
        $sach->id_LoaiSach = $request->input('id_LoaiSach');
        $sach->id_NhaXB = $request->input('id_NhaXB');
        if($request->hasFile('Img_Sach')){
            $sach->Img_Sach = $fileNameToStore;
        }
        else{
            $sach->Img_Sach = $old_image;
        }
        $sach->save();

        // dd($sach);

        return redirect('admin/sachs')->with('success', 'Cập nhập thông tin sách thành công!');
    }

    public function destroy($id)
    {
        //
        $sach = Sach::find($id);

        // dd($sach->Img_Sach);

        if($sach->Img_Sach != 'noimage.jpg'){
            Storage::delete('public/images/'.$sach->Img_Sach);
        }

        $sach->delete();
        return redirect('admin/sachs')->with('success', 'Xóa thành công');
    }
}
