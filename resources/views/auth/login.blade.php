@extends('layouts.app')
@section('title','Giriş Yap')
@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Anasayfa</a></li>
                    <li class="active">Giriş Yap</li>
                </ol>
            </div>
        </div>
    </div>


    <div class="account">
        <div class="container">
            <div class="account-top heading">
                <h2>GİRİŞ YAP</h2>
            </div>
            <div class="account-main">
                <div class="col-md-6 account-left">
                    <h3>Hesabınız Var İse Buradan Giriş Yapınız</h3>
                    <div class="account-bottom">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                        <input class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Emailinizi Giriniz" type="text" tabindex="3" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        <input  class=" @error('password') is-invalid @enderror" placeholder="Şifrenizi giriniz" name="password" type="password" tabindex="4" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        <div class="address">

                            <input type="submit" value="GİRİŞ YAP">
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 account-right account-left">
                    <h3>Hesabınız Yok Mu? Buradan Hesap Oluşturunuz</h3>
                    <p>Sitemizde Yeni bir hesap oluşturun ve Yeni gelen ürünlerden, haberlerden, ve eğlenceli içeriklerimizden hemen haberdar olun.</p>
                    <a href="{{route('register')}}">Yeni Hesap Oluştur</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
