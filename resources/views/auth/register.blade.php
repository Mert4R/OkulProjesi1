@extends('layouts.app')
@section('title','Kayıt Ol')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Anasayfa</a></li>
                    <li class="active">Kayıt Ol</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="register">
        <div class="container">
            <div class="register-top heading">
                <h2>KAYIT OL</h2>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
            <div  class="register-main">
                <div style="width: 320px" class="col-md-6 account-left">



                </div>
                <div style="float: left" class="col-md-6 account-left">


                    <input class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Adınız Soyadınız" type="text" tabindex="1" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                    <input class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Adresiniz" type="text" tabindex="3" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror


                    <input id="password" class=" @error('password') is-invalid @enderror" name="password" placeholder="Şifrenizi" type="password" tabindex="4" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror


                    <input id="password-confirm" type="password"  name="password_confirmation"  autocomplete="new-password" placeholder="Şifrenizi Tekrar Giriniz" tabindex="4" required>

                </div>

                <div class="clearfix"></div>
            </div>
                <div class="col-md-6 account-left" style=" width: 320px  ">
                </div>
            <div class="address submit" style="float:left  ">
                <input type="submit" value="KAYIT OL">
            </div>

            </form>
        </div>
    </div>

@endsection
