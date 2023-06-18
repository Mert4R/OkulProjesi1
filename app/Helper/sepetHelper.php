<?php
namespace App\Helper;

use App\Kitaplar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class sepetHelper
{
    static function add($id,$fiyat,$image,$name)
    {
        $sepet = Session::get('sepet');
        $array =[
            'id'=>$id,
            'name'=>$name,
            'image'=>$image,
            'fiyat'=>$fiyat

        ];
        Session::put('sepet.'.rand(1,90000),$array);
    }
    static function remove($id)
    {
        $s = Session::get('sepet');
        Session::forget('sepet.'.$id);

    }

    static function countData()
    {
        return count(Session::get('sepet'));

    }

    static function allList()
    {
        $x = Session::get('sepet');
        return $x;
    }

    static function totalPrice()
    {
        $data = self::allList();
        return collect($data)->sum('fiyat');
    }
    public static function restoreCart()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $favorites = $user->sepetUrunler()->pluck('urun_id')->toArray();

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
                    Session::put('sepet.' . $urun->id, $array);
                }
            }
        }
    }
    public static function persistCart()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $favorites = Session::get('sepet', []);

            // Kullanıcının beğendiği ürünleri kaydet
            foreach ($favorites as $favorite) {
                $user->begenilenUrunler()->attach($favorite['id']);
            }

            // Favorileri oturumdan temizle
            Session::forget('sepet');
        }
    }


}
