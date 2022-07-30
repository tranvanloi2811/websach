@extends('layouts.appadmin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách Loại Sách</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Loại Sách</li>
            </ol>
          </div>
        </div>
        <div class="add-book">
            <a href="{{route('admin.addloaisach')}}" class="btn btn-primary">Thêm mới loại sách</a>
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
            <h3 class="card-title">Danh sách Loại Sách</h3>

            <div class="float-right" style="display:flex">
              
              {{$loaisachs->links('vendor.pagination.paginate')}}
              
            </div>
            <input type="hidden" value="{{$paginates}}" id="value-pag">
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="width: 10%">
                            ID
                        </th>
                        <th style="width: 20%">
                            Tên Loại Sách
                        </th>
                        <th style="width:20%">
                            Ghi Chú
                        </th>
                        <th style="width: 10%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loaisachs as $loaisach)
                        <tr>
                            <td>{{$loaisach->id}}</td>
                            <td>{{$loaisach->TenLoaiSach}}</td>
                            <td>{{$loaisach->GhiChu}}</td>
                            <td class="project-actions text-right">
                                <div style="display: flex">
                                    <div>
                                        <a class="btn btn-info btn-sm" href="{{route('admin.editloaisach', $loaisach->id)}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Sửa
                                        </a>
                                    </div>
                                    <div style="padding-left:5px">
                                        <form action="{{route('admin.deleteloaisach', $loaisach->id)}}" method="POST">
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
            {{$loaisachs->links()}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <script>
        document.getElementById('paginationss').onchange = function() {
            window.location = "{!! $loaisachs->url(1) !!}&pagination=" + this.value; 
        };
        let valuePag = document.getElementById('value-pag').value;
        document.getElementById('paginationss').value = valuePag;
    </script>
@endsection