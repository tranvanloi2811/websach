<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <!-- css comfirm box -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="card-body">
    <h1 style="text-align: center">Thông tin tài khoản</h1>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 20%">
                    Tên Người Dùng
                </th>
                <th style="width:20%">
                    Điện Thoại
                </th>
                <th style="width: 20%">
                    Địa Chỉ
                </th>
                <th style="width: 20%">
                    Hình Ảnh
                </th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center">
                <td>{{$khachhang->TenKH}}</td>
                <td>{{$khachhang->DienThoai}}</td>
                <td>{{$khachhang->DiaChi}}</td>
                
                <td class="project_progress">
                    <img src="/storage/images/{{$khachhang->Img_KH}}" alt="" height="100px" width="100%">
                </td>
            </tr>         
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-12">
        <a href="/user" class="btn btn-secondary" style="float:right; margin-right: 2%">Thoát</a>
    </div>
</div>
<style>
    .card-body{
        padding-left: 15%;
        padding-right: 15%;
        padding-top: 5%;
    }
</style>
</body>
</html>