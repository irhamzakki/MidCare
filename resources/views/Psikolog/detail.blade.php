<x-app-layout>
    <style>
        .dashboard-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 24px;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .dashboard-page { padding-left: 296px; padding-top: 36px; padding-bottom: 36px; padding-right: 36px; }
        }

        .dashboard-container { max-width: 1280px; margin: 0 auto; }
        .hero-card { background: linear-gradient(135deg, #0f172a, #1e3a8a, #0891b2); color: white; padding: 36px 40px; border-radius: 24px; margin-bottom: 28px; }
        .hero-card h1 { font-size: 36px; font-weight: 800; margin-bottom: 10px; }
        .hero-card p { color: #dbeafe; max-width: 680px; line-height: 1.6; }
        .content-grid { display: grid; grid-template-columns: 1fr; gap: 24px; }
        .panel { background: white; border-radius: 24px; box-shadow: 0 10px 25px rgba(15,23,42,.06); border: 1px solid #e2e8f0; overflow: hidden; }
        .panel-header { padding: 24px; border-bottom: 1px solid #e2e8f0; }
        .panel-header h3 { font-size: 20px; font-weight: 800; color: #0f172a; }
        .panel-header p { color: #64748b; font-size: 13px; margin-top: 4px; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 640px; }
        th { background: #f8fafc; color: #475569; padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; }
        td { padding: 16px 20px; border-top: 1px solid #e2e8f0; color: #334155; font-size: 14px; }
        .badge { display: inline-flex; align-items: center; padding: 8px 14px; border-radius: 999px; font-weight: 700; font-size: 12px; }
        .badge-info { background: #e0f2fe; color: #0284c7; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-success { background: #dcfce7; color: #166534; }
        .summary-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; margin-top: 20px; }
        .summary-card { background: #ffffff; border-radius: 20px; padding: 22px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(15,23,42,.05); }
        .summary-card h4 { font-size: 16px; font-weight: 800; color: #0f172a; }
        .summary-card p { color: #64748b; margin-top: 8px; font-size: 13px; }
    </style>

    <div class="dashboard-page">
        <div class="dashboard-container">
            <div class="hero-card">
                <h1>Detail Pasien</h1>
                <p>Kelola data pasien, lihat riwayat screening terakhir, dan akses informasi klinis penting untuk setiap pasien.</p>
            </div>

            <div class="content-grid">
                <div class="panel">
                    <div class="panel-header">
                        <h3>Ringkasan Pasien</h3>
                        <p>Daftar pasien dengan jumlah screening dan ringkasan kondisi terbaru.</p>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Usia</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jumlah Screening</th>
                                    <th>Riwayat Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pasiens as $pasien)
                                    @php $latest = $pasien->screenings->first(); @endphp
                                    <tr>
                                        <td>{{ $pasien->nama }}</td>
                                        <td>{{ $pasien->email }}</td>
                                        <td>{{ $pasien->usia ?? '-' }}</td>
                                        <td>{{ $pasien->jenis_kelamin ?? '-' }}</td>
                                        <td>{{ $pasien->screenings_count }}</td>
                                        <td>
                                            @if($latest)
                                                <div class="space-y-1">
                                                    <p class="font-semibold">{{ $latest->created_at->format('d M Y') }}</p>
                                                    <p class="text-slate-600">{{ $latest->kategori_risiko }}, skor {{ $latest->skor_total }}</p>
                                                </div>
                                            @else
                                                <span class="text-slate-500">Belum ada screening</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-10 text-slate-500">Belum ada pasien terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="summary-grid">
                    <div class="summary-card">
                        <h4>Total Pasien</h4>
                        <p>{{ $pasiens->count() }}</p>
                    </div>
                    <div class="summary-card">
                        <h4>Total Screening Tercatat</h4>
                        <p>{{ $pasiens->sum('screenings_count') }}</p>
                    </div>
                    <div class="summary-card">
                        <h4>Pasien dengan Screening Terakhir</h4>
                        <p>{{ $pasiens->filter(fn($item) => $item->screenings_count > 0)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
