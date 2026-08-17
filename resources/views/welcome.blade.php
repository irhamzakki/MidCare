<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MindCare - Deteksi Dini Kesehatan Mental</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon">

    {{-- Untuk project Laravel yang sudah memakai Tailwind via Vite, ganti CDN ini dengan:
         @vite(['resources/css/app.css', 'resources/js/app.js'])
    --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html { scroll-behavior: smooth; }
        .glass { backdrop-filter: blur(14px); background: rgba(255,255,255,.85); }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
    <div class="min-h-screen flex flex-col">

        @include('header')

        <main class="flex-1">

            {{-- Hero --}}
            <section class="relative overflow-hidden py-20 lg:py-28">
                <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-blue-200 blur-3xl opacity-60"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full bg-emerald-200 blur-3xl opacity-60"></div>

                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
                    <div>

                        <h2 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight mb-6">
                            Kenali Kondisi Mental Anda
                            <span class="text-blue-600">Lebih Awal</span>
                        </h2>

                        <p class="text-lg text-slate-600 leading-relaxed mb-8 max-w-xl">
                            MindCare membantu pengguna melakukan screening awal kesehatan mental,
                            mengelompokkan tingkat risiko menggunakan K-Means Clustering, dan memberikan
                            rekomendasi tindak lanjut secara cepat, aman, dan mudah dipahami.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ url('/screening') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow-lg shadow-blue-200">
                                Mulai Screening
                                <span class="ml-2">→</span>
                            </a>

                            <a href="#cara-kerja" class="inline-flex items-center justify-center px-6 py-3 rounded-2xl bg-white border border-slate-200 font-semibold hover:bg-slate-100">
                                Pelajari Cara Kerja
                            </a>
                        </div>

                        <div class="grid grid-cols-3 gap-5 mt-10 max-w-lg">
                            <div>
                                <p class="text-3xl font-bold text-blue-600">10+</p>
                                <p class="text-sm text-slate-500">Pertanyaan</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-emerald-600">3</p>
                                <p class="text-sm text-slate-500">Kategori Risiko</p>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-amber-500">24/7</p>
                                <p class="text-sm text-slate-500">Akses Sistem</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="bg-white rounded-[2rem] shadow-2xl border border-slate-200 p-8">
                            <div class="flex items-center justify-between mb-8">
                                <div>
                                    <p class="text-sm text-slate-500">Hasil Screening</p>
                                    <h3 class="text-2xl font-bold">Risiko Sedang</h3>
                                </div>
                                <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl">
                                    🧠
                                </div>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span>Karakter & Regulasi Emosi</span><span>68%</span>
                                    </div>
                                    <div class="h-3 rounded-full bg-slate-100">
                                        <div class="h-3 rounded-full bg-amber-500" style="width:68%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span>Koping & Penerimaan</span><span>52%</span>
                                    </div>
                                    <div class="h-3 rounded-full bg-slate-100">
                                        <div class="h-3 rounded-full bg-blue-500" style="width:52%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span>Hubungan dengan Ayah</span><span>74%</span>
                                    </div>
                                    <div class="h-3 rounded-full bg-slate-100">
                                        <div class="h-3 rounded-full bg-emerald-500" style="width:74%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-2">
                                        <span>Hubungan dengan ibu</span><span>70%</span>
                                    </div>
                                    <div class="h-3 rounded-full bg-slate-100">
                                        <div class="h-3 rounded-full bg-blue-700" style="width:70%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 p-5 rounded-2xl bg-blue-50 border border-blue-100">
                                <p class="font-semibold text-blue-700 mb-1">Rekomendasi</p>
                                <p class="text-sm text-slate-600">
                                    Lakukan refleksi harian, atur pola tidur, dan pertimbangkan konsultasi dengan psikolog.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Fitur --}}
            <section id="fitur" class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <p class="inline-flex px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-sm font-semibold mb-4">
                            Fitur Utama
                        </p>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Sistem Screening yang Lengkap</h2>
                        <p class="text-slate-600 max-w-2xl mx-auto">
                            Website ini dirancang sebagai Decision Support System dan Mental Health Screening System.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="p-7 rounded-3xl border border-slate-200 bg-slate-50 hover:shadow-lg transition">
                            <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl mb-5">📋</div>
                            <h3 class="text-xl font-bold mb-3">Screening Kesehatan Mental</h3>
                            <p class="text-slate-600 leading-relaxed">
                                Pengguna mengisi kuesioner berbasis skala Likert untuk mengidentifikasi gejala awal.
                            </p>
                        </div>

                        <div class="p-7 rounded-3xl border border-slate-200 bg-slate-50 hover:shadow-lg transition">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mb-5">📊</div>
                            <h3 class="text-xl font-bold mb-3">Clustering K-Means</h3>
                            <p class="text-slate-600 leading-relaxed">
                                Sistem mengelompokkan hasil pengguna ke dalam kategori risiko ringan, sedang, atau berat.
                            </p>
                        </div>

                        <div class="p-7 rounded-3xl border border-slate-200 bg-slate-50 hover:shadow-lg transition">
                            <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl mb-5">💬</div>
                            <h3 class="text-xl font-bold mb-3">Rekomendasi Konseling</h3>
                            <p class="text-slate-600 leading-relaxed">
                                Pengguna mendapatkan saran tindak lanjut sesuai hasil screening dan tingkat risikonya.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Cara kerja --}}
            <section id="cara-kerja" class="py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <p class="inline-flex px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-semibold mb-4">
                            Cara Kerja Sistem
                        </p>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Alur Analisis MindCare</h2>
                        <p class="text-slate-600 max-w-2xl mx-auto">
                            Sistem memproses jawaban pengguna hingga menjadi hasil risiko yang mudah dipahami.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-4 gap-6">
                        @php
                            $steps = [
                                ['no' => '01', 'title' => 'Isi Kuesioner', 'desc' => 'Pengguna menjawab pertanyaan kesehatan mental.'],
                                ['no' => '02', 'title' => 'Preprocessing', 'desc' => 'Jawaban divalidasi dan diubah menjadi data numerik.'],
                                ['no' => '03', 'title' => 'Clustering', 'desc' => 'Data dianalisis menggunakan metode K-Means.'],
                                ['no' => '04', 'title' => 'Hasil & Rekomendasi', 'desc' => 'Sistem menampilkan kategori risiko dan saran tindak lanjut.'],
                            ];
                        @endphp

                        @foreach ($steps as $step)
                            <div class="bg-white p-7 rounded-3xl border border-slate-200 shadow-sm">
                                <p class="text-blue-600 font-extrabold text-2xl mb-4">{{ $step['no'] }}</p>
                                <h3 class="font-bold text-lg mb-2">{{ $step['title'] }}</h3>
                                <p class="text-slate-600 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Testimoni --}}
            <section id="testimoni" class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <p class="inline-flex px-4 py-2 rounded-full bg-amber-100 text-amber-700 text-sm font-semibold mb-4">
                            Testimoni
                        </p>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">Apa Kata Mereka?</h2>
                        <p class="text-slate-600 max-w-2xl mx-auto">
                            Pengalaman pengguna setelah mengenali kondisi kesehatan mental mereka.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @php
                            $testimonials = [
                                ['name' => 'Rina Maharani', 'role' => 'Mahasiswa, 20 tahun', 'text' => 'Sistem ini membantu saya mengenali tingkat stres dan memahami rekomendasi yang perlu dilakukan.'],
                                ['name' => 'Budi Pratama', 'role' => 'Pelajar SMA, 17 tahun', 'text' => 'Hasil screening mudah dipahami dan membuat saya lebih sadar dengan kondisi mental saya.'],
                                ['name' => 'Siti Nurhaliza', 'role' => 'Mahasiswa, 22 tahun', 'text' => 'Fitur rekomendasi sangat membantu sebagai langkah awal sebelum berkonsultasi.'],
                            ];
                        @endphp

                        @foreach ($testimonials as $item)
                            <div class="p-7 rounded-3xl border border-slate-200 bg-slate-50">
                                <div class="text-amber-400 text-xl mb-4">★★★★★</div>
                                <p class="text-slate-600 leading-relaxed mb-6">“{{ $item['text'] }}”</p>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                        {{ collect(explode(' ', $item['name']))->map(fn($n) => $n[0])->join('') }}
                                    </div>
                                    <div>
                                        <p class="font-bold">{{ $item['name'] }}</p>
                                        <p class="text-sm text-slate-500">{{ $item['role'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- CTA --}}
            <section class="py-20 bg-gradient-to-br from-blue-600 to-blue-800">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-5">
                        Siap Mengenali Kondisi Kesehatan Mental Anda?
                    </h2>
                    <p class="text-blue-100 max-w-2xl mx-auto mb-8">
                        Mulai screening sekarang dan dapatkan insight awal tentang kondisi kesehatan mental Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ url('/screening') }}" class="px-6 py-3 rounded-2xl bg-white text-blue-700 font-bold hover:bg-blue-50">
                            Mulai Screening
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-3 rounded-2xl border border-white text-white font-bold hover:bg-white/10">
                            Daftar Akun
                        </a>
                    </div>
                </div>
            </section>
        </main>

        @include('footer')
    </div>
</body>
</html>
