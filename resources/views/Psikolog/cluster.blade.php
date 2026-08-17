<x-app-layout>
    <style>
        .dashboard-page { min-height: 100vh; background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff); padding: 24px; font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; box-sizing: border-box; }
        @media (min-width: 1024px) { .dashboard-page { padding-left: 296px; padding-top: 36px; padding-bottom: 36px; padding-right: 36px; } }
        .dashboard-container { max-width: 1280px; margin: 0 auto; }
        .hero-card { background: linear-gradient(135deg, #0f172a, #1e3a8a, #0891b2); color: white; padding: 36px 40px; border-radius: 24px; margin-bottom: 28px; }
        .hero-card h1 { font-size: 36px; font-weight: 800; margin-bottom: 10px; }
        .hero-card p { color: #dbeafe; max-width: 700px; line-height: 1.6; }
        .panel { background: white; border-radius: 24px; box-shadow: 0 10px 25px rgba(15,23,42,.06); border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 24px; }
        .panel-header { padding: 24px; border-bottom: 1px solid #e2e8f0; }
        .panel-header h3 { font-size: 20px; font-weight: 800; color: #0f172a; }
        .panel-header p { color: #64748b; font-size: 13px; margin-top: 4px; }
        .cluster-grid { display: grid; gap: 20px; grid-template-columns: repeat(3, minmax(0, 1fr)); margin-top: 20px; }
        .cluster-card { background: #ffffff; border-radius: 20px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(15,23,42,.05); }
        .cluster-card h4 { font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 12px; }
        .cluster-card p { color: #475569; font-size: 14px; line-height: 1.7; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 700px; }
        th { background: #f8fafc; color: #475569; padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; }
        td { padding: 16px 20px; border-top: 1px solid #e2e8f0; color: #334155; font-size: 14px; }
        .badge { display: inline-flex; align-items: center; padding: 8px 14px; border-radius: 999px; font-weight: 700; font-size: 12px; }
        .badge-stabil { background: #dcfce7; color: #166534; }
        .badge-cukup { background: #fef3c7; color: #92400e; }
        .badge-perhatian { background: #fee2e2; color: #991b1b; }
    </style>

    <div class="dashboard-page">
        <div class="dashboard-container">
            <div class="hero-card">
                <h1>Profil Cluster</h1>
                <p>Analisis klaster berdasarkan data fitur pengguna untuk membantu psikolog memahami pola kelompok dan membuat rekomendasi berbasis bukti.</p>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h3>Ringkasan Klaster</h3>
                    <p>Jumlah rekaman fitur pengguna yang masuk ke setiap profil klaster.</p>
                </div>

                <div class="cluster-grid">
                    <div class="cluster-card">
                        <h4>Profil Stabil</h4>
                        <p>{{ $summary->get('Profil Stabil', 0) }} rekaman</p>
                    </div>
                    <div class="cluster-card">
                        <h4>Profil Cukup Baik</h4>
                        <p>{{ $summary->get('Profil Cukup Baik', 0) }} rekaman</p>
                    </div>
                    <div class="cluster-card">
                        <h4>Profil Butuh Perhatian</h4>
                        <p>{{ $summary->get('Profil Butuh Perhatian', 0) }} rekaman</p>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h3>Top 10 Sample Klaster</h3>
                    <p>Rekaman fitur pengguna dengan skor rata-rata tertinggi dan label klaster yang direkomendasikan.</p>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Usia</th>
                                <th>Jenis Kelamin</th>
                                <th>Rata-rata Skor</th>
                                <th>Klaster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topRecords as $item)
                                <tr>
                                    <td>{{ $item['record']->nama ?? '––' }}</td>
                                    <td>{{ $item['record']->usia ?? '––' }}</td>
                                    <td>{{ $item['record']->jenis_kelamin ?? '––' }}</td>
                                    <td>{{ $item['average'] }}</td>
                                    <td>
                                        <span class="badge badge-{{ Str::slug($item['cluster_label']) }}">{{ $item['cluster_label'] }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-slate-500">Belum ada data klaster yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
