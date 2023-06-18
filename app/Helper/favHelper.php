<?php

namespace App\Helper;
use App\Kitaplar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class favHelper
{
    public static function add($id, $fiyat, $image, $name)
    {
        $favoriler = Session::get('begen', []);

        // Favorilere aynı ürünün birden fazla eklenmesini önle
        foreach ($favoriler as $favori) {
            if ($favori['id'] == $id) {
                // Ürün zaten favorilerde var, tekrar eklemeye gerek yok
                return;
            }
        }

        $array = [
            'id' => $id,
            'name' => $name,
            'image' => $image,
            'fiyat' => $fiyat
        ];

        Session::put('begen.' . rand(1, 90000), $array);
    }

    public static function remove($id)
    {
        $s = Session::get('begen');
        Session::forget('begen.' . $id);
    }

    public static function countData()
    {
        return count(Session::get('begen', []));
    }

    public static function allList()
    {
        return Session::get('begen', []);
    }

    public static function persistFavorites()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $favorites = Session::get('begen', []);

            // Kullanıcının beğendiği ürünleri kaydet
            foreach ($favorites as $favorite) {
                $user->begenilenUrunler()->attach($favorite['id']);
            }

            // Favorileri oturumdan temizle
            Session::forget('begen');
        }
    }

    public static function restoreFavorites()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $favorites = $user->begenilenUrunler()->pluck('urun_id')->toArray();

            // Kullanıcının beğendiği ürünleri oturuma ekle
            foreach ($favorites as $favorite) {
                $urun = Kitaplar::find($favorite);
                if ($urun) {
                    $array = [
                        'id' => $urun->id,
                        'name' => $urun->name,
                        'image' => asset($urun->image),
                        'fiyat' => $urun->fiyat
                    ];
                    Session::put('begen.' . $urun->id, $array);
                }
            }
        }
    }
}
