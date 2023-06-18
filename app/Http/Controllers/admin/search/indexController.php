<?php

namespace App\Http\Controllers\admin\search;

use App\Kitaplar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index()
    {
        if(strip_tags($_GET['p'])!="")
        {
            $q = strip_tags($_GET['p']);
            $data = Kitaplar::where('name', 'like','%'.$q.'%')->paginate(10);
            return view('admin.search.index',['data'=>$data]);

        }else
        {
            return redirect('/');

        }

    }
}
