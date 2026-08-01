<x-app-layout>
    <style>
        .screening-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 24px;
            font-family: 'Segoe UI', sans-serif;
            transition: all 0.3s ease;
        }

        @media (min-width: 640px) {
            .screening-page {
                padding: 40px;
            }
        }

        .screening-page .hero-card {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #0891b2);
            color: white;
            padding: 36px;
            border-radius: 28px;
            margin-bottom: 28px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, .25);
        }

        .screening-page .hero-card h1 {
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 12px;
        }

        .screening-page .hero-card p {
            color: #dbeafe;
            line-height: 1.8;
            max-width: 760px;
        }

        .screening-page .info-card {
            background: white;
            border: 1px solid #cbd5e1;
            border-radius: 24px;
            padding: 22px;
            margin-bottom: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
        }

        .screening-page .info-card strong {
            font-weight: 900;
            color: #0f172a;
        }

        .screening-page .info-card a {
            color: #0f172a;
            font-weight: 700;
            text-decoration: underline;
        }

        .screening-page .article-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        }

        .screening-page .form-input-custom,
        .screening-page .form-input-custom select {
            width: 100%;
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            line-height: 1.4rem;
            border: 1px solid #cbd5e1;
            border-radius: 18px;
            background-color: #ffffff;
            color: #1e293b;
            outline: none;
            transition: all 0.2s ease;
        }

        .screening-page .form-input-custom:focus,
        .screening-page .form-input-custom select:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
        }

        .screening-page .radio-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
            background: #f8fafc;
            padding: 0.75rem;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
        }

        .screening-page .radio-grid label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.65rem 0.8rem;
            border-radius: 14px;
            font-size: 0.8rem;
            color: #475569;
            background: white;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .screening-page .radio-grid input[type='radio']:checked + span {
            color: #0f172a;
        }

        .screening-page .radio-grid input[type='radio'] {
            accent-color: #0ea5e9;
        }

        .screening-page .submit-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0ea5e9, #06b6d4);
            color: white;
            border: none;
            border-radius: 16px;
            padding: 1rem 1.75rem;
            font-weight: 900;
            font-size: 0.95rem;
            cursor: pointer;
            box-shadow: 0 18px 40px rgba(14, 165, 233, .22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .screening-page .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 50px rgba(14, 165, 233, .25);
        }

        .screening-page .question-header {
            font-size: 0.85rem;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        @media (max-width: 900px) {
            .screening-page {
                padding: 16px;
            }

            .screening-page .hero-card h1 {
                font-size: 28px;
            }

            .screening-page .form-input-custom {
                font-size: 0.9rem;
            }

            .screening-page .radio-grid {
                gap: 0.5rem;
            }
        }
    </style>

    <div class="screening-page">
        <div class="max-w-6xl mx-auto">
            <div class="hero-card">
                <h1>Cek Kesehatan Mental</h1>
                <p>
                    Lengkapi formulir screening berikut dengan jujur. Hasil umum akan tersimpan, dan
                    untuk melihat hasil yang lebih rinci Anda perlu masuk atau membuat akun.
                </p>
            </div>

            @if(session('success'))
                <div class="info-card border-emerald-200 bg-emerald-50 text-emerald-900 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="info-card border-rose-200 bg-rose-50 text-rose-900 mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="info-card">
                @guest
                    <strong>Perhatian:</strong>
                    Hasil lengkap hanya tersedia setelah Anda login atau daftar. Anda tetap bisa mengisi screening sekarang,
                    tetapi detail hasil akan dibuka setelah autentikasi.
                    <div class="mt-4">
                        <a href="{{ route('login') }}">Login</a> atau
                        <a href="{{ route('register') }}">Daftar</a>
                    </div>
                @else
                    <strong>Selamat datang, {{ auth()->user()->name }}.</strong>
                    Silakan lengkapi kuesioner berikut. Setelah tersimpan, Anda dapat melihat hasil rinci di halaman
                    <a href="{{ route('pengguna.hasil') }}">Hasil</a>.
                @endguest
            </div>

            <form action="{{ route('screening.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="article-card p-6">
                    <div class="border-b border-slate-200 pb-4 mb-5">
                        <h2 class="text-xl font-bold text-slate-900">I. Profil Informasi Dasar</h2>
                        <p class="text-slate-500 text-sm mt-1">Informasi ini digunakan untuk mendukung analisis screening dan tidak akan dibagikan.</p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="block text-slate-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" required class="form-input-custom" placeholder="Masukkan nama lengkap">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-semibold mb-2">Usia (Tahun)</label>
                            <input type="number" name="usia" min="1" max="120" required class="form-input-custom" placeholder="Contoh: 21">
                        </div>
                        <div>
                            <label class="block text-slate-700 font-semibold mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required class="form-input-custom">
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-slate-700 font-semibold mb-2">Status Orang Tua</label>
                            <input type="text" name="orangtua" required class="form-input-custom" placeholder="Contoh: Lengkap / Cerai / Yatim">
                        </div>
                    </div>
                </div>

                <div class="article-card p-6">
                    <div class="border-b border-slate-200 pb-4 mb-5">
                        <h2 class="text-xl font-bold text-slate-900">II. Kuisioner Aspek Psikologis</h2>
                        <p class="text-slate-500 text-sm mt-1">Pilih nilai dari 1 (Sangat Tidak Setuju) hingga 5 (Sangat Setuju).</p>
                    </div>

                    @foreach($daftarPertanyaan as $kategori => $pertanyaans)
                        <div class="mb-8 last:mb-0">
                            <div class="bg-slate-50 px-4 py-3 rounded-2xl mb-4 border-l-4 border-sky-600">
                                <h3 class="question-header">{{ $kategori }}</h3>
                            </div>

                            <div class="space-y-3">
                                @foreach($pertanyaans as $keyKolom => $teksPertanyaan)
                                    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
                                        <div class="mb-4 text-slate-700 font-medium text-sm sm:text-base">
                                            {{ $teksPertanyaan }}
                                        </div>
                                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-5 radio-grid">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label>
                                                    <input type="radio" name="jawaban[{{ $keyKolom }}]" value="{{ $i }}" required>
                                                    <span>Skala {{ $i }}</span>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-6 text-[12px] text-slate-500 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                        <div class="font-semibold text-slate-700 mb-2">Legenda Skala</div>
                        <div class="grid gap-2 sm:grid-cols-5 text-center">
                            <div><strong>1:</strong> Sangat Tidak Setuju</div>
                            <div><strong>2:</strong> Tidak Setuju</div>
                            <div><strong>3:</strong> Netral</div>
                            <div><strong>4:</strong> Setuju</div>
                            <div><strong>5:</strong> Sangat Setuju</div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="submit-button">
                        Kirim & Proses Hasil Screening
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
