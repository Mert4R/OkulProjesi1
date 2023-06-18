@extends('layouts.app')
@section('title', 'Favoriler')
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
    </style>
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}">Anasayfa</a></li>
                    <li class="active">Beğendiklerim</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="ckeckout">
        <div class="container">
            <div class="ckeck-top heading">
                <h2>BEĞENDİKLERİM</h2>
            </div>
            <div class="favorites-list">
                <div class="ckeckout-top">
                    <div class="cart-items">
                <h3>Beğendiklerim ({{App\Helper\favHelper::countData()}})</h3>
                        <div class="in-check">
                @if(App\Helper\favHelper::countData() > 0)
                    <ul class="unit">
                        <li><span>Resim</span></li>
                        <li><span>Ürün Adi</span></li>
                        <li><span>Ürün Fiyatı</span></li>
                        <li></li>
                        <div class="clearfix"></div>
                    </ul>
                    @foreach(App\Helper\favHelper::allList() as $key => $value)
                        <ul class="cart-header">
                            <a href="{{route('begen.remove',['id'=>$key])}}">
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
                        <form action="{{ route('begen.flush') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary" style="width: 200px; padding: 10px; font-size: 16px; border-radius: 5px; background-color: #007bff; border-color: #007bff; color: #fff; cursor: pointer;">Tüm Favorileri Sıfırla</button>
                        </form>
                @else
                    <div class="empty-cart-message">
                        <i class="fa fa-heart"></i>
                        <h1>BEĞENDİĞİNİZ ÜRÜN BULUNMAMAKTA...</h1>
                    </div>
                @endif
                        </div>
            </div>
                </div>
            </div>
        </div>
    </div>
@endsection
