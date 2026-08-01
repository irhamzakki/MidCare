<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MindCare - Screening Kesehatan Mental</title>
    
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { scroll-behavior: smooth; }
        
        /* PERUBAHAN: Background diubah menjadi gradien warna biru khas MindCare */
        body { 
            background: radial-gradient(circle at top right, #0b2545, #134074, #081c34); 
            min-height: 100vh;
        }
        
        .form-field {
            display: grid;
            gap: 0.75rem;
        }
        .form-field label {
            font-weight: 700;
            color: #0f172a;
        }
        .form-field input,
        .form-field select {
            width: 100%;
            border-radius: 1rem;
            border: 1px solid #cbd5e1;
            padding: 1rem 1.1rem;
            font-size: 0.95rem;
            color: #0f172a;
            outline: none;
        }
        .form-field input:focus,
        .form-field select:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
        }
        .radio-grid input[type='radio'] {
            accent-color: #0ea5e9;
        }
        .radio-step {
            min-width: 110px;
            border-radius: 1rem;
            border: 1px solid transparent;
            padding: 0.85rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .radio-step:hover {
            transform: translateY(-1px);
            border-color: #cbd5e1;
        }
        .radio-step input:checked + span {
            color: #0f172a;
            font-weight: 700;
        }
        .section-card {
            box-shadow: 0 20px 60px rgba(15, 23, 42, .3);
        }
</style>
</head>
<body class="text-slate-900 antialiased pt-20 lg:pt-24">
        <div class="fixed top-0 left-0 right-0 z-50 bg-slate-950/80 backdrop-blur-md border-b border-white/10">
            @include('header')
        </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Perbaikan Gaya Header: Dibuat transparan/glassmorphism modern dengan teks putih kontras -->
        <section class="bg-white/10 backdrop-blur-md rounded-[2rem] border border-white/10 section-card overflow-hidden text-white">
            <div class="grid lg:grid-cols-[1.15fr_0.85fr] gap-8 p-8 lg:p-12">
                <div>
                    <p class="inline-flex px-4 py-2 rounded-full bg-cyan-500/20 text-cyan-300 text-sm font-semibold mb-4">Screening Terbuka</p>
                    <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight mb-5 bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">Cek Kesehatan Mental Anda</h1>
                    <p class="text-slate-300 leading-relaxed text-lg max-w-2xl mb-8">
                        Isi kuesioner singkat ini untuk mendapatkan gambaran awal tentang kondisi mental Anda. Hasil umum dapat disimpan,
                        sementara hasil rinci hanya dapat dilihat setelah Anda login atau mendaftar.
                    </p>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl bg-white/5 p-5 border border-white/10">
                            <h2 class="font-semibold text-cyan-200 mb-2">Akses Tanpa Login</h2>
                            <p class="text-slate-400 text-sm">Siapa saja dapat langsung mengisi screening ini tanpa harus masuk terlebih dahulu.</p>
                        </div>
                        <div class="rounded-3xl bg-white/5 p-5 border border-white/10">
                            <h2 class="font-semibold text-cyan-200 mb-2">Hasil Lebih Spesifik</h2>
                            <p class="text-slate-400 text-sm">Setelah mengirim, login/daftar akan membuka akses ke hasil rinci dalam profil Anda.</p>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan Header: Dibuat menyatu dengan aksen gradien biru-cyan terang -->
                <div class="hidden lg:block relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/20 to-sky-600/30 opacity-40 rounded-[2rem]"></div>
                    <div class="relative bg-white/5 backdrop-blur-sm rounded-[2rem] p-8 border border-white/10 h-full flex flex-col justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.24em] text-cyan-400 font-bold mb-4">MindCare</p>
                            <h2 class="text-3xl font-bold mb-4 text-white">Kenali Risiko Dini</h2>
                            <p class="text-slate-300 mb-6">Kuesioner ini mencakup beberapa aspek emosi, koping, dan hubungan keluarga untuk mendukung analisis awal.</p>
                        </div>
                        <div class="space-y-4">
                            <div class="rounded-3xl bg-slate-900/40 p-4 border border-white/5">
                                <p class="text-sm font-semibold text-cyan-300">Skala Likert 1-5</p>
                                <p class="text-sm text-slate-400">Dari sangat tidak setuju sampai sangat setuju.</p>
                            </div>
                            <div class="rounded-3xl bg-slate-900/40 p-4 border border-white/5">
                                <p class="text-sm font-semibold text-cyan-300">Privasi Terjaga</p>
                                <p class="text-sm text-slate-400">Data Anda tersimpan aman dan hanya digunakan untuk analisis screening.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Informasi Autentikasi -->
        <section class="mt-10">
            <div class="space-y-6">
                @if(session('success'))
                    <div class="rounded-3xl bg-emerald-50 border border-emerald-200 p-5 text-emerald-900">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="rounded-3xl bg-rose-50 border border-rose-200 p-5 text-rose-900">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('screening_result'))
                    @php $hasilScreening = session('screening_result'); @endphp
                    <div class="rounded-[2rem] bg-white p-8 section-card border border-slate-200">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                            <div>
                                <p class="text-sm font-semibold text-sky-600 uppercase tracking-[0.24em] mb-3">Hasil Screening</p>
                                <h2 class="text-3xl font-bold text-slate-900">Profil Anda Berdasarkan Jawaban</h2>
                                <p class="text-slate-600 mt-3">Berikut ringkasan hasil, visualisasi jawaban, dan profil singkat dari pertanyaan yang sudah Anda isi.</p>
                            </div>
                            <div class="rounded-3xl bg-sky-50 border border-sky-200 px-6 py-4 min-w-[180px] text-center">
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-700">Skor keseluruhan</p>
                                <p class="text-4xl font-black text-slate-900 mt-2">{{ $hasilScreening['profil']['nilai_total'] }}/5</p>
                            </div>
                        </div>

                        <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr] mt-8">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                                <h3 class="text-xl font-bold text-slate-900">Profil singkat</h3>
                                <div class="mt-5 space-y-3 text-sm text-slate-700">
                                    <div class="flex items-center justify-between rounded-2xl bg-white px-4 py-3">
                                        <span class="font-semibold text-slate-500">Nama</span>
                                        <span class="font-bold text-slate-900">{{ $hasilScreening['profil']['nama'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between rounded-2xl bg-white px-4 py-3">
                                        <span class="font-semibold text-slate-500">Usia</span>
                                        <span class="font-bold text-slate-900">{{ $hasilScreening['profil']['usia'] }} tahun</span>
                                    </div>
                                    <div class="flex items-center justify-between rounded-2xl bg-white px-4 py-3">
                                        <span class="font-semibold text-slate-500">Jenis Kelamin</span>
                                        <span class="font-bold text-slate-900">{{ $hasilScreening['profil']['jenis_kelamin'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between rounded-2xl bg-white px-4 py-3">
                                        <span class="font-semibold text-slate-500">Orang Tua</span>
                                        <span class="font-bold text-slate-900">{{ $hasilScreening['profil']['orangtua'] }}</span>
                                    </div>
                                    <div class="flex items-center justify-between rounded-2xl bg-white px-4 py-3">
                                        <span class="font-semibold text-slate-500">Pertanyaan terjawab</span>
                                        <span class="font-bold text-slate-900">{{ $hasilScreening['profil']['jumlah_terjawab'] }}</span>
                                    </div>
                                </div>
                                <div class="mt-6 rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                                    <p class="font-semibold">{{ $hasilScreening['profil']['status'] }}</p>
                                    <p class="mt-2">{{ $hasilScreening['profil']['rekomendasi'] }}</p>
                                </div>
                            </div>

                            <div class="rounded-3xl border border-slate-200 bg-white p-6">
                                <h3 class="text-xl font-bold text-slate-900">Ringkasan per kategori</h3>
                                <div class="mt-5 space-y-4">
                                    @foreach($hasilScreening['ringkasan_kategori'] as $ringkasan)
                                        <div>
                                            <div class="flex items-center justify-between text-sm mb-2">
                                                <span class="font-semibold text-slate-700">{{ $ringkasan['kategori'] }}</span>
                                                <span class="text-slate-500">{{ $ringkasan['rata'] }}/5 · {{ $ringkasan['label'] }}</span>
                                            </div>
                                            <div class="h-2.5 rounded-full bg-slate-200">
                                                <div class="h-2.5 rounded-full bg-sky-600" style="width: {{ $ringkasan['persen'] }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-slate-900">Visualisasi jawaban tiap pertanyaan</h3>
                            <div class="mt-5 space-y-4">
                                @foreach($hasilScreening['detail_jawaban'] as $kategori => $pertanyaans)
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                        <h4 class="text-lg font-semibold text-slate-900">{{ $kategori }}</h4>
                                        <div class="mt-4 space-y-4">
                                            @foreach($pertanyaans as $item)
                                                <div>
                                                    <div class="flex items-start justify-between gap-3 text-sm text-slate-700">
                                                        <span class="leading-relaxed">{{ $item['teks'] }}</span>
                                                        <span class="font-semibold text-slate-900 whitespace-nowrap">{{ $item['nilai'] }}/5</span>
                                                    </div>
                                                    <div class="h-2.5 rounded-full bg-slate-200 mt-2">
                                                        <div class="h-2.5 rounded-full bg-cyan-500" style="width: {{ $item['persen'] }}%"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="rounded-[2rem] bg-white/5 backdrop-blur-md text-white p-8 border border-white/10 shadow-xl">
                    @guest
                        <h2 class="text-2xl font-bold mb-3">Tanpa login dulu, langsung isi screening</h2>
                        <p class="text-slate-300 leading-relaxed">Semua orang bisa mengisi kuesioner ini. Jika Anda ingin melihat hasil yang lebih spesifik dan riwayat screening, silakan login atau daftar setelah mengisi.</p>
                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-slate-900 shadow hover:bg-slate-100 transition">Login</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-sky-400 transition">Daftar</a>
                        </div>
                    @else
                        <h2 class="text-2xl font-bold mb-3">Halo, {{ auth()->user()->name }}!</h2>
                        <p class="text-slate-300 leading-relaxed">Isi kuesioner di bawah ini. Setelah tersimpan, hasil rinci dapat Anda lihat di halaman <a href="{{ route('pengguna.hasil') }}" class="underline text-cyan-300 font-semibold">Hasil</a>.</p>
                    @endguest
                </div>
            </div>

            <!-- Form Utama (Isian & style form tetap utuh sesuai kode asli) -->
            <form action="{{ route('screening.store') }}" method="POST" class="space-y-8 mt-10">
                @csrf

                <div class="rounded-[2rem] bg-white p-8 section-card">
                    <div class="mb-8">
                        <p class="text-sm font-semibold text-sky-600 uppercase tracking-[0.24em] mb-3">Bagian I</p>
                        <h2 class="text-3xl font-bold">Profil Informasi Dasar</h2>
                        <p class="text-slate-600 mt-3">Biarkan kami mengenal Anda sedikit lebih baik untuk analisis screening yang lebih akurat.</p>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="form-field">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-field">
                            <label for="usia">Usia (Tahun)</label>
                            <input type="number" id="usia" name="usia" min="7" max="120" required placeholder="Contoh: 21">
                        </div>
                        <div class="form-field">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="orangtua">Status Orang Tua</label>
                            <input type="text" id="orangtua" name="orangtua" required placeholder="Contoh: Lengkap / Cerai / Yatim">
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-white p-8 section-card">
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-sky-600 uppercase tracking-[0.24em] mb-3">Bagian II</p>
                        <h2 class="text-3xl font-bold">Kuisioner Aspek Psikologis</h2>
                        <p class="text-slate-600 mt-3">Jawab setiap pernyataan dengan jujur menggunakan skala 1 sampai 5.</p>
                    </div>

                    @foreach($daftarPertanyaan as $kategori => $pertanyaans)
                        <div class="mb-10">
                            <div class="rounded-3xl bg-slate-50 p-5 mb-5 border border-slate-200">
                                <h3 class="text-slate-900 font-semibold">{{ $kategori }}</h3>
                            </div>

                            <div class="space-y-5">
                                @foreach($pertanyaans as $keyKolom => $teksPertanyaan)
                                    <div class="rounded-[1.5rem] border border-slate-200 p-5 shadow-sm">
                                        <div class="text-slate-700 font-medium mb-4">{{ $teksPertanyaan }}</div>
                                        <div class="grid gap-3 sm:grid-cols-5">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label class="radio-step">
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

                    <div class="rounded-3xl bg-slate-50 border border-slate-200 p-6 text-sm text-slate-600">
                        <div class="font-semibold text-slate-900 mb-2">Legenda:</div>
                        <div class="grid gap-2 sm:grid-cols-5 text-center">
                            <div><strong>1</strong> Sangat Tidak Setuju</div>
                            <div><strong>2</strong> Tidak Setuju</div>
                            <div><strong>3</strong> Netral</div>
                            <div><strong>4</strong> Setuju</div>
                            <div><strong>5</strong> Sangat Setuju</div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-sky-600 px-8 py-4 text-base font-bold text-white shadow-lg shadow-sky-500/20 hover:bg-sky-500 transition">Kirim & Proses Hasil Screening</button>
                </div>
            </form>
        </section>
    </main>

    @include('footer')
</body>
</html>