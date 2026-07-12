<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|min:10',
            'g-recaptcha-response' => 'required|string',
        ]);

        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        if (!$response->json('success') || $response->json('score') < 0.5) {
            return back()->with('error', 'Validasi Keamanan gagal. Sistem mendeteksi aktivitas yang mencurigakan.')->withInput();
        }

        unset($validated['g-recaptcha-response']);
        Contact::create($validated);

        return back()->with('success', 'Pesan kamu berhasil dikirim! Terima kasih, Akbar akan segera menghubungimu. 🚀');
    }
}
