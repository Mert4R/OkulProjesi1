@extends('layouts.app')
@section('title', 'Sipariş Detayı')
@section('content')

    <style>
        .order-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .order-details .title {
            margin-bottom: 20px;
        }

        .order-info {
            margin-bottom: 10px;
        }

        .order-items {
            margin-top: 20px;
        }

        .item-info {
            margin-bottom: 10px;
        }

        .total-price {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>




    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}">Anasayfa</a></li>
                    <li class="active">Sipariş Detayı</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="ckeckout">
        <div class="container">
            <div class="ckeck-top heading">
                <h2>SİPARİŞ DETAYI</h2>
            </div>
            <div class="favorites-list">
                <div class="ckeckout-top">
                    <div class="cart-items">
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(session("status"))
                                            <div class="alert alert-primary" role="alert">
                                                {{ session("status") }}
                                            </div>
                                        @endif

    <div class="order-details">
        <div class="order-info">
            <label>Alıcı:</label>
            {{ \App\User::getField($data[0]['userid'], 'name') }}
        </div>

        <div class="order-info">
            <label>Adres:</label>
            {{ $data[0]['adres'] }}
        </div>

        <div class="order-info">
            <label>Telefon:</label>
            {{ $data[0]['telefon'] }}
        </div>

        <div class="order-info">
            <label>Mesaj:</label>
            {{ $data[0]['mesaj'] }}
        </div>

        <div class="order-items">
            <h5>Kitaplar:</h5>

            @php
                $totalPrice = 0;
            @endphp

            @foreach(json_decode($data[0]['json'], true) as $key => $value)
                <div class="item-info">
                    <label>Kitap Adı:</label>
                    {{ $value['name'] }}
                </div>

                <div class="item-info">
                    <label>Kitap Fiyatı:</label>
                    {{ $value['fiyat'] }} TL
                </div>

                @php
                    $totalPrice += $value['fiyat'];
                @endphp
            @endforeach

            <div class="total-price">
                <label>Toplam Fiyat:</label>
                {{ $totalPrice }} TL
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="float: left;width: 200px; padding: 10px; font-size: 16px; border-radius: 5px; background-color: #007bff; border-color: #007bff; color: #fff; cursor: pointer;">
            <a style="text-decoration: none;color: white;" href="{{ route('order.cancel', ['id' => $data[0]['id']]) }}">Siparişi İptal Et</a>
        </button>

    </div>

@endsection
