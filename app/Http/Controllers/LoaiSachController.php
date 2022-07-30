<?php

namespace App\Http\Controllers;
use App\Models\LoaiSach;

use Illuminate\Http\Request;

class LoaiSachController extends Controller
{
    public function index(Request $request) {
        $paginates = $request->pagination ?? 5;
        $loaisachs = LoaiSach::paginate($paginates);
        // ->get();

        return view('loaisach_admin.index')->with('loaisachs', $loaisachs)
        ->with('paginates', $paginates);
    }

    public function create(){
        return view('loaisach_admin.addloaisach');
    }

    public function store(Request $request)
    {
       
        $this->validate($request,[
            'TenLoaiSach' => 'required',
            'GhiChu' => 'required',
        ],[
            'TenLoaiSach.required' => 'Bạn phải nhập tên loại sách!',
            'GhiChu.required' => 'Bạn phải nhập ghi chú!',
        ]);

        $loaisach = new LoaiSach;
        $loaisach->TenLoaiSach = $request->input('TenLoaiSach');
        $loaisach->GhiChu = $request->input('GhiChu');
        $loaisach->save();

        return redirect('admin/loaisachs')->with('success', 'Thêm mới loại sách thành công!');
    }

    public function edit($id){
        $loaisach = LoaiSach::find($id);
        return view('loaisach_admin.editloaisach')->with('loaisach', $loaisach);
    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request,[
            'TenLoaiSach' => 'required',
            'GhiChu' => 'required',
        ],[
            'TenLoaiSach.required' => 'Bạn phải nhập tên loại sách!',
            'GhiChu.required' => 'Bạn phải nhập ghi chú!',
        ]);

        $loaisach = LoaiSach::find($id);
        
        $loaisach->TenLoaiSach = $request->input('TenLoaiSach');
        $loaisach->GhiChu = $request->input('GhiChu');
        $loaisach->save();

        return redirect('admin/loaisachs')->with('success', 'Cập nhập thông tin loại sách thành công!');
    }

    public function destroy($id)
    {
        $loaisach = LoaiSach::find($id);

        $loaisach->delete();
        return redirect('admin/loaisachs')->with('success', 'Xóa thành công');
    }
}
