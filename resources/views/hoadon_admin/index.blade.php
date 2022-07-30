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
              <li class="breadcrumb-item active">Hóa Đơn</li>
            </ol>
          </div>
        </div>
        <!-- <div class="add-book">
            <a href="{{route('admin.addsach')}}" class="btn btn-primary">Thêm mới sách</a>
        </div> -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @include('inc.messages')
      @include('inc.timeout')
      <!-- Default box -->
      <div class="card">
        
        <div class="card-header">
            <h3 class="card-title">Danh sách Hóa Đơn</h3>

            <div class="float-right" style="display:flex">
              
              {{$hoadons->links('vendor.pagination.paginate')}}
              
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
                        <th style="width:20%">
                            Ngày Đặt Hàng
                        </th>
                        <th style="width: 20%">
                            Trạng Thái
                        </th>
                        <th style="width: 20%">
                            Tổng Tiền
                        </th>
                        <th style="width: 10%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hoadons as $hoadon)
                        <tr>
                            <td>{{$hoadon->id}}</td>
                            <td>{{$hoadon->TenKH}}</td>
                            <td>{{$hoadon->NgayMua}}</td>
                            
                            <td class="project_progress">
                                {{$hoadon->TrangThai}}
                            </td>
                            <td class="project-state">
                                {{$hoadon->TongTien}}
                            </td>
                            <td>
                            <div>
                                <a class="btn btn-info btn-sm" href="{{route('admin.detailhoadon', $hoadon->id)}}">
                                    Chi Tiết
                                </a>
                            </div>
                            </td>
                        </tr>
                    @endforeach            
                </tbody>
            </table>
            {{$hoadons->links()}}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    <script>
        document.getElementById('paginationss').onchange = function() {
            window.location = "{!! $hoadons->url(1) !!}&pagination=" + this.value; 
        };
        let valuePag = document.getElementById('value-pag').value;
        document.getElementById('paginationss').value = valuePag;
    </script>
@endsection