<?php

namespace App\Http\Controllers\front\order;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mevcut kullanıcıyı alır
        $orders = Order::paginate(10);
        $orders = Order::where('userid', $user->id)->paginate(10);
        return view('front.order.index', ['orders' => $orders]);
    }
    public function detail($id)
    {
        $c = Order::where('id','=',$id)->count();
        if ($c!=0)
        {
            $w = Order::where('id', '=', $id)->get();
            return view('front.order.detail', ['data' => $w]);

        }else
        {
            return redirect('/');
        }
    }
    public function cancel($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return redirect()->route('order.index')->with('status', 'Sipariş başarıyla iptal edildi.');
        } else {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }
    }


}
