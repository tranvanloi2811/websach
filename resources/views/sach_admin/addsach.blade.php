@extends('layouts.appadmin')
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm mới Sách</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Thêm Sách</li>
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
                <form action="{{route('admin.addsachs')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputName">Tên Sách</label>
                        <input type="text" id="inputName" name="TenSach" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Tác Giả</label>
                        <input type="text" id="inputName" name="TacGia" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Giá Sách</label>
                        <input type="text" id="inputName" name="GiaBan" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Nhà Xuất Bản</label>
                        <!-- <input type="text" id="inputName" name="NhaXuatBan" class="form-control" value=""> -->
                        <select id="inputStatus" class="form-control custom-select" name="id_NhaXB">
                          <option selected disabled>Chọn nhà xuất bản</option>
                          @foreach($nhaxuatbans as $nhaxuatban)
                            <option value="{{$nhaxuatban->id}}">{{$nhaxuatban->id}} | {{$nhaxuatban->TenNhaXB}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Loại Sách</label>
                        <!-- <input type="text" id="inputName" name="NhaXuatBan" class="form-control" value=""> -->
                        <select id="inputStatus" class="form-control custom-select" name="id_LoaiSach">
                          <option selected disabled>Chọn loại sách</option>
                          @foreach($loaisachs as $loaisach)
                            <option value="{{$loaisach->id}}">{{$loaisach->id}} | {{$loaisach->TenLoaiSach}}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="Img_Sach">
                    </div>
                    <input type="submit" value="Thêm mới sách" class="btn btn-success float-right">
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="/admin/sachs" class="btn btn-secondary" style="float:right; margin-right: 2%">Thoát</a>
          
        </div>
      </div>
    </section>

@endsection