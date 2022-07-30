@extends('layouts.appuser')

@section('content')
    <div class="main sach_data">
        @foreach($sachs as $sach)
            <div>
                <input type="hidden" value="{{$sach->id}}" class="sach_id">
                <div>
                    <a class="a-element" href="/sach/{{$sach->id}}">
                        <div class="element-img">
                            <img src="/storage/images/{{$sach->Img_Sach}}" alt="">
                        </div>
                        <div class="element-name">
                            <h3>{{ $sach->TenSach }}</h3>
                        </div>
                    </a>
                </div>
                <div class="add-to-cart">
                    <div class="price-book">
                        <span>{{ number_format($sach->GiaBan) }} vnđ</span>
                    </div>
                    <div class="add-cart">
                            <button>Thêm vào giỏ hàng</button>
                        </a>
                    </div>
                </div>
            </div>
            
        @endforeach
        
    </div>
    {{ $sachs->links() }}

    <script>
        $(document).ready(function(){
            $('.add-cart').click(function(e){
                e.preventDefault();

                var sach_id = $(this).closest('.sach_data').find('.sach_id').val();
                var sach_qty = 1;

                console.log(sach_id);

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
        .main{
            display:flex;
            flex-wrap: wrap;
        }
        .main > div {
            width: 19%!important;
            height: 500px;
            border: 1px solid blue;
            margin: 0.5%;
        }
        .a-element {
            display:block;
            text-decoration: none;
            color: black;
            
        }

        .a-element:hover {
            background-color: darkgray;
            color: white;
        }
        .element{
            width: 100%;
            text-align: center;
            
        }

        .element-img > img {
            width: 100%;
            height: 350px;
        }

        .element-name {
            height: 50px;
        }

        .element-name > h3 {
            font-size: 20px;
            text-align: center;
        }

        .add-to-cart {
            display: block;
            height: 100px;

            text-align: center;
        }

        .price-book {
            height: 50px;
        }

        .add-cart {
            height: 50px;
        }

        .add-cart button {
            width: 80%;
            border: 1px solid orange;
            background-color: white;
            color: orange;
            border-radius: 15px;
        }

        .add-cart button:hover {
            background-color: orange;
            color: white;
        }

    </style>
@endsection