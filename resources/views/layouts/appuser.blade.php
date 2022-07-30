<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sach TL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/../../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="nav-menu">
        <div class="logo" style="float:left; width:30%">
            <a class="navbar-brand" href="javascript:void(0)">Sách TL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="mynavbar" style="width:70%">
            <ul class="navbar-nav me-auto" style="width:100%">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/">Trang Chủ</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/user">Trang Chủ</a>
                    </li>
                @endguest
                <!-- <li class="nav-item dropdown">
                        <button onclick="myFunction()" class="dropbtn">Loại Sách 
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="#">Link 1</a>
                            <a href="#">Link 2</a>
                            <a href="#">Link 3</a>
                        </div>
                </li> -->
                <li class="nav-item dropdown">
                    <button onclick="myFunction()" class="nav-link btn-ls dropbtn">
                        Loại Sách
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                        @foreach($loaisachs as $loaisach)
                            @guest
                                <a href="/loaisach/{{$loaisach->id}}">{{$loaisach->TenLoaiSach}}</a>
                            @else
                                <a href="/user/loaisach/{{$loaisach->id}}">{{$loaisach->TenLoaiSach}}</a>
                            @endguest
                        @endforeach
                    </div>
                    <!-- <a class="nav-link" href="#">Loại Sách</a> -->
                </li>
            </ul>
        </div>
    </div>
    
      
    
    <div class="search">
        @guest
            <form class="d-flex" action="/search" method="GET">
                <input class="form-control me-2" type="text" name="search" placeholder="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        @else
            <form class="d-flex" action="/user/search" method="GET">
                <input class="form-control me-2" type="text" name="search" placeholder="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        @endguest
    </div>
    <div class="cart">
        <a href="/user/cart"><i class="fa fa-shopping-cart" style="font-size:36px"></i></a>
    </div>
    <div class="info-login">
        <ul class="navbar-nav ms-auto">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Đăng Nhập</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Đăng Kí</a>
                    </li>
                @endif
            @else
                <!-- <a class="navbar-brand" href="#">
                    <img src="/storage/images/boy4_1648540608.jpg" alt="Logo" style="width:50px; height: 50px" class="rounded-pill">
                </a> -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="/storage/images/{{$khachhang->Img_KH}}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-info">
                            <img src="/storage/images/{{$khachhang->Img_KH}}" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{$khachhang->TenKH}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{route('user.detail', $khachhang->id)}}" class="btn btn-default btn-flat float-left">Thông tin</a>
                            <a href="{{route('logout')}}" class="btn btn-default btn-flat float-right"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Đăng xuất
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                            @csrf
                            </form>
                            
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
  </div>
</nav>

<div class="content">
    @yield('content')
</div>

<footer>
        <div class="contact-footer">
            <div class="logo-contact">
                <div class="logo-footer">
                    <div class="logo-f">
                        <i class="fa fa-book" style="padding:10px"></i>
                    </div>
                    <div class="title-f">
                        <h2>SÁCH TL</h2>
                    </div>
                </div>
                <div class="contact-f">
                    <p>Email:lienhe@sachtl.vn</p>
                    <p>Địa chỉ:Chung cư Khang Gia</p>
                    <table>
                        <tr>
                            <td class="td-11">Skype: loitran</td>
                        </tr>
                        <tr>
                            <td class="td-11">Lợi: 0335375466</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="lorem-footer">
                <div class="lorem-f">
                    <table>
                        <tr class="tr_11">
                            <td class="td-11"><h3>Hỗ trợ khách hàng:</h3></td>
                            <td class="td-11"><h3>00 0000 0001</h3></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </footer>

<style>

    .me-auto > li {
        width: 50%;
    }

    .container-fluid a{
        float: right;
    }

    .container-fluid {
        display: flex;
    }

    .nav-menu {
        width: 30%;
    }
    

    .search {
        width: 60%;
        margin-left: 5%;
        margin-right: 5%;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .cart {
        width: 10%;
    }

    .cart > a {
        width: 80%;
        margin: 10%;
        color: white;
    }

    .info-login {
        width: 20%;
    }

    .btn-ls {
        background-color: #343a40;
        border: none;
    }

    /* dropdow */
    .dropbtn {
        /* background-color: #3498DB;
        color: white;
        padding: 16px;
        font-size: 16px; */
        border: none;
        cursor: pointer;
    }

    .dropbtn:hover, .dropbtn:focus {
        /* background-color: #2980B9; */
        background-color: #343a40;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1; 
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        float: none;
        font-size: 14px;
    }

    .dropdown a:hover {background-color: #ddd;}

    .show {display: block;}


    .contact-footer {
        background-color: darkslateblue;
        display: flex;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .contact-footer > div {
        width: 50%;
    }

    .logo-contact {
        margin-left: 15%;
    }

    .logo-footer {
        display: flex;
    }

    .td-11 {
        padding-right: 10px;
    }

    .td-11 > h3{
        color: darkgray;
    }

    .contact-f > p, table{
        margin: 0;
    }

    .contact-f > table > tbody {
        display: flex;
    }

</style>

<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

        // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>


<!-- jQuery -->
<script src="/../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="/../../dist/js/demo.js"></script> -->


</body>
</html>