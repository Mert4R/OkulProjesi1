<?php

namespace App\Http\Controllers\front\profil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class indexController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $remainingAttempts = 2 - $user->email_change_count;
        Session::put('remainingAttempts', $remainingAttempts);

        return view('front.profil.index', compact('user'));
    }

    public function update(Request $request)
    {
        Session::flash('emailChangeMessageDisplayed', true);
        $user = Auth::user();
        $user->name = $request->input('name');

        // E-posta adresi değişikliği kontrolü
        if ($user->email != $request->input('email')) {
            // Eğer daha önce e-posta adresi değişikliği yapmışsa
            if ($user->email_change_count >= 2) {
                return redirect()->back()->withErrors(['email' => 'E-posta adresinizi artık değiştiremezsiniz.'])->with('emailChangeErrorDisplayed', true);
            }

            // Kalan hakkı hesapla
            $remainingAttempts = 2 - $user->email_change_count;

            // Hakkı kalmadıysa
            if ($remainingAttempts <= 0) {
                return redirect()->back()->withErrors(['email' => 'E-posta adresinizi artık değiştiremezsiniz hiç hakkınız kalmadı.'])->with('emailChangeErrorDisplayed', true);
            }


            $user->email_change_count++;

            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->phone_code = $request->input('phone_code');
            $user->phone = $request->input('phone');
            $user->save();

            Session::flash('remainingAttempts', $remainingAttempts);

            return redirect()->back()->with('success', 'Profil bilgileriniz başarıyla güncellendi.');
        } else {
            $user->address = $request->input('address');
            $user->phone_code = $request->input('phone_code');
            $user->phone = $request->input('phone');
            $user->save();

            return redirect()->back()->with('success', 'Profil bilgileriniz başarıyla güncellendi.');
        }
    }
}
