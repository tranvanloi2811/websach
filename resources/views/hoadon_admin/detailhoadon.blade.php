@extends('layouts.appadmin')
@section('content')

    
    <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 2%">
                            ID
                        </th>
                        <th style="width: 20%">
                            Mã hóa đơn
                        </th>
                        <th style="width:20%">
                            Tên sách
                        </th>
                        <th style="width: 20%">
                            Gía sách
                        </th>
                        <th style="width: 20%">
                            Số Lượng
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chitiethoadons as $chitiethoadon)
                        <tr>
                            <td>{{$chitiethoadon->id}}</td>
                            <td>{{$chitiethoadon->id_HoaDon}}</td>
                            <td>{{$chitiethoadon->TenSach}}</td>
                            
                            <td class="project_progress">
                                {{$chitiethoadon->GiaBan}}
                            </td>
                            <td class="project-state">
                                {{$chitiethoadon->SoLuong}}
                            </td>
                        </tr>
                    @endforeach            
                </tbody>
            </table>
        </div>
    <div class="row">
        <div class="col-12">
            <a href="/admin/hoadons" class="btn btn-secondary" style="float:right; margin-right: 2%">Thoát</a>
        </div>
    </div>

@endsection