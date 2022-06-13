<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        if (auth()->user()->type == 'admin') {
            return '/admin/adminDashboard';
        }
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginUser(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, "type" => $request->loginby])) {
            if (auth()->user()->type == "admin") {
                return redirect()->route('adminDashboard');
            }
            return redirect()->route('normalUserDashboard');
        } else {
            session()->flash('error', 'Invalid Credentials');
            return redirect('login');
        }
    }
}
