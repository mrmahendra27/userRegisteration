<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function showLoginForm(): View
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => ['required', Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()]
        ]);
    }

    public function login(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password], true)) {

            return redirect(route('home'))->with('success', __('User Logged In successfully'));
        }
        return back()->withInput($request->all())->with('error', __('Wrong User Credentials!!'));
    }

    public function logout()
    {
        $this->guard()->logout();

        return redirect(route('loginform'))->with('success', __('User logged out successfully'));
    }
}
