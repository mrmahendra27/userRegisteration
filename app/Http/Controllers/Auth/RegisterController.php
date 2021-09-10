<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function showRegisterForm(): View
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'min:4', 'max:80'],
            'last_name' => ['required', 'string', 'min:4', 'max:80'],
            'mobile' => ['required', 'regex:/(91)[0-9]{10}/', 'unique:users'],
            'state' => ['required', 'string', 'min:2', 'max:80'],
            'city' => ['required', 'string', 'min:2', 'max:80'],
            'address' => ['required', 'string', 'min:20', 'max:510'],
            'pincode' => ['required', 'regex:/\b\d{6}\b/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
            ],
        ], [
            'mobile.regex' => 'Mobile Number should start with 91',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'state' => $data['state'],
            'city' => $data['city'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'pincode' => $data['pincode'],
            'ip_address' => \Request::ip(),
            'is_admin' => false,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return redirect(route('home'))->with('success', __('User Logged In successfully'));
    }
}
