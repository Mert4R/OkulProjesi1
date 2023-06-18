@extends('layouts.app')
@section('title', 'Siparişlerim')
@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{ route('index') }}">Anasayfa</a></li>
                    <li class="active">Siparişlerim</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="ckeckout">
        <div class="container">
            <div class="ckeck-top heading">
                <h2>SİPARİŞLERİM</h2>
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

                                        @if($orders->count() > 0)
                                            <div class="card">
                                                <div class="card-content table-responsive">
                                                    <table class="table">
                                                        <thead class="text-primary">
                                                        <tr>
                                                            <th>Alıcı</th>
                                                            <th>Adres</th>
                                                            <th>Telefon</th>
                                                            <th>Mesaj</th>
                                                            <th>Düzenle</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($orders as $order)
                                                            <tr>
                                                                <td>{{ \App\User::getField($order->userid, "name") }}</td>
                                                                <td>{{ $order->adres }}</td>
                                                                <td>{{ $order->telefon }}</td>
                                                                <td>{{ $order->mesaj }}</td>
                                                                <td><a href="{{ route('order.detail', ['id' => $order->id]) }}">Detay</a></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    {{ $orders->links() }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="empty-cart-message">
                                                <h1>ŞU ANA KADAR HİÇ SİPARİŞ VERMEMİŞSİNİZ...</h1>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
