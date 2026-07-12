-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql100.infinityfree.com
-- Generation Time: Jun 22, 2026 at 03:46 AM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41244839_portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `tech_stack` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `github_link` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `image`, `category`, `tech_stack`, `link`, `github_link`, `is_featured`, `created_at`) VALUES
(1, 'Web jual beli hadiah', 'Platform e-commerce dengan total 3 user, pembeli, penjual dan admin, web ini menjadi penghubung antara penjual dan pembeli.', 'project1.jpg', 'Web App', 'Laravel, MySQL,', 'https://giftkita.ours.web.id', 'https://github.com/barbarbarox/giftkita22/', 1, '2026-02-25 08:47:52'),
(2, 'Arsip Budaya Daerah Bengkalis', 'Platform yang bertujuan untuk menjaga dan melestarikan budaya daerah Bengkalis.', 'project2.jpg', 'Web App', 'Laravel, MySQL', 'https://jejaklayar.ours.web.id', 'https://github.com/natasya740/jejaklayar', 1, '2026-02-25 08:47:52'),
(3, 'Portfolio Website', 'Website portfolio responsif dengan tema gelap dan animasi modern.', 'project3.jpg', 'Website', 'HTML, CSS, JavaScript, PHP Native', 'https://abarox.page.gd', 'https://github.com/barbarbarox/protofolio_barox', 1, '2026-02-25 08:47:52'),
(4, 'Serikat Kematian Pangkalan Batang', 'Web Serikat kematian yang dilengkapi dengan beberapa fitur pungut iuran, cek data, olah data dan lainnya.', 'project4.jpg', 'Web App', 'Laravel, MySQL.', 'https://serikatkematian.arunikacyber.my.id/', 'https://github.com/barbarbarox/', 0, '2026-02-25 08:47:52'),
(5, 'Game Tebak Gambar Python', 'Praktikum Python Sederhana', 'project5.jpg', 'Other', 'Python, MySQL, dll', 'https://github.com/barbarbarox', 'https://github.com/barbarbarox', 0, '2026-02-25 08:47:52'),
(6, 'AI prediksi harga rumah', 'AI untuk prediksi harga rumah dengan menjawab 7 pertanyaan\r\n\r\nnote: data yang dipakai adalah data perumahan dari luar negeri, jadi harga kemungkinan lebih tinggi dari di indonesia\r\n\r\ndan untuk sekarang API nya saya matikan', 'project6.jpg', 'Other', 'Python, JavaSript, dll', 'https://prediksi-rumah.vercel.app/', 'https://github.com/barbarbarox/prediksi-rumah', 1, '2026-02-25 08:47:52'),
(7, 'Web Animasi Scroll', 'Web dengan sroll animation yang smooth, namun kualitas gambarnya masih tidak terlalu bagus', NULL, 'Web App', 'HTML, CSS, JavaScript', 'https://3dweb-elf.vercel.app/', 'https://github.com/barbarbarox/3dweb-elf', 0, '2026-03-05 17:01:05'),
(8, 'AI anime sederhana', 'Buat ai sederhana dengan API gratisan, fiturnya cuma chat biasa, ini project untuk latihan membuat project besar lain', NULL, 'Other', 'AI, JavaScript, HTML, CSS, Python, dll', 'https://ai-kirigiri.vercel.app/', 'https://github.com/barbarbarox/ai-kirigiri', 1, '2026-03-07 18:31:50'),
(9, 'Perhitungan distribusi frekuensi', 'aplikasi perhitungan distribusi frekuensi & Mesin Kalkulasi Fisika Statistik', NULL, 'Web App', 'Node js', 'https://aplikasi-distribusi-frekuensi.vercel.app/', 'https://github.com/barbarbarox/aplikasi-distribusi-frekuensi', 1, '2026-04-02 01:14:12'),
(10, 'Pencarian Cerdas Al-Qur\'an & Hadits', 'web ini menggunakan dataset alquran dari kementrian agama, dataset hadist opensource\r\n\r\nProyek ini mengadopsi arsitektur AI yang disebut RAG (Retrieval-Augmented Generation), yang memanfaatkan dua jenis model AI berbeda untuk dua tugas yang spesifik\r\n\r\nModel Embedding (Vectorisasi Data): gemini-embedding-001 dari Google AI\r\nFungsi: Mengubah teks bahasa Arab dan terjemahan Al-Qur\'an/Hadits menjadi susunan angka matematis (vektor) agar sistem bisa mengukur kedekatan makna (semantic similarity) antara pertanyaan Anda dan dalil di database.\r\nKarakteristik: Model terbaru dari lini Gemini ini sangat canggih dan mendalam, menghasilkan vektor berdimensi cukup besar yaitu 3072 dimensi.\r\n\r\n\r\nModel LLM (Penjawab/Generator): llama-3.3-70b-versatile via Groq API\r\nFungsi: Bertindak sebagai ustadz AI. LLaMA-3 membaca dokumen dalil Al-Qur\'an/Hadits yang berhasil didapatkan dari database, lalu menyusun jawaban penjelasannya ke dalam Bahasa Indonesia yang ramah, moderat, dan mudah dipahami, sekaligus mengalirkan jawabannya secara real-time (Streaming).\r\n\r\n\r\nNOTE : PROJECT INI MASIH MENGGUNAKAN MODEL AI GRATISAN (KURANG PINTAR), dan TOLLS LAINNYA, DAN MUNGKIN BANYAK PERTANYAAN YANG TIDAK DAPAT DI JAWAB TIDAK TEPAT', NULL, 'Web App', 'Supabase vector, MySql, groq, google ai studio, Node Js, dataset kemanag, opensource dataset, dan lainnya', 'https://islami-ad6z.vercel.app/', 'https://github.com/barbarbarox/islami', 1, '2026-04-02 01:26:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
