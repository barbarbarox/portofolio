<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function showLogin() {
        if (auth()->check() && auth()->user()->is_admin) return redirect()->route('admin.dashboard');
        return view('admin.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            if (!auth()->user()->is_admin) {
                auth()->logout();
                return back()->withErrors(['email' => 'Akun ini tidak memiliki akses admin.']);
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
