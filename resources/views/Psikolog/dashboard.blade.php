<x-app-layout>
    <style>
        .dashboard-page {
            /* PERBAIKAN UTAMA: Memastikan kontainer mengizinkan scrolling vertikal secara otomatis */
            min-height: 100vh;
            height: auto;
            overflow-y: auto;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 24px;
            font-family: 'Segoe UI', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-sizing: border-box;
        }

        /* Tombol Pemicu Show/Hide Sidebar */
        .sidebar-toggle-btn {
            background: white;
            color: #0f172a;
            border: 1px solid #e2e8f0;
            padding: 10px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
            transition: all 0.2s ease;
        }

        .sidebar-toggle-btn:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        /* KONDISI DEFAULT LAYAR BESAR (Sidebar Tampil) */
        @media (min-width: 1024px) {
            .dashboard-page {
                /* Menggunakan padding-left untuk menghindari bug bentrok margin */
                padding-left: 304px; /* Lebar sidebar 280px + gap 24px */
                padding-top: 40px;
                padding-bottom: 40px;
                padding-right: 40px;
            }
            
            .dashboard-page.sidebar-collapsed {
                padding-left: 40px;
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            .dashboard-page {
                padding-left: 296px; /* Menyesuaikan space tablet */
                padding-top: 32px;
                padding-bottom: 32px;
                padding-right: 32px;
            }
            
            .dashboard-page.sidebar-collapsed {
                padding-left: 32px;
            }
        }

        .dashboard-container {
            max-width: 1200px;
            margin: auto;
        }

        .hero-card {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #0891b2);
            color: white;
            padding: 40px;
            border-radius: 30px;
            margin-bottom: 30px;
            box-shadow: 0 25px 60px rgba(15, 23, 42, .25);
        }

        .hero-card h1 {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .hero-card p {
            color: #dbeafe;
            line-height: 1.7;
            max-width: 700px;
        }

        .btn-primary {
            display: inline-block;
            margin-top: 25px;
            background: white;
            color: #1e3a8a;
            padding: 14px 24px;
            border-radius: 16px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 26px;
            padding: 26px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
            border: 1px solid #e2e8f0;
        }

        .stat-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 18px;
        }

        .cyan { background: #cffafe; }
        .blue { background: #dbeafe; }
        .green { background: #dcfce7; }
        .purple { background: #ede9fe; }

        .stat-card p {
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
        }

        .stat-card h3 {
            font-size: 34px;
            font-weight: 900;
            color: #0f172a;
            margin-top: 8px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 28px;
            align-items: start; /* Mencegah kolom melar tidak rata */
        }

        .panel {
            background: white;
            border-radius: 28px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        /* PERBAIKAN TABEL RESPONSIVITAS: Mencegah overflow horizontal merusak lebar halaman utama */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .panel-header {
            padding: 26px;
            border-bottom: 1px solid #e2e8f0;
        }

        .panel-header h3 {
            font-size: 24px;
            font-weight: 900;
            color: #0f172a;
        }

        .panel-header p {
            color: #64748b;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 500px; /* Lebar minimum tabel agar tidak gepeng di mobile */
        }

        th {
            background: #f8fafc;
            color: #475569;
            padding: 16px 24px;
            text-align: left;
            font-size: 14px;
            font-weight: 700;
        }

        td {
            padding: 18px 24px;
            border-top: 1px solid #e2e8f0;
            color: #334155;
        }

        .badge {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
            display: inline-block;
        }

        .badge-yellow {
            background: #fef3c7;
            color: #b45309;
        }

        .badge-green {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-red {
            background: #fee2e2;
            color: #b91c1c;
        }

        .recommendation {
            background: #0f172a;
            color: white;
            padding: 28px;
            border-radius: 28px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .18);
        }

        .recommendation h3 {
            font-size: 24px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .recommendation p {
            color: #cbd5e1;
            line-height: 1.6;
        }

        .rec-item {
            background: rgba(255,255,255,.09);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 18px;
            padding: 18px;
            margin-top: 16px;
        }

        .rec-item h4 {
            color: #67e8f9;
            font-weight: 800;
            margin-bottom: 6px;
        }

        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .hero-card h1 {
                font-size: 32px;
            }
        }
    </style>

    <div id="dashboardPage" class="dashboard-page">
        <div class="dashboard-container">

            <div class="hero-card">
                <h1>Halo, {{ Auth::user()->name ?? 'Pengguna' }}</h1>
                <p>
                    Selamat datang di Dashboard MindCare. Pantau hasil screening,
                    riwayat pemeriksaan, serta rekomendasi tindak lanjut untuk menjaga
                    kesehatan mental dengan lebih baik.
                </p>

                <a href="{{ route('Admin.CekMel.CekMel') }}" class="btn-primary">
                    Mulai Screening
                </a>
            </div>

            <div class="stats-grid">
                
            </div>

            <div class="content-grid">
                <div class="panel">
                    <div class="panel-header">
                        <h3>Riwayat Screening</h3>
                        <p>Hasil pemeriksaan kesehatan mental terakhir.</p>
                    </div>

                    <!-- Pembungkus Tabel dengan scrolling horizontal independen -->
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Skor</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>06 Juni 2026</td>
                                    <td>72</td>
                                    <td><span class="badge badge-yellow">Sedang</span></td>
                                    <td>Perlu pemantauan</td>
                                </tr>

                                <tr>
                                    <td>30 Mei 2026</td>
                                    <td>58</td>
                                    <td><span class="badge badge-green">Ringan</span></td>
                                    <td>Stabil</td>
                                </tr>

                                <tr>
                                    <td>22 Mei 2026</td>
                                    <td>81</td>
                                    <td><span class="badge badge-red">Tinggi</span></td>
                                    <td>Butuh tindak lanjut</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="recommendation">
                    <h3>Rekomendasi Hari Ini</h3>
                    <p>
                        Beberapa langkah sederhana yang dapat membantu menjaga kondisi mental tetap stabil.
                    </p>

                    <div class="rec-item">
                        <h4>Istirahat Cukup</h4>
                        <p>Atur pola tidur minimal 7–8 jam setiap hari.</p>
                    </div>

                    <div class="rec-item">
                        <h4>Kurangi Tekanan Digital</h4>
                        <p>Batasi media sosial ketika merasa cemas atau lelah.</p>
                    </div>

                    <div class="rec-item">
                        <h4>Bercerita</h4>
                        <p>Hubungi orang terpercaya ketika merasa berat.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleSidebarLayout() {
            const page = document.getElementById('dashboardPage');
            page.classList.toggle('sidebar-collapsed');
            
            const externalSidebar = document.getElementById('sidebar') || document.querySelector('aside') || document.querySelector('.sidebar');
            
            if (externalSidebar) {
                if (externalSidebar.style.display === 'none') {
                    externalSidebar.style.display = 'block';
                } else {
                    externalSidebar.style.display = 'none';
                }
            }
        }
    </script>
</x-app-layout>
