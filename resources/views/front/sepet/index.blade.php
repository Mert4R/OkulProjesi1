@extends('layouts.app')
@section('title', 'Sepet')
@section('content')
    <style>
        .empty-cart-message {
            text-align: center;
            padding: 50px;
        }

        .empty-cart-message i {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .empty-cart-message p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .empty-cart-message p:last-child {
            font-weight: bold;
        }

        .quantity-btn {
            display: flex;
            align-items: center;
        }

        .quantity-btn button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .quantity-btn button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Anasayfa</a></li>
                    <li class="active">Sepetim</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="ckeckout">
        <div class="container">
            <div class="ckeck-top heading">
                <h2>SEPETİM</h2>
            </div>
            <div class="ckeckout-top">
                <div class="cart-items">
                    <h3>Sepetim ({{App\Helper\sepetHelper::countData()}})</h3>

                    <div class="in-check">
                        @if(App\Helper\sepetHelper::countData() > 0)
                            <ul class="unit">
                                <li><span>Resim</span></li>
                                <li><span>Ürün Adi</span></li>
                                <li><span>Ürün Fiyatı</span></li>
                                <li></li>
                                <div class="clearfix"></div>
                            </ul>
                            @foreach(App\Helper\sepetHelper::allList() as $key => $value)
                                <ul class="cart-header">
                                    <a href="{{route('sepet.remove',['id'=>$key])}}">
                                        <div class="close1"></div>
                                    </a>
                                    <li class="ring-in">
                                        <img style="width:100px; height: 100px; " src="{{$value['image']}}" class="img-responsive" alt="">
                                    </li>
                                    <li><span class="name">{{$value['name']}}</span></li>
                                    <li><span class="cost">{{$value['fiyat']}} TL</span></li>

                                    <div class="clearfix"></div>
                                </ul>
                            @endforeach

                            <div style="float: left;">
                                <button type="submit" class="btn btn-primary" style="width: 200px; padding: 10px; font-size: 16px; border-radius: 5px; background-color: #007bff; border-color: #007bff; color: #fff; cursor: pointer;">
                                    <a style="text-decoration: none;color: white;" href="{{route('sepet.complete')}}">Alışverişi Tamamla</a>
                                </button>
                            </div>
                            <div style="float: right;">
                                <form action="{{ route('sepet.flush') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary" style="width: 200px; padding: 10px; font-size: 16px; border-radius: 5px; background-color: #007bff; border-color: #007bff; color: #fff; cursor: pointer;">Tüm Sepeti Sıfırla</button>
                                </form>
                            </div>
                        @else
                            <div class="empty-cart-message">
                                <h1>SEPETİNİZ BOŞ GÖRÜNÜYOR</h1>
                                <p>Alışveriş yapmanın tam sırası!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
