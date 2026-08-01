<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MindCare - Edukasi Kesehatan Mental</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        .glass {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.82);
        }

        .gradient-text {
            background: linear-gradient(135deg, #2563eb, #06b6d4, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .floating {
            animation: floating 5s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-18px);
            }
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 overflow-x-hidden">

    <section class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-950 via-blue-950 to-cyan-800">

        <div class="absolute -top-28 -left-28 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl"></div>
        <div class="absolute top-40 right-0 w-96 h-96 bg-cyan-400/25 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 w-[500px] h-[500px] bg-blue-500/20 rounded-full blur-3xl"></div>

        @include('header')

        <div class="relative z-10 max-w-7xl mx-auto px-6 pt-24 pb-24 grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            <div>

                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight text-white mb-7">
                    Pahami Kesehatan Mental untuk Hidup Lebih Seimbang
                </h1>

                <p class="text-lg text-blue-100 leading-relaxed max-w-2xl">
                    Halaman edukasi ini membantu pengguna memahami pentingnya kesehatan mental,
                    mengenali tanda awal gangguan psikologis, serta mengetahui langkah sederhana
                    untuk menjaga kondisi emosi, pikiran, dan perilaku sehari-hari.
                </p>

                <div class="flex flex-wrap gap-4 mt-9">
                    <a href="#materi"
                       class="px-7 py-4 rounded-2xl bg-white text-blue-900 font-bold shadow-xl hover:-translate-y-1 transition duration-300">
                        Mulai Belajar
                    </a>

                    <a href="#tips"
                       class="px-7 py-4 rounded-2xl border border-white/30 text-white font-bold hover:bg-white/10 transition duration-300">
                        Lihat Tips
                    </a>
                </div>
            </div>

            <div class="relative hidden lg:block">
                <div class="floating relative z-10 glass rounded-[2rem] p-8 shadow-2xl border border-white/30">
                    <div class="flex items-center gap-4 mb-7">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-3xl">
                            🧠
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900">Mental Wellness</h3>
                            <p class="text-slate-500 text-sm">Edukasi, pencegahan, dan dukungan</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="p-5 rounded-2xl bg-white shadow-sm border border-slate-100">
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-slate-700">Kesadaran Diri</span>
                                <span class="text-cyan-600 font-bold">85%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3">
                                <div class="bg-gradient-to-r from-cyan-500 to-blue-600 h-3 rounded-full w-[85%]"></div>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-white shadow-sm border border-slate-100">
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-slate-700">Manajemen Emosi</span>
                                <span class="text-blue-600 font-bold">72%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full w-[72%]"></div>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-white shadow-sm border border-slate-100">
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-slate-700">Dukungan Sosial</span>
                                <span class="text-purple-600 font-bold">90%</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3">
                                <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full w-[90%]"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-10 -left-10 w-44 h-44 bg-cyan-400/30 rounded-full blur-2xl"></div>
            </div>
        </div>
    </section>

    <section class="py-24 px-6 bg-white" id="materi">
        <div class="max-w-7xl mx-auto">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">
                    Materi Edukasi
                </span>

                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 mt-4 mb-5">
                    Belajar Kesehatan Mental dengan Mudah
                </h2>

                <p class="text-slate-500 leading-relaxed text-lg">
                    Beberapa materi dasar yang membantu pengguna memahami kesehatan mental
                    secara sederhana, ringan, dan mudah dipahami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="group p-8 rounded-[2rem] bg-slate-50 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-3xl mb-6 shadow-lg">
                        🧠
                    </div>

                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">
                        Apa Itu Kesehatan Mental?
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Kesehatan mental adalah kondisi ketika seseorang mampu mengelola emosi,
                        berpikir jernih, menjalin hubungan sosial, dan menghadapi tekanan hidup.
                    </p>
                </div>

                <div class="group p-8 rounded-[2rem] bg-slate-50 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-3xl mb-6 shadow-lg">
                        ⚠️
                    </div>

                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">
                        Tanda Risiko Mental
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Perubahan suasana hati, sulit tidur, kehilangan minat, mudah cemas,
                        dan menarik diri dari lingkungan dapat menjadi tanda awal yang perlu diperhatikan.
                    </p>
                </div>

                <div class="group p-8 rounded-[2rem] bg-slate-50 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-3xl mb-6 shadow-lg">
                        💬
                    </div>

                    <h3 class="text-2xl font-extrabold text-slate-900 mb-4">
                        Pentingnya Bercerita
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Menceritakan masalah kepada orang terpercaya, guru BK, keluarga,
                        atau psikolog dapat membantu mengurangi beban pikiran.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-24 px-6 bg-gradient-to-br from-blue-50 via-cyan-50 to-indigo-50" id="tips">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-xl border border-slate-100">
                <span class="text-cyan-600 font-bold uppercase tracking-widest text-sm">
                    Tips Harian
                </span>

                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-4 mb-5">
                    Cara Menjaga Kesehatan Mental
                </h2>

                <p class="text-slate-500 leading-relaxed mb-8">
                    Menjaga kesehatan mental dapat dilakukan melalui kebiasaan sederhana
                    yang dilakukan secara konsisten dalam kehidupan sehari-hari.
                </p>

                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                        <span class="w-9 h-9 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold">✓</span>
                        <span class="font-semibold text-slate-700">Tidur cukup dan teratur</span>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                        <span class="w-9 h-9 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold">✓</span>
                        <span class="font-semibold text-slate-700">Mengatur waktu belajar dan istirahat</span>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                        <span class="w-9 h-9 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold">✓</span>
                        <span class="font-semibold text-slate-700">Mengurangi penggunaan media sosial berlebihan</span>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                        <span class="w-9 h-9 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold">✓</span>
                        <span class="font-semibold text-slate-700">Berolahraga ringan secara rutin</span>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                        <span class="w-9 h-9 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold">✓</span>
                        <span class="font-semibold text-slate-700">Berbicara dengan orang yang dipercaya</span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-950 rounded-[2rem] p-8 md:p-10 shadow-xl text-white relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-cyan-500/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <span class="text-cyan-300 font-bold uppercase tracking-widest text-sm">
                        Bantuan Profesional
                    </span>

                    <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-5">
                        Kapan Perlu Mencari Bantuan?
                    </h2>

                    <p class="text-slate-300 leading-relaxed mb-6">
                        Bantuan profesional perlu dipertimbangkan apabila perasaan sedih, cemas,
                        stres, atau kehilangan semangat berlangsung lama dan mulai mengganggu
                        aktivitas harian.
                    </p>

                    <p class="text-slate-300 leading-relaxed mb-8">
                        Mencari bantuan bukan tanda kelemahan, tetapi bentuk keberanian untuk
                        menjaga diri dan memperbaiki kualitas hidup.
                    </p>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-5 rounded-2xl bg-white/10 border border-white/10">
                            <h4 class="text-3xl font-extrabold text-cyan-300">24/7</h4>
                            <p class="text-sm text-slate-300 mt-1">Butuh perhatian</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-white/10 border border-white/10">
                            <h4 class="text-3xl font-extrabold text-cyan-300">Aman</h4>
                            <p class="text-sm text-slate-300 mt-1">Bercerita tanpa takut</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="py-24 px-6 bg-white" id="bantuan">
        <div class="max-w-5xl mx-auto text-center rounded-[2rem] bg-gradient-to-br from-cyan-600 via-blue-600 to-indigo-700 px-8 py-16 text-white shadow-2xl">
            <h2 class="text-3xl md:text-5xl font-extrabold mb-6">
                Butuh Bantuan Lebih Lanjut?
            </h2>

            <p class="text-blue-100 max-w-3xl mx-auto leading-relaxed text-lg mb-9">
                Jika kamu merasa kondisi mental sedang tidak baik, jangan ragu untuk bercerita
                kepada orang terdekat atau menghubungi tenaga profesional seperti guru BK,
                konselor, atau psikolog.
            </p>

            <a href="#materi"
               class="inline-flex px-8 py-4 rounded-2xl bg-white text-blue-700 font-extrabold hover:-translate-y-1 transition duration-300">
                Pelajari Lagi
            </a>
        </div>
    </section>

    @include('footer')

</body>
</html>