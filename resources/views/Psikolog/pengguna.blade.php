<x-app-layout>
    <style>
        /* WRAPPER UTAMA & ADJUSTMENT SIDEBAR */
        .dashboard-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 24px;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            box-sizing: border-box;
        }

        /* Jarak aman agar tidak bertabrakan dengan Sidebar */
        @media (min-width: 1024px) {
            .dashboard-page {
                padding-left: 296px; /* Offset lebar sidebar + spacing */
                padding-top: 36px;
                padding-bottom: 36px;
                padding-right: 36px;
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            .dashboard-page {
                padding-left: 240px;
                padding-top: 24px;
                padding-bottom: 24px;
                padding-right: 24px;
            }
        }

        .dashboard-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        /* HERO CARD */
        .hero-card {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #0891b2);
            color: white;
            padding: 36px 40px;
            border-radius: 24px;
            margin-bottom: 28px;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.18);
        }

        .hero-card h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        .hero-card p {
            color: #dbeafe;
            line-height: 1.6;
            max-width: 680px;
            font-size: 15px;
        }

        .btn-primary-hero {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 22px;
            background: #ffffff;
            color: #1e3a8a;
            padding: 12px 22px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-primary-hero:hover {
            transform: translateY(-2px);
            background: #f8fafc;
        }

        /* STATS GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.04);
            border: 1px solid #e2e8f0;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .cyan { background: #cffafe; color: #0891b2; }
        .blue { background: #dbeafe; color: #1d4ed8; }
        .green { background: #dcfce7; color: #15803d; }
        .purple { background: #ede9fe; color: #6d28d9; }

        .stat-card p {
            color: #64748b;
            font-weight: 600;
            font-size: 13px;
        }

        .stat-card h3 {
            font-size: 32px;
            font-weight: 900;
            color: #0f172a;
            margin-top: 4px;
        }

        /* CONTENT GRID */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            align-items: start;
        }

        .panel {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.04);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .panel-header {
            padding: 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .panel-header h3 {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
        }

        .panel-header p {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        /* TABEL RESPONSIVITAS */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th {
            background: #f8fafc;
            color: #475569;
            padding: 14px 20px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
            color: #334155;
            font-size: 14px;
        }

        /* PANEL REKOMENDASI */
        .recommendation {
            background: #0f172a;
            color: #ffffff;
            padding: 28px;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.15);
        }

        .recommendation h3 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .recommendation p {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.5;
        }

        .rec-item {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 16px;
            margin-top: 16px;
        }

        .rec-item h4 {
            color: #38bdf8;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .rec-item p {
            color: #cbd5e1;
            font-size: 12px;
        }

        /* BREAKPOINTS */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .hero-card h1 {
                font-size: 28px;
            }
        }
    </style>

    <div class="dashboard-page">
        <div class="dashboard-container">

            {{-- NOTIFIKASI SUKSES --}}
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- NOTIFIKASI ERROR --}}
            @if($errors->any())
                <div class="mb-6 rounded-2xl bg-rose-50 border border-rose-200 p-4 text-rose-800 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- HERO BANNER --}}
            <div class="hero-card">
                <h1>Selamat Datang, Psikolog!</h1>
                <p>Pantau riwayat kesehatan mental pasien, berikan evaluasi mendalam, dan kelola catatan pemeriksaan psikologi dengan mudah.</p>
                <a href="#riwayat-tabel" class="btn-primary-hero">
                    Lihat Hasil
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                </a>
            </div>

            {{-- 4 STAT CARDS --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon cyan">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p>Total Pasien Terdaftar</p>
                    <h3>{{ count($pasiens) }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <p>Pemeriksaan Bulan Ini</p>
                    <h3>0</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <p>Risiko Tinggi</p>
                    <h3>0</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <p>Perlu Tindakan</p>
                    <h3>0</h3>
                </div>
            </div>

            {{-- MAIN CONTENT GRID (LEFT: TABLE & FORM, RIGHT: RECOMMENDATION) --}}
            <div class="content-grid">
                
                {{-- KOLOM KIRI --}}
                <div>
                    {{-- TABEL PASIEN --}}
                    <div class="panel" id="riwayat-tabel">
                        <div class="panel-header">
                            <h3>Riwayat Pemeriksaan Pasien</h3>
                            <p>Lihat data pasien terdaftar dan buat catatan pemeriksaan mendalam untuk setiap pasien.</p>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Pasien</th>
                                        <th>Email</th>
                                        <th>Usia</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Riwayat Screening Terakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pasiens as $pasien)
                                        @php $latest = $pasien->screenings->first(); @endphp
                                        <tr>
                                            <td class="font-bold text-slate-900">{{ $pasien->nama }}</td>
                                            <td>{{ $pasien->email }}</td>
                                            <td>{{ $pasien->usia ?? '-' }}</td>
                                            <td>{{ $pasien->jenis_kelamin ?? '-' }}</td>
                                            <td>
                                                @if($latest)
                                                    <div class="space-y-1 text-xs">
                                                        <p class="font-bold text-slate-800">{{ $latest->created_at->format('d M Y') }}</p>
                                                        <p>Skor: <span class="font-semibold text-sky-600">{{ $latest->skor_total }}</span></p>
                                                        <p>Kategori: <span class="font-semibold text-amber-600">{{ $latest->kategori_risiko }}</span></p>
                                                        <p class="text-slate-500">Status: {{ $latest->status }}</p>
                                                    </div>
                                                @else
                                                    <span class="text-slate-400 italic text-xs">Belum ada catatan screening</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-8 text-center text-slate-500">Belum ada pasien terdaftar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- FORM CATATAN PSIKOLOG --}}
                    <div class="panel">
                        <div class="panel-header">
                            <h3>Catatan Pemeriksaan Psikolog</h3>
                            <p>Tambahkan catatan khusus untuk pasien dan simpan hasil screening mendalam.</p>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('psikolog.pengguna.store') }}" method="POST" class="space-y-6">
                                @csrf

                                <div>
                                    <label for="pasien_id" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Pasien</label>
                                    <select id="pasien_id" name="pasien_id" required class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                                        <option value="">-- Pilih pasien --</option>
                                        @foreach($pasiens as $pasien)
                                            <option value="{{ $pasien->id }}" {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>
                                                {{ $pasien->nama }} ({{ $pasien->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="grid gap-6 sm:grid-cols-3">
                                    <div>
                                        <label for="skor_total" class="block text-sm font-semibold text-slate-700 mb-2">Skor Total</label>
                                        <input id="skor_total" name="skor_total" type="number" min="0" value="{{ old('skor_total') }}" class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="Misal 72">
                                    </div>

                                    <div>
                                        <label for="kategori_risiko" class="block text-sm font-semibold text-slate-700 mb-2">Kategori Risiko</label>
                                        <select id="kategori_risiko" name="kategori_risiko" class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                                            <option value="Ringan" {{ old('kategori_risiko') == 'Ringan' ? 'selected' : '' }}>Ringan</option>
                                            <option value="Sedang" {{ old('kategori_risiko') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                            <option value="Berat" {{ old('kategori_risiko') == 'Berat' ? 'selected' : '' }}>Berat</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                                        <input id="status" name="status" type="text" value="{{ old('status', 'Selesai') }}" class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="Misal Selesai">
                                    </div>
                                </div>

                                <div>
                                    <label for="catatan" class="block text-sm font-semibold text-slate-700 mb-2">Catatan Khusus Psikolog</label>
                                    <textarea id="catatan" name="catatan" rows="5" required class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-sky-500 focus:ring-sky-500" placeholder="Tuliskan observasi, rekomendasi, dan keterangan mendalam untuk pemeriksaan ini.">{{ old('catatan') }}</textarea>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-sky-600 px-6 py-3 text-sm font-bold text-white shadow-md transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                        Simpan Catatan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: PANEL REKOMENDASI --}}
                <div>
                    <div class="recommendation">
                        <h3>Rekomendasi Tindakan Psikolog</h3>
                        <p>Panduan cepat untuk mengambil tindakan berdasarkan kategori evaluasi pasien.</p>

                        <div class="rec-item">
                            <h4>Evaluasi Rutin</h4>
                            <p>Pasien dengan tingkat risiko sedang perlu ditinjau ulang secara berkala dalam kurun waktu 2 minggu.</p>
                        </div>

                        <div class="rec-item">
                            <h4>Tindak Lanjut Segera</h4>
                            <p>Berikan catatan mendalam dan jadwalkan sesi tatap muka bagi pasien dengan kategori risiko tinggi.</p>
                        </div>

                        <div class="rec-item">
                            <h4>Arsip Catatan</h4>
                            <p>Pastikan setiap hasil observasi disimpan ke dalam sistem untuk rekam medis berkelanjutan.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>