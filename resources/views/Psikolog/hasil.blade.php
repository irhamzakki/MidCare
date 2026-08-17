<x-app-layout>
    <style>
        .dashboard-page { min-height: 100vh; background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff); padding: 24px; font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; box-sizing: border-box; }
        @media (min-width: 1024px) { .dashboard-page { padding-left: 296px; padding-top: 36px; padding-bottom: 36px; padding-right: 36px; } }
        .dashboard-container { max-width: 1280px; margin: 0 auto; }
        .hero-card { background: linear-gradient(135deg, #0f172a, #1e3a8a, #0891b2); color: white; padding: 36px 40px; border-radius: 24px; margin-bottom: 28px; }
        .hero-card h1 { font-size: 36px; font-weight: 800; margin-bottom: 10px; }
        .hero-card p { color: #dbeafe; max-width: 680px; line-height: 1.6; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
        .panel { background: white; border-radius: 24px; box-shadow: 0 10px 25px rgba(15,23,42,.06); border: 1px solid #e2e8f0; overflow: hidden; }
        .panel-header { padding: 24px; border-bottom: 1px solid #e2e8f0; }
        .panel-header h3 { font-size: 20px; font-weight: 800; color: #0f172a; }
        .panel-header p { color: #64748b; font-size: 13px; margin-top: 4px; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 640px; }
        th { background: #f8fafc; color: #475569; padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; }
        td { padding: 16px 20px; border-top: 1px solid #e2e8f0; color: #334155; font-size: 14px; }
        .badge { display: inline-flex; align-items: center; padding: 8px 14px; border-radius: 999px; font-weight: 700; font-size: 12px; }
        .badge-ringan { background: #dbeafe; color: #1e3a8a; }
        .badge-sedang { background: #fde68a; color: #92400e; }
        .badge-berat { background: #fecaca; color: #991b1b; }
        .summary-list { display: grid; gap: 18px; }
        .summary-card { background: #ffffff; border-radius: 20px; padding: 22px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(15,23,42,.05); }
        .summary-card h4 { font-size: 16px; font-weight: 800; color: #0f172a; }
        .summary-card p { color: #64748b; margin-top: 8px; font-size: 13px; }
    </style>

    <div class="dashboard-page">
        <div class="dashboard-container">
            <div class="hero-card">
                <h1>Hasil Pemeriksaan</h1>
                <p>Analisis hasil screening terbaru dan ringkasan temuan klinis untuk membantu Anda memberikan rekomendasi yang lebih akurat.</p>
            </div>

            <div class="content-grid">
                <div class="panel">
                    <div class="panel-header">
                        <h3>Ringkasan Hasil</h3>
                        <p>Distribusi kategori risiko dari data screening yang tercatat.</p>
                    </div>

                    <div class="p-6 grid gap-4 sm:grid-cols-3">
                        <div class="summary-card">
                            <h4>Risiko Ringan</h4>
                            <p>{{ $summary->get('Ringan', 0) }} catatan pemeriksaan</p>
                        </div>
                        <div class="summary-card">
                            <h4>Risiko Sedang</h4>
                            <p>{{ $summary->get('Sedang', 0) }} catatan pemeriksaan</p>
                        </div>
                        <div class="summary-card">
                            <h4>Risiko Berat</h4>
                            <p>{{ $summary->get('Berat', 0) }} catatan pemeriksaan</p>
                        </div>
                    </div>
                </div>

                <div class="summary-list">
                    <div class="summary-card">
                        <h4>Catatan Terbaru</h4>
                        <p>Menampilkan 25 pemeriksaan terbaru beserta skor, kategori, dan ringkasan catatan psikolog.</p>
                    </div>
                </div>
            </div>

            <div class="panel mt-6">
                <div class="panel-header">
                    <h3>Detail Pemeriksaan</h3>
                    <p>Daftar hasil pemeriksaan terbaru dari pasien.</p>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pasien</th>
                                <th>Skor</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Catatan Psikolog</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($screenings as $screening)
                                <tr>
                                    <td>{{ $screening->created_at->format('d M Y') }}</td>
                                    <td>{{ optional($screening->pasien)->nama ?? 'Tidak tersedia' }}</td>
                                    <td>{{ $screening->skor_total }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($screening->kategori_risiko) }}">{{ $screening->kategori_risiko }}</span>
                                    </td>
                                    <td>{{ $screening->status }}</td>
                                    <td>{{ Str::limit($screening->catatan, 100) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 text-slate-500">Belum ada hasil pemeriksaan yang tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
