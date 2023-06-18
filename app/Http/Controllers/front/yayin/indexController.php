<?php

namespace App\Http\Controllers\front\yayin;

use App\Kategoriler;
use App\Kitaplar;
use App\YayinEvi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index($selflink)
    {
        $c = YayinEvi::where('selflink','=',$selflink)->count();
        if($c!=0)
        {
            $w = YayinEvi::where('selflink','=',$selflink)->get();
            $data = Kitaplar::where('kategoriid','=',$w[0]['id'])->paginate(10);
            return view('front.cat.index',['info'=>$w,'data'=>$data]);
        }else
        {
            return redirect('/');
        }
    }
}
