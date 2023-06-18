<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helper\favHelper;
use Illuminate\Http\Request;
use App\Helper\sepetHelper;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        // Kullanıcı giriş yaptığında favorileri geri yükle
        favHelper::restoreFavorites();
        sepetHelper::restoreCart();
        return redirect('/');
    }

    protected function loggedOut(Request $request)
    {
        // Önce favorileri kaydet
        favHelper::persistFavorites();
        sepetHelper::persistCart();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Sonra çıkış işlemini gerçekleştir ve "/" sayfasına yönlendir
        return redirect('/');
    }
}
