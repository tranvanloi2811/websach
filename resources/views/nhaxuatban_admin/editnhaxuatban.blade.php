@extends('layouts.appadmin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhập thông tin Loại Sách</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sửa Nhà Xuất Bản</li>
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
                <form action="{{route('admin.updatenhaxuatban', $nhaxuatban->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Tên Nhà Xuất Bản</label>
                        <input type="text" id="inputName" name="TenNhaXB" class="form-control" value="{{$nhaxuatban->TenNhaXB}}">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Ghi Chú</label>
                        <input type="text" id="inputName" name="GhiChu" class="form-control" value="{{$nhaxuatban->GhiChu}}">
                    </div>
                    <input name="_method" type="hidden" value="PUT">
                    <input type="submit" value="Sửa loại sách" class="btn btn-success float-right">
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="/admin/nhaxuatbans" class="btn btn-secondary" style="float:right; margin-right: 2%">Thoát</a>
          
        </div>
      </div>
    </section>

@endsection