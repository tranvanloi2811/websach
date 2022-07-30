@extends('layouts.appadmin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhập thông tin Khách Hàng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sửa TT Khách Hàng</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @include('inc.messages')
      <div class="row">
        <div class="col-md-6" style="max-width: 100%; flex: 0 0 100%">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <form action="{{route('admin.updatekhachhang', $khachhang->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Tên Khách Hàng</label>
                        <input type="text" id="inputName" name="TenKH" class="form-control" value="{{$khachhang->TenKH}}">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Điện Thoại</label>
                        <input type="text" id="inputName" name="DienThoai" class="form-control" value="{{$khachhang->DienThoai}}">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Địa Chỉ</label>
                        <input type="text" id="inputName" name="DiaChi" class="form-control" value="{{$khachhang->DiaChi}}">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Email</label>
                        <input type="text" id="inputName" name="email" class="form-control" value="{{$khachhang->email}}">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Password</label>
                        <input type="password" name="password" id="myInput" class="form-control" value="">
                        <input type="checkbox" onclick="myFunction()">Show Password
                    </div>
                    <div class="form-group">
                        <input type="file" name="Img_KH">
                    </div>
                    <input name="_method" type="hidden" value="PUT">
                    <input type="submit" value="Cập nhập" class="btn btn-success float-right">
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="/admin/khachhangs" class="btn btn-secondary" style="float:right; margin-right: 2%">Thoát</a>
          
        </div>
      </div>
    </section>

@endsection