<x-app-layout>
    <style>
        .report-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .report-page {
                padding-left: 296px;
                padding-right: 36px;
                padding-top: 32px;
                padding-bottom: 40px;
            }
        }

        .report-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .header-title-box h1 {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.025em;
        }

        .header-title-box p {
            color: #64748b;
            font-size: 14px;
            margin-top: 4px;
        }

        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
            transition: all 0.2s ease;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(14, 165, 233, 0.35);
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 22px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .icon-blue { background: #e0f2fe; color: #0284c7; }
        .icon-green { background: #dcfce7; color: #16a34a; }
        .icon-purple { background: #f3e8ff; color: #9333ea; }
        .icon-amber { background: #fef3c7; color: #d97706; }

        .stat-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin-top: 2px;
        }

        .cluster-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .cluster-box {
            background: white;
            border-radius: 22px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            position: relative;
            overflow: hidden;
        }

        .cluster-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
        }

        .cluster-box.cluster-0::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .cluster-box.cluster-1::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
        .cluster-box.cluster-2::before { background: linear-gradient(90deg, #ef4444, #f87171); }

        .cluster-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cluster-count {
            font-size: 32px;
            font-weight: 900;
            color: #0f172a;
            margin: 14px 0 6px 0;
        }

        .cluster-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .table-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            background: #f8fafc;
            padding: 14px 20px;
            text-align: left;
            font-weight: 700;
            color: #475569;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        .badge-risk {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .risk-rendah { background: #dcfce7; color: #15803d; }
        .risk-moderat { background: #fef3c7; color: #b45309; }
        .risk-tinggi { background: #fee2e2; color: #b91c1c; }
    </style>

    <div class="report-page">
        <div class="report-container">
            
            <!-- Header -->
            <div class="page-header">
                <div class="header-title-box">
                    <h1>Statistik & Laporan Screening</h1>
                    <p>Ringkasan analitik data pemeriksaan dan hasil model K-Means MindCare</p>
                </div>

                <button type="button" class="btn-export" onclick="window.print()">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak Laporan
                </button>
            </div>

            <!-- Metrik Utama -->
            <div class="stat-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">👥</div>
                    <div>
                        <div class="stat-label">Total Pasien</div>
                        <div class="stat-value">{{ $totalPasien ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-green">📊</div>
                    <div>
                        <div class="stat-label">Total Screening</div>
                        <div class="stat-value">{{ $totalKuesioner ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-purple">🩺</div>
                    <div>
                        <div class="stat-label">Total Psikolog</div>
                        <div class="stat-value">{{ $totalPsikolog ?? 0 }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon icon-amber">📑</div>
                    <div>
                        <div class="stat-label">Konten Edukasi & Artikel</div>
                        <div class="stat-value">{{ ($totalArtikel ?? 0) + ($totalEdukasi ?? 0) }}</div>
                    </div>
                </div>
            </div>

            <!-- Distribusi Cluster K-Means -->
            <div class="cluster-cards">
                <div class="cluster-box cluster-0">
                    <div class="cluster-title">
                        <span>Cluster 0: Kondisi Baik / Risiko Rendah</span>
                        <span class="badge-risk risk-rendah">Baik</span>
                    </div>
                    <div class="cluster-count">{{ $cluster0Count ?? 0 }}</div>
                    <div class="cluster-desc">Responden dengan regulasi emosi stabil dan relasi keluarga yang harmonis.</div>
                </div>

                <div class="cluster-box cluster-1">
                    <div class="cluster-title">
                        <span>Cluster 1: Risiko Moderat</span>
                        <span class="badge-risk risk-moderat">Moderat</span>
                    </div>
                    <div class="cluster-count">{{ $cluster1Count ?? 0 }}</div>
                    <div class="cluster-desc">Responden yang mulai mengalami fluktuasi emosi dan membutuhkan panduan koping mandiri.</div>
                </div>

                <div class="cluster-box cluster-2">
                    <div class="cluster-title">
                        <span>Cluster 2: Risiko Tinggi / Perlu Perhatian</span>
                        <span class="badge-risk risk-tinggi">Perhatian</span>
                    </div>
                    <div class="cluster-count">{{ $cluster2Count ?? 0 }}</div>
                    <div class="cluster-desc">Responden dengan tingkat stres tinggi atau distres keluarga, disarankan konsultasi psikolog.</div>
                </div>
            </div>

            <!-- Tabel Riwayat Pemeriksaan Terkini -->
            <div class="table-card">
                <div class="table-header">
                    <h2>Riwayat Screening Terbaru</h2>
                    <a href="{{ route('admin.kuesioner.index') }}" style="color:#0284c7; font-weight:600; font-size:13px; text-decoration:none;">Lihat Semua →</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Responden</th>
                            <th>Usia</th>
                            <th>Cluster</th>
                            <th>Tingkat Risiko</th>
                            <th>Tanggal Pemeriksaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentScreenings as $index => $item)
                            @php
                                $badgeClass = match($item->cluster) {
                                    0 => 'risk-rendah',
                                    1 => 'risk-moderat',
                                    2 => 'risk-tinggi',
                                    default => 'risk-moderat'
                                };
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $item->fiturPengguna->nama ?? ($item->user->name ?? 'Responden Anonim') }}</strong></td>
                                <td>{{ $item->fiturPengguna->usia ?? '-' }} thn</td>
                                <td><span style="font-weight:700;">Cluster {{ $item->cluster }}</span></td>
                                <td><span class="badge-risk {{ $badgeClass }}">{{ $item->tingkat_risiko }}</span></td>
                                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center; padding:30px; color:#94a3b8;">
                                    Belum ada data pemeriksaan screening.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
