<?php

namespace App\Http\Controllers\front\begen;

use App\Helper\favHelper;
use App\Helper\sepetHelper;
use App\Kitaplar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{

    public function index()
    {

        return view('front.begen.index');
    }
    public function add($id)
    {
        $c = Kitaplar::where('id', '=', $id)->count();
        if ($c != 0) {
            $w = Kitaplar::where('id', '=', $id)->get();

            $user = Auth::user();
            $user->begenilenUrunler()->attach($id);

            favHelper::add($id, $w[0]['fiyat'], asset($w[0]['image']), $w[0]['name']);

            return redirect()->back()->with('status', 'Ürün Başarıyla Favorilere Eklendi');
        } else {
            return redirect()->route('index');
        }
    }

    public function remove($id)
    {
        $user = Auth::user();
        $user->begenilenUrunler()->detach($id);

        favHelper::remove($id);

        return redirect()->back();
    }

    public function flush()
    {
        $user = Auth::user();
        $user->begenilenUrunler()->detach();

        Session::forget('begen');

        return redirect()->back()->with('status', 'Favorileriniz sıfırlandı.');
    }
}
