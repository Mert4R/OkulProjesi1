@extends('layouts.app')
@section('title','Sepet Tamamlama')
@section('content')
    <style>
        /* CSS for the form */
        .form-container {
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            margin: 0 auto;
        }

        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
    <!--bottom-header-->
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <!-- Breadcrumbs HTML code -->
    </div>
    <!--end-breadcrumbs-->
    <!--contact-start-->
    <div class="contact">
        <div class="container">
            <div class="contact-top heading">
                <h2>SATIN ALMA BİLGİLERİNİ GİRİNİZ</h2>
            </div>
            @if(session("status"))
                {{session("status")}}
            @endif

            <div class="contact-text">
                <div class="col-md-12 contact-right">
                    @php
                        $user = Auth::user(); // Kullanıcı giriş yapmışsa, mevcut kullanıcı bilgilerini alır
                    @endphp
                    <form action="{{ route('sepet.completeStore') }}" method="POST" id="payment-form">
                        {{ csrf_field() }}
                        <h4 style="text-align: center" >Teslimat Adresi</h4>

                        <div class="form-container">
                            <h4 style="text-align: center">Adresinizi Seçiniz</h4>
                            <input type="radio" name="adresSecim" value="yeni" checked> Yeni Adres
                            <input  name="yeni_adres" type="text" required placeholder="Adresinizi Giriniz">

                            <input type="radio" name="adresSecim" value="kayitli"> Kayıtlı Adres
                            <input id="kayitliAdres" name="kayitli_adres" type="text" required value="{{ $user->address }}" readonly>
                            @error('adres')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                        </div>
                    </form>
                        <form action="{{ route('sepet.completeStore') }}" method="POST" id="payment-form">
                            <h4 style="text-align: center">Telefon Numarası</h4>
                            <div class="form-container">
                                <h4 style="text-align: center">Telefon Numarası Seçiniz</h4>
                                <input type="radio" name="telefonSecim" value="yeni" checked> Yeni Telefon Numarası<div>
                                <input  name="telefon" type="text" required placeholder="Telefon Numaranızı Giriniz" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
                                </div>
                                    <div>
                                    <input type="radio" name="telefonSecim" value="kayitli"> Kayıtlı Telefon Numarası
                                </div>
                                <div>
                                    <input name="kayitli_telefon" type="text" required placeholder="Telefon Numaranızı Giriniz" value="{{ $user->phone }}" readonly>
                                </div>
                            </div>
                            @error('telefon')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                        <h4 style="text-align: center">Mesaj İsteği</h4>
                        <div class="form-container">
                            <textarea name="mesaj" placeholder="Yazmak İstediğiniz mesajı giriniz"></textarea>
                        </div>
                        <!-- İleri Butonu -->
                        <button type="button" id="ileri" class="btn btn-primary" style="float: right;width: 200px; padding: 10px; font-size: 16px; border-radius: 5px; background-color: #007bff; border-color: #007bff; color: #fff; cursor: pointer;">İleri</button>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--contact-end-->

    <script>
        document.getElementById('ileri').addEventListener('click', function() {
            // İlk sayfadaki form verilerini tutmak için localStorage kullanılıyor
            var adresSecim = document.querySelector('input[name="adresSecim"]:checked').value;
            var adres = "";
            if (adresSecim === "yeni") {
                adres = document.getElementsByName('yeni_adres')[0].value;
            } else {
                adres = document.getElementsByName('kayitli_adres')[0].value;
            }
            var telefon = document.getElementsByName('telefon')[0].value;
            var mesaj = document.getElementsByName('mesaj')[0].value;

            localStorage.setItem('adresSecim', adresSecim);
            localStorage.setItem('adres', adres);
            localStorage.setItem('telefon', telefon);
            localStorage.setItem('mesaj', mesaj);

            // İkinci sayfaya yönlendirme yapılıyor
            window.location.href = "{{route('sepet.kartBilgileri')}}";
        });
        document.addEventListener('DOMContentLoaded', function () {
            const yeniAdresRadio = document.querySelector('input[value="yeni"]');
            const kayitliAdresRadio = document.querySelector('input[value="kayitli"]');
            const yeniAdresInput = document.querySelector('input[name="yeni_adres"]');
            const kayitliAdresInput = document.getElementById('kayitliAdres');

            yeniAdresRadio.addEventListener('change', function () {
                yeniAdresInput.removeAttribute('readonly');
                kayitliAdresInput.setAttribute('readonly', true);
            });

            kayitliAdresRadio.addEventListener('change', function () {
                yeniAdresInput.setAttribute('readonly', true);
                kayitliAdresInput.removeAttribute('readonly');
            });
        });
        document.getElementById('ileri').addEventListener('click', function() {
            // İlk sayfadaki form verilerini tutmak için localStorage kullanılıyor
            var telefonSecim = document.querySelector('input[name="telefonSecim"]:checked').value;
            var telefon = "";
            if (telefonSecim === "yeni") {
                telefon = document.getElementsByName('telefon')[0].value;
            } else {
                telefon = document.getElementsByName('kayitli_telefon')[0].value;
            }
            var adres = localStorage.getItem('adres');
            var mesaj = localStorage.getItem('mesaj');

            localStorage.setItem('telefonSecim', telefonSecim);
            localStorage.setItem('telefon', telefon);
            localStorage.setItem('adres', adres);
            localStorage.setItem('mesaj', mesaj);

            // İkinci sayfaya yönlendirme yapılıyor
            window.location.href = "{{ route('sepet.kartBilgileri') }}";
        });

        document.addEventListener('DOMContentLoaded', function() {
            const yeniTelefonRadio = document.querySelector('input[value="yeni"]');
            const kayitliTelefonRadio = document.querySelector('input[value="kayitli"]');
            const yeniTelefonInput = document.querySelector('input[name="telefon"]');
            const kayitliTelefonInput = document.querySelector('input[name="kayitli_telefon"]');

            yeniTelefonRadio.addEventListener('change', function() {
                yeniTelefonInput.removeAttribute('readonly');
                kayitliTelefonInput.setAttribute('readonly', true);
            });

            kayitliTelefonRadio.addEventListener('change', function() {
                yeniTelefonInput.setAttribute('readonly', true);
                kayitliTelefonInput.removeAttribute('readonly');
            });
        });
    </script>
@endsection
