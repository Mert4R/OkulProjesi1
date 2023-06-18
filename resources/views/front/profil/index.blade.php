@extends('layouts.app')
@section('title', 'Profil')
@section('content')
    <style>
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-row label {
            width: 120px;
            margin-right: 10px;
        }
        .custom-select {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .custom-input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
    <div class="container">
        <h2 style="margin-bottom: 20px;">Profil Bilgileri</h2>

        @if ($errors->has('email') && !session('emailChanged'))
            <div class="alert alert-info" style="margin-top: 20px;">
                {{ $errors->first('email') }}
            </div>

        @endif
        <!-- Başarılı güncelleme mesajı -->
        @if (session('success'))
            <div class="alert alert-success" id="success-alert" style="margin-bottom: 20px; padding: 10px; border-radius: 5px; background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Kalan hakkı göster -->
        @if (session('remainingAttempts'))
            <div class="alert alert-info" id="remaining-alert" style="margin-top: 20px;">
                E-posta adresinizi değiştirebilmeniz için {{ session('remainingAttempts') }} hakkınız kaldı.
            </div>
        @else

        @endif


        <form action="{{ route('profil.update') }}" method="POST" style="max-width: 500px; margin: 0 auto;">
            @csrf

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Ad:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" style="width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">E-posta:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" style="width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="address" style="display: block; margin-bottom: 5px; font-weight: bold;">Adres:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" style="width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;">
            </div>

            <div class="form-row">
                <label for="phone-code">Telefon Kodu:</label>
                <select class="custom-select" id="phone-code" name="phone_code">
                    <option value="+90" {{ $user->phone_code == '+90' ? 'selected' : '' }}>+90 (Türkiye)</option>
                    <option value="+1" {{ $user->phone_code == '+1' ? 'selected' : '' }}>+1 (ABD)</option>
                    <!-- Diğer ülke kodlarını buraya ekleyebilirsiniz -->
                </select>
            </div>
            <div class="form-row">
                <label for="phone">Telefon:</label>
                <input type="text" class="custom-input" id="phone" name="phone" value="{{ $user->phone }}" pattern="[0-9]{10}" title="Telefon numarası 10 haneli olmalıdır. Sadece rakamlar kullanılabilir.">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-size: 16px; border-radius: 5px; background-color: #007bff; border-color: #007bff; color: #fff; cursor: pointer;">Güncelle</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-alert').slideUp(500);
            }, 2000);

            setTimeout(function() {
                $('#remaining-alert').slideUp(500);
            }, 2000);
            $(document).ready(function() {
                var alertInfo = $('.alert.alert-info');

                // Hata mesajını 2 saniye sonra yavaşça kaybetme
                setTimeout(function() {
                    alertInfo.slideUp(500);
                }, 2000);
            });

            $('#phone').on('input', function() {
                var phoneNumber = $(this).val().trim();
                var validPhoneNumber = phoneNumber.replace(/\D/g, '').slice(0, 10);
                $(this).val(validPhoneNumber);
            });
        });
    </script>

@endsection
