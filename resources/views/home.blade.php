@extends('layouts.app')

@section('title', 'Sipariş Detayı')

@section('content')
    <style>
        .form-page {
            display: none;
            padding: 20px;
        }

        .show-page {
            display: block;
        }

        .form-page h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .form-page form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-page input[type="text"],
        .form-page input[type="email"],
        .form-page input[type="tel"],
        .form-page input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-page button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-page button:hover {
            background-color: #45a049;
        }

        .form-page .previous-button {
            background-color: #ccc;
            margin-right: 10px;
        }

        .confirmation-page p {
            margin-top: 20px;
        }

        .confirmation-page button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirmation-page button:hover {
            background-color: #45a049;
        }
    </style>

    <div id="address-page" class="form-page show-page">
        <h2>Adres Bilgileri</h2>
        <form action="{{route('sepet.completeStore')}}" method="POST">
            @csrf
            <input name="adres" type="text" required placeholder="Adresinizi Giriniz">
            @error('adres')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
            <input name="telefon" type="text" required placeholder="Telefon Numaranızı Giriniz">
            @error('telefon')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
            <textarea name="mesaj" placeholder="Yazmak İstediğiniz mesajı giriniz"></textarea>
            <button type="submit" id="submit" onclick="nextPage('address-page', 'payment-page')">İleri</button>
        </form>
    </div>

    <div id="payment-page" class="form-page">
        <h2>Kart Bilgileri</h2>
        <form action="{{route('sepet.completeStore')}}" method="POST">
            @csrf
            <input type="text" name="kart_no" placeholder="Kart Numarası" required><br>
            <input type="text" name="son_kullanim" placeholder="Son Kullanma Tarihi" required><br>
            <input type="text" name="cvv" placeholder="CVV" required><br>
            <button onclick="nextPage('payment-page', 'confirmation-page')">Ödemeyi Tamamla</button>
            <button class="previous-button" onclick="previousPage('payment-page')">Geri</button>
        </form>
    </div>

    <div id="confirmation-page" class="form-page">
        <h2>Onay Sayfası</h2>
        <p>Ödeme onayı için son bir adım kaldı.</p>
        <form action="{{route('sepet.completeStore')}}" method="POST">
            @csrf
        <button onclick="document.getElementById('payment-form').submit()">Ödemeyi Tamamla</button>
        </form>
    </div>

    <script>
        function nextPage(currentPage, nextPage) {
            var currentPageElement = document.getElementById(currentPage);
            var nextPageElement = document.getElementById(nextPage);
            currentPageElement.style.display = 'none';
            nextPageElement.style.display = 'block';
        }

        function previousPage(currentPage) {
            var currentPageElement = document.getElementById(currentPage);
            var previousPageElement = currentPageElement.previousElementSibling;
            currentPageElement.style.display = 'none';
            previousPageElement.style.display = 'block';
        }

        window.onload = function() {
            var formPages = document.getElementsByClassName('form-page');
            var firstPage = formPages[0];
            var lastPage = formPages[formPages.length - 1];
            firstPage.style.display = 'block';

            var buttons = document.getElementsByTagName('button');
            for (var i = 0; i < buttons.length; i++) {
                var button = buttons[i];
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                });
            }
        };
    </script>
@endsection
