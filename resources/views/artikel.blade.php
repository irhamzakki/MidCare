<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MindCare - Artikel Kesehatan Mental</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
        .glass {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.82);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 overflow-x-hidden">

    <section class="relative min-h-[80vh] overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-cyan-800">

        <div class="absolute -top-28 -left-28 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 right-0 w-96 h-96 bg-cyan-400/25 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 w-[500px] h-[500px] bg-blue-500/20 rounded-full blur-3xl"></div>

        @include('header')

        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-24 pb-24 grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            <div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-white mb-7">
                    Baca Artikel Ringan untuk Memahami Kesehatan Mental
                </h1>

                <p class="text-lg text-blue-100 leading-relaxed max-w-2xl">
                    Kumpulan artikel edukatif seputar kesehatan mental, stres, kecemasan,
                    manajemen emosi, kebiasaan sehat, dan pentingnya mencari bantuan
                    ketika kondisi psikologis mulai mengganggu aktivitas.
                </p>

                <div class="flex flex-wrap gap-4 mt-9">
                    <a href="#artikel"
                       class="px-7 py-4 rounded-2xl bg-white text-blue-900 font-bold shadow-xl hover:-translate-y-1 transition duration-300">
                        Lihat Artikel
                    </a>

                    <a href="#kategori"
                       class="px-7 py-4 rounded-2xl border border-white/30 text-white font-bold hover:bg-white/10 transition duration-300">
                        Kategori
                    </a>
                </div>
            </div>

            <div class="relative hidden lg:block">
                <div class="glass rounded-[2rem] p-8 shadow-2xl border border-white/30">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-3xl mb-6">
                        📚
                    </div>

                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">
                        Artikel Terbaru
                    </h3>

                    <div class="space-y-4">
                        <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm">
                            <p class="text-sm text-cyan-600 font-bold mb-1">Manajemen Stres</p>
                            <h4 class="font-extrabold text-slate-800">Cara Mengelola Stres pada Remaja</h4>
                        </div>

                        <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm">
                            <p class="text-sm text-blue-600 font-bold mb-1">Kecemasan</p>
                            <h4 class="font-extrabold text-slate-800">Mengenal Gejala Cemas Berlebihan</h4>
                        </div>

                        <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm">
                            <p class="text-sm text-purple-600 font-bold mb-1">Self Care</p>
                            <h4 class="font-extrabold text-slate-800">Kebiasaan Kecil untuk Menjaga Mental</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="py-20 px-6 bg-white" id="kategori">
        <div class="max-w-7xl mx-auto">

            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">
                    Kategori Artikel
                </span>

                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mt-4 mb-5">
                    Pilih Topik yang Ingin Dipelajari
                </h2>

                <p class="text-slate-500 leading-relaxed text-lg">
                    Artikel dikelompokkan berdasarkan topik agar pengguna lebih mudah
                    menemukan bacaan sesuai kebutuhan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-6 rounded-[2rem] bg-cyan-50 border border-cyan-100">
                    <div class="text-4xl mb-4">🧠</div>
                    <h3 class="font-extrabold text-slate-900 text-xl">Mental Health</h3>
                    <p class="text-slate-500 mt-2">Dasar kesehatan mental.</p>
                </div>

                <div class="p-6 rounded-[2rem] bg-blue-50 border border-blue-100">
                    <div class="text-4xl mb-4">🌧️</div>
                    <h3 class="font-extrabold text-slate-900 text-xl">Stres</h3>
                    <p class="text-slate-500 mt-2">Cara mengelola tekanan.</p>
                </div>

                <div class="p-6 rounded-[2rem] bg-purple-50 border border-purple-100">
                    <div class="text-4xl mb-4">💬</div>
                    <h3 class="font-extrabold text-slate-900 text-xl">Konseling</h3>
                    <p class="text-slate-500 mt-2">Pentingnya bercerita.</p>
                </div>

                <div class="p-6 rounded-[2rem] bg-pink-50 border border-pink-100">
                    <div class="text-4xl mb-4">🌱</div>
                    <h3 class="font-extrabold text-slate-900 text-xl">Self Care</h3>
                    <p class="text-slate-500 mt-2">Kebiasaan sehat harian.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-6 bg-gradient-to-br from-blue-50 via-cyan-50 to-indigo-50" id="artikel">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
                <div>
                    <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">
                        Daftar Artikel
                    </span>

                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mt-4">
                        Artikel Pilihan
                    </h2>
                </div>

                <p class="text-slate-500 max-w-xl leading-relaxed">
                    Bacaan singkat dan informatif untuk membantu memahami kondisi mental
                    serta langkah sederhana menjaga keseimbangan diri.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <article class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-slate-100 hover:-translate-y-2 transition duration-300">
                    <div class="h-52 bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-6xl">
                        🧠
                    </div>

                    <div class="p-7">
                        <span class="text-sm font-bold text-cyan-600">Mental Health</span>

                        <h3 class="text-2xl font-extrabold text-slate-900 mt-3 mb-4">
                            Apa Itu Kesehatan Mental dan Mengapa Penting?
                        </h3>

                        <p class="text-slate-500 leading-relaxed mb-6">
                            Kesehatan mental memengaruhi cara seseorang berpikir, merasa,
                            berinteraksi, dan menghadapi tekanan hidup sehari-hari.
                        </p>

                        <a href="#" class="font-extrabold text-cyan-600 hover:text-cyan-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-slate-100 hover:-translate-y-2 transition duration-300">
                    <div class="h-52 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-6xl">
                        ⚠️
                    </div>

                    <div class="p-7">
                        <span class="text-sm font-bold text-orange-500">Stres Remaja</span>

                        <h3 class="text-2xl font-extrabold text-slate-900 mt-3 mb-4">
                            Tanda Stres yang Sering Tidak Disadari
                        </h3>

                        <p class="text-slate-500 leading-relaxed mb-6">
                            Stres dapat muncul melalui perubahan pola tidur, emosi tidak stabil,
                            sulit fokus, dan menurunnya semangat beraktivitas.
                        </p>

                        <a href="#" class="font-extrabold text-orange-500 hover:text-orange-700">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-slate-100 hover:-translate-y-2 transition duration-300">
                    <div class="h-52 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-6xl">
                        💬
                    </div>

                    <div class="p-7">
                        <span class="text-sm font-bold text-purple-600">Konseling</span>

                        <h3 class="text-2xl font-extrabold text-slate-900 mt-3 mb-4">
                            Mengapa Bercerita Bisa Membantu?
                        </h3>

                        <p class="text-slate-500 leading-relaxed mb-6">
                            Berbagi cerita kepada orang terpercaya dapat membantu mengurangi
                            tekanan emosional dan membuka jalan mencari solusi.
                        </p>

                        <a href="#" class="font-extrabold text-purple-600 hover:text-purple-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-slate-100 hover:-translate-y-2 transition duration-300">
                    <div class="h-52 bg-gradient-to-br from-emerald-400 to-cyan-500 flex items-center justify-center text-6xl">
                        🌱
                    </div>

                    <div class="p-7">
                        <span class="text-sm font-bold text-emerald-600">Self Care</span>

                        <h3 class="text-2xl font-extrabold text-slate-900 mt-3 mb-4">
                            Kebiasaan Kecil untuk Menjaga Mental
                        </h3>

                        <p class="text-slate-500 leading-relaxed mb-6">
                            Tidur cukup, olahraga ringan, mengatur waktu, dan membatasi media sosial
                            dapat membantu menjaga kestabilan mental.
                        </p>

                        <a href="#" class="font-extrabold text-emerald-600 hover:text-emerald-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-slate-100 hover:-translate-y-2 transition duration-300">
                    <div class="h-52 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-6xl">
                        🌙
                    </div>

                    <div class="p-7">
                        <span class="text-sm font-bold text-blue-600">Pola Tidur</span>

                        <h3 class="text-2xl font-extrabold text-slate-900 mt-3 mb-4">
                            Hubungan Tidur dengan Kesehatan Mental
                        </h3>

                        <p class="text-slate-500 leading-relaxed mb-6">
                            Pola tidur yang buruk dapat memengaruhi suasana hati, konsentrasi,
                            dan kemampuan seseorang dalam mengelola tekanan.
                        </p>

                        <a href="#" class="font-extrabold text-blue-600 hover:text-blue-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>

                <article class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-slate-100 hover:-translate-y-2 transition duration-300">
                    <div class="h-52 bg-gradient-to-br from-rose-400 to-red-500 flex items-center justify-center text-6xl">
                        ❤️
                    </div>

                    <div class="p-7">
                        <span class="text-sm font-bold text-rose-600">Dukungan Sosial</span>

                        <h3 class="text-2xl font-extrabold text-slate-900 mt-3 mb-4">
                            Peran Keluarga dan Teman dalam Menjaga Mental
                        </h3>

                        <p class="text-slate-500 leading-relaxed mb-6">
                            Dukungan sosial dapat membantu seseorang merasa diterima,
                            didengarkan, dan tidak sendirian saat menghadapi masalah.
                        </p>

                        <a href="#" class="font-extrabold text-rose-600 hover:text-rose-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <section class="py-24 px-6 bg-white">
        <div class="max-w-5xl mx-auto text-center rounded-[2rem] bg-gradient-to-br from-cyan-600 via-blue-600 to-indigo-700 px-8 py-16 text-white shadow-2xl">
            <h2 class="text-3xl md:text-5xl font-extrabold mb-6">
                Ingin Memahami Kesehatan Mental Lebih Dalam?
            </h2>

            <p class="text-blue-100 max-w-3xl mx-auto leading-relaxed text-lg mb-9">
                Baca artikel secara bertahap dan gunakan halaman edukasi untuk memahami
                tanda-tanda awal gangguan kesehatan mental serta cara menjaga keseimbangan diri.
            </p>

            <a href="{{ route('Edukasi') }}"
               class="inline-flex px-8 py-4 rounded-2xl bg-white text-blue-700 font-extrabold hover:-translate-y-1 transition duration-300">
                Buka Halaman Edukasi
            </a>
        </div>
    </section>

    @include('footer')

</body>
</html>