@extends('layouts.app')
@section('title', 'Sepet Tamamlama - Kart Bilgileri')
@section('content')

    <style>
        .payment-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .payment-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .payment-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .payment-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
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
                <h2>KART BİLGİLERİNİZİ GİRİNİZ</h2>
            </div>
            <div class="contact-text">
                <div class="col-md-12 contact-right">
                    <div class="payment-form">
                        <form action="{{ route('sepet.completeStore') }}" method="POST" id="payment-form">
                            @csrf
                            <h3 style="text-align: center;margin-bottom: 40px">Ödeme Bilgileri</h3>
                            <input name="kart_ismi" type="text" required placeholder="Kart Üzerindeki İsmi Giriniz"
                                   onkeypress="return event.charCode >= 65 && event.charCode <= 122 || event.charCode == 32">
                            <input name="kart_numarasi" type="text" required placeholder="Kart Numaranızı Giriniz"
                                   onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="19"
                                   oninput="formatCardNumber(this)">
                            <input name="son_kullanma_tarihi" type="text" required placeholder="Son Kullanma Tarihi"
                                   onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="5"
                                   oninput="formatExpirationDate(this)">
                            <input name="cvv" type="text" required placeholder="CVV"
                                   onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3">

                            @php
                                $telefonCode = '<script>localStorage.getItem("telefonCode");</script>'; // Retrieve the phone code from localStorage
                            @endphp

                            <input name="telefon_kodu" type="hidden" value="{{ $telefonCode }}"> <!-- Add the hidden input field to send the phone code to the server -->

                            <button type="submit" id="tamamla">Tamamla</button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--contact-end-->

        <script>
            document.getElementById('tamamla').addEventListener('click', function () {
                // İkinci sayfadaki form verilerini almak için localStorage kullanılıyor
                var kartNumarasi = document.getElementsByName('kart_numarasi')[0].value;
                var sonKullanmaTarihi = document.getElementsByName('son_kullanma_tarihi')[0].value;
                var cvv = document.getElementsByName('cvv')[0].value;
                var kartismi = document.getElementsByName('kart_ismi')[0].value;

                // İlk sayfadaki form verilerini localStorage'dan almak
                var adres = localStorage.getItem('adres');
                var telefon = localStorage.getItem('telefon');
                var mesaj = localStorage.getItem('mesaj');

                // İlk sayfadaki form verilerini eklemek için gizli input alanları oluşturuluyor
                var adresInput = document.createElement('input');
                adresInput.type = 'hidden';
                adresInput.name = 'adres';
                adresInput.value = adres;

                var telefonInput = document.createElement('input');
                telefonInput.type = 'hidden';
                telefonInput.name = 'telefon';
                telefonInput.value = telefon;

                var mesajInput = document.createElement('input');
                mesajInput.type = 'hidden';
                mesajInput.name = 'mesaj';
                mesajInput.value = mesaj;

                // Kart bilgileri için gizli input alanları oluşturuluyor
                var kartNumarasiInput = document.createElement('input');
                kartNumarasiInput.type = 'hidden';
                kartNumarasiInput.name = 'kart_numarasi';
                kartNumarasiInput.value = kartNumarasi;

                var sonKullanmaTarihiInput = document.createElement('input');
                sonKullanmaTarihiInput.type = 'hidden';
                sonKullanmaTarihiInput.name = 'son_kullanma_tarihi';
                sonKullanmaTarihiInput.value = sonKullanmaTarihi;

                var cvvInput = document.createElement('input');
                cvvInput.type = 'hidden';
                cvvInput.name = 'cvv';
                cvvInput.value = cvv;

                var kartismiInput = document.createElement('input');
                kartismiInput.type = 'hidden';
                kartismiInput.name = 'kart_ismi';
                kartismiInput.value = kartismi;

                // Forma gizli input alanları ekleniyor
                var form = document.getElementById('payment-form');
                form.appendChild(adresInput);
                form.appendChild(telefonInput);
                form.appendChild(mesajInput);
                form.appendChild(kartNumarasiInput);
                form.appendChild(sonKullanmaTarihiInput);
                form.appendChild(cvvInput);
                form.appendChild(kartismiInput);
            });

            function formatCardNumber(input) {
                var value = input.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                var formattedValue = '';
                for (var i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        formattedValue += ' ';
                    }
                    formattedValue += value.charAt(i);
                }
                input.value = formattedValue;
            }

            function formatExpirationDate(input) {
                var value = input.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                var formattedValue = '';
                if (value.length > 0) {
                    formattedValue = value.charAt(0);
                    if (value.length > 1) {
                        formattedValue += value.charAt(1);
                        if (value.length > 2) {
                            formattedValue += '/' + value.charAt(2);
                            if (value.length > 3) {
                                formattedValue += value.charAt(3);
                                if (value.length > 4) {
                                    formattedValue += '/' + value.substring(4, 6);
                                }
                            }
                        }
                    }
                }
                input.value = formattedValue;
                var currentDate = new Date();
                var enteredDate = new Date(currentDate.getFullYear(), formattedValue.substring(0, 2) - 1, 1);
                if (enteredDate < currentDate) {
                    input.style.color = 'red';
                } else {
                    input.style.color = '';
                }
            }
        </script>

@endsection
