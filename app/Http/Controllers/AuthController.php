<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $title = 'Login';
        return view('auth.index', [
            'title' => $title
        ]);
    }

    public function authLogin(Request $request)
    {
        $validates = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validates)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } else {
            return redirect('/');
        }
    }

    public function regis()
    {
        $title = 'Registration';
        return view('auth/regis', [
            'title' => $title
        ]);
    }

    public function authRegister(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:3|max:15',
            'role_id' => 'required'
        ]);

        $validate['password'] = bcrypt($validate['password']);
        User::create($validate);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
