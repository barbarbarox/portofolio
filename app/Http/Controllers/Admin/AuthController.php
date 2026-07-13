<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Redirect to Google OAuth.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('admin.login')
                ->with('error', 'Autentikasi Google dibatalkan atau gagal.');
        }

        $allowedEmail = env('ALLOWED_ADMIN_EMAIL');

        if ($googleUser->getEmail() !== $allowedEmail) {
            return redirect()->route('admin.login')
                ->with('error', '🚫 Akses ditolak. Email ' . $googleUser->getEmail() . ' tidak diizinkan.');
        }

        // Find or create the admin user
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            $user->password = bcrypt(\Illuminate\Support\Str::random(32));
            $user->is_admin = true;
            $user->save();
        } else {
            // Ensure the allowed email is always an admin
            if (!$user->is_admin) {
                $user->is_admin = true;
                $user->save();
            }
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
