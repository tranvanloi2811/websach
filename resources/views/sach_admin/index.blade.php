@extends('layouts.appadmin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách Sách</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sách</li>
            </ol>
          </div>
        </div>
        <div class="add-book">
            <a href="{{route('admin.addsach')}}" class="btn btn-primary">Thêm mới sách</a>
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
            <h3 class="card-title">Danh sách Sách</h3>

            <div class="float-right" style="display:flex">
              
              {{$sachs->links('vendor.pagination.paginate')}}
              
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
                            Tên Sách
                        </th>
                        <th style="width:20%">
                            Tên Tác Giả
                        </th>
                        <th style="width: 10%">
                            Giá Bán
                        </th>
                        <th style="width: 10%">
                            Hình Ảnh
                        </th>
                        <th style="width: 14%">
                            Nhà Xuất Bản
                        </th>
                        <th style="width: 14%">
                            Loại Sách
                        </th>
                        <th style="width: 10%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sachs as $sach)
                        <tr>
                            <td>{{$sach->id}}</td>
                            <td>{{$sach->TenSach}}</td>
                            <td>{{$sach->TacGia}}</td>
                            
                            <td class="project_progress">
                                {{$sach->GiaBan}}
                            </td>
                            <td>
                                <img src="/storage/images/{{$sach->Img_Sach}}" height="100px" width="100%">
                            </td>
                            <td class="project-state">
                                {{$sach->TenNhaXB}}
                            </td>
                            <td>{{$sach->TenLoaiSach}}</td>
                            <td class="project-actions text-right">
                                <div style="display: flex">
                                    <div>
                                        <a class="btn btn-info btn-sm" href="{{route('admin.editsach', $sach->id)}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Sửa
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{route('admin.deletesach', $sach->id)}}" method="POST">
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
            {{$sachs->links()}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <script>
        document.getElementById('paginationss').onchange = function() {
            window.location = "{!! $sachs->url(1) !!}&pagination=" + this.value; 
        };
        let valuePag = document.getElementById('value-pag').value;
        document.getElementById('paginationss').value = valuePag;
    </script>
@endsection