<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->delete();

        $projects = [
            [
                'emoji' => '🎁',
                'title' => 'GiftKita',
                'description' => 'Platform promosi digital terpercaya yang memfasilitasi penjualan produk secara efektif, terintegrasi dengan media sosial penjual, serta mendukung pertumbuhan bisnis dengan inovasi.',
                'tech_stack' => 'Laravel, MySQL',
                'tags' => json_encode(['Digital Promotion', 'Platform', 'Web App']),
                'accent_color' => '#F472B6',
                'github_url' => 'https://github.com/barbarbarox/giftkita22',
                'live_url' => 'https://giftkita.ours.web.id',
                'is_featured' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emoji' => '🛡️',
                'title' => 'RedSim - Security Analysis & Education',
                'description' => 'A comprehensive web-based platform built with Laravel that provides various cybersecurity tools, AI-powered security analysis, and interactive educational features.',
                'tech_stack' => 'Laravel, PHP 8.3+, MySQL',
                'tags' => json_encode(['Security Analysis', 'Education', 'Laravel', 'AI Integration']),
                'accent_color' => '#EF4444',
                'github_url' => 'https://github.com/barbarbarox/redsim',
                'live_url' => null,
                'is_featured' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emoji' => '📊',
                'title' => 'StatPhys Lab & Kalkulator Distribusi',
                'description' => 'Aplikasi Kalkulator Distribusi Frekuensi Pintar dan Mesin Kalkulasi Fisika Statistik. Selesaikan soal statistika deskriptif secara otomatis — lengkap dengan langkah penyelesaian, tabel distribusi, dan grafik interaktif.',
                'tech_stack' => 'React, Vite, Chart.js, Tesseract.js',
                'tags' => json_encode(['React', 'Statistics', 'Physics', 'Education']),
                'accent_color' => '#3B82F6',
                'github_url' => 'https://github.com/barbarbarox/aplikasi-distribusi-frekuensi',
                'live_url' => 'https://aplikasi-distribusi-frekuensi.vercel.app',
                'is_featured' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emoji' => '🔐',
                'title' => 'Hill Cipher Simulator',
                'description' => 'Interactive cryptography learning tool for Hill Cipher. Features include matrix-based encryption, decryption, educational content, and history tracking.',
                'tech_stack' => 'Web, HTML, CSS, JavaScript',
                'tags' => json_encode(['Cryptography', 'Education', 'Simulator', 'Web']),
                'accent_color' => '#10B981',
                'github_url' => 'https://github.com/barbarbarox/hil-cipher',
                'live_url' => 'https://hil-cipher.vercel.app/',
                'is_featured' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emoji' => '🏠',
                'title' => 'Prediksi Harga Rumah',
                'description' => 'Aplikasi prediksi harga rumah berbasis Machine Learning dengan algoritma Linear Regression. Dapat memprediksi harga properti secara instan berdasarkan 7 pertanyaan, bekerja 100% offline tanpa API key.',
                'tech_stack' => 'Machine Learning, Web',
                'tags' => json_encode(['Machine Learning', 'Linear Regression', 'Prediction', 'Web App']),
                'accent_color' => '#F59E0B',
                'github_url' => 'https://github.com/barbarbarox/prediksi-rumah',
                'live_url' => 'https://prediksi-rumah.vercel.app/',
                'is_featured' => true,
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emoji' => '🎯',
                'title' => 'Catch-On',
                'description' => 'Platform belajar gamifikasi untuk meningkatkan kemampuan bahasa Inggris. Membantu pengguna menguasai IELTS, TOEFL, dan TOEP dengan fitur courses, quizzes, dan leaderboard.',
                'tech_stack' => 'HTML, CSS, JavaScript',
                'tags' => json_encode(['Education', 'English Learning', 'Gamification', 'Web']),
                'accent_color' => '#8B5CF6',
                'github_url' => 'https://github.com/barbarbarox/catch-on',
                'live_url' => 'https://catch-on-gray.vercel.app/index.html',
                'is_featured' => true,
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'emoji' => '🕵️',
                'title' => 'Vigenère Cipher Cryptanalysis',
                'description' => 'Toolkit lengkap untuk analisis dan pemecahan sandi Vigenère langsung di browser. Dilengkapi fitur enkripsi/dekripsi, analisis frekuensi sub-string, estimasi panjang kunci (metode Kasiski & IoC), dan rekonstruksi kunci lengkap.',
                'tech_stack' => 'Web, JavaScript',
                'tags' => json_encode(['Cryptography', 'Cryptanalysis', 'Security', 'Tools']),
                'accent_color' => '#6366F1',
                'github_url' => 'https://github.com/barbarbarox/kriptanalisis-kasiski',
                'live_url' => 'https://kriptanalisis-kasiski.vercel.app/',
                'is_featured' => true,
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}
