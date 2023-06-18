<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe;

class StripeController extends Controller
{
    public function index(){
        $amount = rand(10,999);
        \Stripe\Stripe::setApiKey('sk_test_51NE7WmCRdO7EgexqBmt7FqCweyB8gLdfkZkhHay2Sjg0XXe3vuCNK8Dk4FNO4SHPTKIy6JXNEFpjH4Eam8NyOIzD00ubWQcQkE');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => ($amount)*100,
            'currency' => 'INR',
            'metadata' => ['integration_check'=>'accept_a_payment']
        ]);

        $data = array(
            'name'=> '',
            'email'=> '',
            'amount'=> $amount,
            'client_secret'=> $intent->client_secret,
        );

        return view('payment',['data'=>$data]);

    }

    public function success(){
        return view('success');
    }
}
