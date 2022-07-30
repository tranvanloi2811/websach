@extends('layouts.appadmin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách Khách Hàng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Khách Hàng</li>
            </ol>
          </div>
        </div>
        <div class="add-book">
            <a href="{{route('admin.addkhachhang')}}" class="btn btn-primary">Thêm mới Khách Hàng</a>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @include('inc.messages')
      @include('inc.timeout')
      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
            <h3 class="card-title">Danh sách khách hàng</h3>

            <div class="float-right" style="display:flex">
              
              {{$khachhangs->links('vendor.pagination.paginate')}}
              
            </div>
            <input type="hidden" value="{{$paginates}}" id="value-pag">
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 2%">
                            ID
                        </th>
                        <th style="width: 20%">
                            Tên Khách Hàng
                        </th>
                        <th style="width: 20%">
                            Tài khoản
                        </th>
                        <th style="width: 20%">
                            Điện Thoại
                        </th>
                        <th style="width: 20%">
                            Địa Chỉ
                        </th>
                        <th style="width: 10%">
                            Hình Ảnh
                        </th>
                        <th style="width: 10%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($khachhangs as $khachhang)
                        <tr>
                            <td>{{$khachhang->id}}</td>
                            <td>{{$khachhang->TenKH}}</td>
                            <td class="project-state">
                                {{$khachhang->email}}
                            </td>
                            <td>{{$khachhang->DienThoai}}</td>
                            
                            <td class="project_progress">
                                {{$khachhang->DiaChi}}
                            </td>
                            <td>
                                @if($khachhang->Img_KH != "")
                                    <img src="/storage/images/{{$khachhang->Img_KH}}" height="100px" width="100%">
                                @else
                                    <img src="/storage/images/noimage.jpg" height="100px" width="100%">  
                                @endif
                            </td>
                            
                            <!-- thiết lập chữ tự xuống dòng khi vượt kích thước -->
                            <!-- <td style="word-break: break-all">
                                
                            </td> -->
                            <td class="project-actions text-right">
                                <div style="display: flex">
                                    <div>
                                        <a class="btn btn-info btn-sm" href="{{route('admin.editkhachhang', $khachhang->id)}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Sửa
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{route('admin.deletekhachhang', $khachhang->id)}}" method="POST">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button class="btn btn-danger btn-sm show-confirm" type="submit" data-toggle="tooltip" title='Delete'>
                                                <i class="fas fa-trash">
                                                </i>
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach            
                </tbody>
            </table>
            {{$khachhangs->links()}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <script>
        document.getElementById('paginationss').onchange = function() {
            window.location = "{!! $khachhangs->url(1) !!}&pagination=" + this.value; 
        };
        let valuePag = document.getElementById('value-pag').value;
        document.getElementById('paginationss').value = valuePag;
    </script>
@endsection