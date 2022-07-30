<?php

namespace App\Http\Controllers;
use App\Models\NhaXuatBan;

use Illuminate\Http\Request;

class NhaXuatBanController extends Controller
{
    public function index(Request $request) {
        $paginates = $request->pagination ?? 5;
        $nhaxuatbans = NhaXuatBan::paginate($paginates);
        // ->get();

        return view('nhaxuatban_admin.index')->with('nhaxuatbans', $nhaxuatbans)
        ->with('paginates', $paginates);
    }

    public function create(){
        return view('nhaxuatban_admin.addnhaxuatban');
    }

    public function store(Request $request)
    {
       
        $this->validate($request,[
            'TenNhaXB' => 'required',
            'GhiChu' => 'required',
        ],[
            'TenNhaXB.required' => 'Bạn phải nhập tên nhà xuất bản!',
            'GhiChu.required' => 'Bạn phải nhập ghi chú!',
        ]);

        $nhaxuatban = new NhaXuatBan;
        $nhaxuatban->TenNhaXB = $request->input('TenNhaXB');
        $nhaxuatban->GhiChu = $request->input('GhiChu');
        $nhaxuatban->save();

        return redirect('admin/nhaxuatbans')->with('success', 'Thêm mới nhà xuất bản thành công!');
    }

    public function edit($id){
        $nhaxuatban = NhaXuatBan::find($id);
        return view('nhaxuatban_admin.editnhaxuatban')->with('nhaxuatban', $nhaxuatban);
    }

    public function update(Request $request, $id)
    {
       
        $this->validate($request,[
            'TenNhaXB' => 'required',
            'GhiChu' => 'required',
        ],[
            'TenLoaiSach.required' => 'Bạn phải nhập tên nhà xuất bản!',
            'GhiChu.required' => 'Bạn phải nhập ghi chú!',
        ]);

        $nhaxuatban = NhaXuatBan::find($id);
        
        $nhaxuatban->TenNhaXB = $request->input('TenLoaiSach');
        $nhaxuatban->GhiChu = $request->input('GhiChu');
        $nhaxuatban->save();

        return redirect('admin/nhaxuatbans')->with('success', 'Cập nhập thông tin nhà xuất bản thành công!');
    }

    public function destroy($id)
    {
        $nhaxuatban = NhaXuatBan::find($id);

        $nhaxuatban->delete();
        return redirect('admin/nhaxuatbans')->with('success', 'Xóa thành công');
    }
}
