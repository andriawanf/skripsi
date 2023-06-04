<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended(route('home'));
        // }
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role;

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin');
                    break;
                case 'kepala_sekolah':
                    return redirect()->route('kepala_sekolah');
                    break;
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // Menampilkan form login
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat' => 'required|string|max:255',
            'satuan_organisasi' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:user,admin,kepala_sekolah', // Menambahkan validasi peran
        ]);

        $user = User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'satuan_organisasi' => $request->satuan_organisasi,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);
        // return redirect()->route('home');

        // Redirect sesuai peran pengguna
        switch ($request->role) {
            case 'admin':
                return redirect()->route('admin');
                break;
            case 'kepala_sekolah':
                return redirect()->route('kepala_sekolah');
                break;
            default:
                return redirect()->route('home');
        }
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
