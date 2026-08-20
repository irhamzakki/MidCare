<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak Kami - MidCare</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 20%, rgba(14, 165, 233, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(99, 102, 241, 0.08) 0%, transparent 40%),
                #f8fafc;
            color: #0f172a;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.06);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 35px -5px rgba(15, 23, 42, 0.1);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    @include('header')

    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
        <!-- Hero Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-sky-100 text-sky-700 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Pusat Bantuan & Komunikasi
            </span>
            <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                Hubungi Tim <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-600 to-indigo-600">MidCare</span>
            </h1>
            <p class="mt-4 text-base sm:text-lg text-slate-600 leading-relaxed">
                Kami siap mendengarkan dan membantu Anda. Silakan hubungi kami untuk informasi lebih lanjut mengenai layanan kesehatan mental, konsultasi, atau bantuan teknis.
            </p>
        </div>

        <!-- Contact Cards & Info Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <!-- Info Card 1 -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Email Kami</h3>
                <p class="text-sm text-slate-500 mb-4">Kirimkan pertanyaan kapan saja, kami akan merespons dalam 24 jam.</p>
                <a href="mailto:support@mindcare.com" class="font-semibold text-sky-600 hover:text-sky-700">support@mindcare.com</a>
            </div>

            <!-- Info Card 2 -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Hotline & WhatsApp</h3>
                <p class="text-sm text-slate-500 mb-4">Layanan informasi aktif Senin - Jumat, 08.00 - 17.00 WIB.</p>
                <a href="tel:+6281234567890" class="font-semibold text-emerald-600 hover:text-emerald-700">+62 812-3456-7890</a>
            </div>

            <!-- Info Card 3 -->
            <div class="glass-card rounded-2xl p-8 flex flex-col items-center text-center">
                <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Lokasi Konsultasi</h3>
                <p class="text-sm text-slate-500 mb-4">Pusat Layanan Psikologi & Kesehatan Mental Terpadu.</p>
                <span class="font-semibold text-slate-700">Indonesia</span>
            </div>
        </div>

        <!-- Contact Form Card -->
        <div class="glass-card rounded-3xl p-8 sm:p-12 max-w-4xl mx-auto">
            <div class="mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Kirimkan Pesan Anda</h2>
                <p class="text-slate-500 text-sm mt-1">Isi formulir berikut dan tim kami akan segera menghubungi Anda kembali.</p>
            </div>

            <form onsubmit="event.preventDefault(); alert('Terima kasih! Pesan Anda telah terkirim.');" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" required placeholder="Masukkan nama Anda" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent bg-white/70">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" required placeholder="nama@email.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent bg-white/70">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Subjek Pesan</label>
                    <input type="text" required placeholder="Pertanyaan atau kendala yang ingin disampaikan" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent bg-white/70">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Isi Pesan</label>
                    <textarea rows="5" required placeholder="Tuliskan pesan Anda secara detail..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent bg-white/70"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-white bg-gradient-to-r from-sky-600 to-indigo-600 hover:from-sky-700 hover:to-indigo-700 shadow-lg shadow-sky-500/25 transition-all transform hover:-translate-y-0.5">
                        <span>Kirim Pesan</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>
    </main>

    @include('footer')

</body>
</html>
