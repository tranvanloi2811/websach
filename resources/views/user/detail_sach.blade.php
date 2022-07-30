@extends('layouts.appuser', ['loaisachs' => $loaisachs])

@section('content')
<div class="main-bd">
    <div class="main sach_data">
        <div class="pay-cart-img">
            <div class="img">
                <img src="/storage/images/{{$sach->Img_Sach}}" alt="">
            </div>
            <div class="pay-cart">
                <div>
                    <button class="addToCartBtn">
                        <span><i class="fa fa-shopping-cart"></i></span>
                        <span>Thêm vào giỏ hàng</span>
                    </button>
                </div>
                <div>
                    <button>
                        <span>Mua ngay</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="detail-sach">
            <input type="hidden" value="{{$sach->id}}" class="sach_id">
            <h1>
                {{$sach->TenSach}}
            </h1>
            <div class="dt-xb-tg">
                <div class="dt-xb">
                    <span>Nhà xuất bản: </span>
                    <span><b>{{$sach->TenNhaXB}}</b></span>
                </div>
                <div class="dt-tg">
                    <span>Tác giả: </span>
                    <span><b>{{$sach->TacGia}}</b></span>
                </div>
            </div>
            <div class="dt-ls">
                <span>Loại sách: </span>
                <span><b>{{$sach->TenLoaiSach}}</b></span>
            </div>
            <div class="dt-gb">
                <p><span>{{number_format($sach->GiaBan)}} đ</span></p>
            </div>
            <div class="dt-sl">
                <label for="">Số lượng:</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-subtract" type="button">-</button>
                    </span>
                    <input type="text" class="form-control no-padding text-center sach_quantity" value="1">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-add" type="button">+</button>
                    </span>
                </div>
            </div>
        </div>
        <script>
            //tăng giảm số lượng
            var minus = document.querySelector(".btn-subtract")
            var add = document.querySelector(".btn-add");
            var quantityNumber = document.querySelector(".sach_quantity");
            var currentValue = 1;

            add.addEventListener("click", function() {
                currentValue += 1;
                quantityNumber.value = currentValue;
                console.log(currentValue);
            });

            minus.addEventListener("click", function(){
                if(currentValue > 1)
                {
                    currentValue -= 1;
                    quantityNumber.value = currentValue;
                    console.log(currentValue)
                }
                
            });

            //add to cart
            $(document).ready(function(){
                $('.addToCartBtn').click(function(e){
                    e.preventDefault();

                    var sach_id = $(this).closest('.sach_data').find('.sach_id').val();
                    var sach_qty = $(this).closest('.sach_data').find('.sach_quantity').val();

                    // console.log(sach_qty);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: "POST",
                        url: "{{ route('addtocart') }}",
                        data: {
                            'sach_id': sach_id,
                            'sach_qty': sach_qty,
                        },
                        success: function(response) {
                            // window.location.href = "/paymentsuccess/" + sach_id;
                            alert(response.status);
                        }
                    });
                });
            });

        </script>
        <style>
            .main-bd{
                background-color: gray;
                padding-top: 20px;
                padding-bottom: 20px;
            }
            .main{
                background-color: white;
                display: flex;
                width: 80%;
                margin-left: 10%;
                margin-right: 10%;
                border-radius: 10px;
                
            }

            .pay-cart-img{
                width: 40%;
            }

            .img{
                width: 90%;
                margin-left: 5%;
                margin-right: 5%;
                
            }

            .img > img{
                width: 100%;
                height: 500px;
            }

            .pay-cart{
                display: flex;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .pay-cart > div {
                width: 50%;
            }

            .pay-cart > div > button {
                width: 90%;
                margin-left: 10%;
                border-radius: 10px;
                display: block;
                text-align: center;
                height: 40px;
                font-size: 15px;
                border: 1px solid red;
                color: red;
            }

            .detail-sach {
                width: 56%;
                margin-left: 4%;
            }

            .dt-xb-tg {
                width: 100%;
                display: flex;
            }

            .dt-xb{
                width: 60%;
            }

            .dt-td{
                width: 40%;
            }

            .dt-gb{
                color: red;
                font-size: 25px;
            }

            .dt-sl{
                display: flex;
            }

            .dt-sl > label {
                width: 20%;
            }
            .dt-sl > div {
                width: 20%;
            }

            .dt-sl > div > input {
                width: 50%;
            }

            .dt-sl > div > span {
                width: 25%;
            }
        </style>

    </div>
</div>

@endsection