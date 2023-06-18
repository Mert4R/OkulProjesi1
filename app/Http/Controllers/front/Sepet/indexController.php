<?php

namespace App\Http\Controllers\front\Sepet;

use App\Helper\sepetHelper;
use App\Kitaplar;
use App\Order;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class indexController extends Controller
{
    public function index()
    {
        return view('front.sepet.index');
    }

    public function add($id)
    {
        $c = Kitaplar::where('id', '=', $id)->count();
        if ($c != 0) {
            $w = Kitaplar::where('id', '=', $id)->get();
            $user = Auth::user();
            $sepet = Session::get('sepet', []);
            $user->sepetUrunler()->attach($id);
            sepetHelper::add($id, $w[0]['fiyat'], asset($w[0]['image']), $w[0]['name']);
            return redirect()->back()->with('status', 'Ürün Başarıyla Sepete Eklendi');
        } else {
            return redirect()->route('index');
        }
    }

    public function remove($id)
    {
        $user = Auth::user();
        $user->sepetUrunler()->detach($id);
        sepetHelper::remove($id);
        return redirect()->back();
    }

    public function complete()
    {
        if (sepetHelper::countData() != 0) {

            return view('front.sepet.complete');
        } else {
            return redirect('/');
        }
    }


    public function completeStore(Request $request)
    {
        $request->validate([
            'adres' => 'required',
            'telefon' => 'required',
            'kart_numarasi' => 'required',
            'son_kullanma_tarihi' => 'required',
            'cvv' => 'required',
            'kart_ismi' => 'required',
        ]);

        $adres = $request->input('adres');
        $telefon = $request->input('telefon');
        $mesaj = $request->input('mesaj');
        $kartNumarasi = $request->input('kart_numarasi');
        $kartismi = $request->input('kart_ismi');
        $sonKullanmaTarihi = $request->input('son_kullanma_tarihi');
        $cvv = $request->input('cvv');
        $json = json_encode(sepetHelper::allList());

        $array = [
            'userid' => Auth::id(),
            'adres' => $adres,
            'telefon' => $telefon,
            'mesaj' => $mesaj,
            'kart_numarasi' => $kartNumarasi,
            'kart_ismi' => $kartismi,
            'son_kullanma_tarihi' => $sonKullanmaTarihi,
            'cvv' => $cvv,
            'json' => $json
        ];

        $insert = Order::create($array);

        if ($insert) {
            Session::forget('sepet');
            return redirect()->route('sepet.kartBilgileri')->with('success', 'Siparişiniz Alındı');
        } else {
            return redirect()->back()->with('error', 'Siparişiniz Alınamadı');
        }
    }

    public function flush()
    {
        $user = Auth::user();
        $user->sepetUrunler()->detach();
        Session::forget('sepet');
        return redirect()->back()->with('status', 'Favorileriniz sıfırlandı.');
    }

    private function resetCart()
    {
        Session::forget('sepet');
    }
    public function kartbil(){
        return view('front.sepet.kartBilgileri');
    }



}
