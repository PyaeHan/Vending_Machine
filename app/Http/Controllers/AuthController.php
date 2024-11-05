<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Initial Login
     */
    public function index(): View | RedirectResponse
    {
        if (Auth()->user()) {
            return redirect()->route('products.index');
        }
        return view('auth.login');
    }

    /**
     * Registration
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * Login Method
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('products')
            ->with('login_success', 'You have Successfully loggedin.');
        }
        return redirect()->route('login')
        ->with('error', 'Opps! You have entered invalid credentials.');
    }

    /**
     * Registration Post Method
     */
    public function postRegistration(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);

        $data = $request->all();
        $this->create($data);
        return redirect()->route('login')
        ->with('success', 'Great! You have Successfully registered.');
    }

    /**
     * Write code on Method
     */
    public function dashboard(): RedirectResponse
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * User registration method
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Logout Method
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
