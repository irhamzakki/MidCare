<x-app-layout>
    <style>
        .rec-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #eef2ff 100%);
            padding: 24px;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .rec-page {
                padding-left: 296px;
                padding-right: 36px;
                padding-top: 36px;
                padding-bottom: 40px;
            }
        }

        .rec-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0891b2 100%);
            color: white;
            padding: 36px 40px;
            border-radius: 24px;
            margin-bottom: 28px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.15);
        }

        .hero-banner h1 {
            font-size: 32px;
            font-weight: 800;
            margin: 0 0 10px 0;
            letter-spacing: -0.02em;
        }

        .hero-banner p {
            color: #dbeafe;
            margin: 0;
            line-height: 1.6;
            max-width: 750px;
            font-size: 15px;
        }

        .rec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 24px;
            margin-bottom: 28px;
        }

        .rec-card {
            background: white;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .rec-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px rgba(15, 23, 42, 0.08);
        }

        .cluster-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .tag-stabil { background: #dcfce7; color: #15803d; }
        .tag-cukup { background: #fef3c7; color: #b45309; }
        .tag-tinggi { background: #fee2e2; color: #b91c1c; }

        .rec-card h3 {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 12px 0;
        }

        .rec-card p {
            color: #475569;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .action-list {
            list-style: none;
            padding: 0;
            margin: 0 0 24px 0;
        }

        .action-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            color: #334155;
            margin-bottom: 10px;
            line-height: 1.5;
        }

        .action-list li svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .panel {
            background: white;
            border-radius: 24px;
            padding: 32px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
        }

        .panel-header {
            margin-bottom: 20px;
        }

        .panel-header h2 {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 6px 0;
        }

        .panel-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }
    </style>

    <div class="rec-page">
        <div class="rec-container">
            <!-- Hero Header -->
            <div class="hero-banner">
                <h1>Panduan & Rekomendasi Intervensi Psikologis</h1>
                <p>
                    Pedoman klinis dan rekomendasi tindak lanjut berdasarkan hasil clustering Machine Learning untuk memfasilitasi penanganan pasien secara terarah dan terukur.
                </p>
            </div>

            <!-- Intervensi Berdasarkan Cluster -->
            <div class="rec-grid">
                <!-- Cluster 0: Risiko Rendah / Stabil -->
                <div class="rec-card">
                    <div>
                        <span class="cluster-tag tag-stabil">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Cluster Stabil (Risiko Rendah)
                        </span>
                        <h3>Intervensi Preventif & Pemeliharaan</h3>
                        <p>Pasien pada cluster ini memiliki regulasi emosi dan relasi pengasuhan yang adaptif. Fokus utama adalah penguatan resiliensi.</p>

                        <ul class="action-list">
                            <li>
                                <svg class="text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Apresiasi kebiasaan coping positif yang sudah berjalan baik.</span>
                            </li>
                            <li>
                                <svg class="text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Dorong konsistensi mindfulness dan gaya hidup seimbang.</span>
                            </li>
                            <li>
                                <svg class="text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Jadwalkan evaluasi berkala secara santai (tiap 3-6 bulan).</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('psikolog.pengguna') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl font-bold text-sm bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                        Lihat Pasien Terkait
                    </a>
                </div>

                <!-- Cluster 1: Risiko Sedang / Cukup Baik -->
                <div class="rec-card">
                    <div>
                        <span class="cluster-tag tag-cukup">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Cluster Cukup Baik (Risiko Sedang)
                        </span>
                        <h3>Intervensi Terfokus & Psikoedukasi</h3>
                        <p>Pasien menunjukkan beberapa titik rentan pada pengelolaan stres atau komunikasi interpersonal yang memerlukan pendampingan.</p>

                        <ul class="action-list">
                            <li>
                                <svg class="text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Identifikasi pemicu spesifik (stressor akademik/keluarga).</span>
                            </li>
                            <li>
                                <svg class="text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Berikan latihan restrukturisasi kognitif dan regulasi napas.</span>
                            </li>
                            <li>
                                <svg class="text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Rencanakan sesi konseling lanjutan dalam 2-4 minggu ke depan.</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('psikolog.pengguna') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl font-bold text-sm bg-amber-50 text-amber-800 hover:bg-amber-100 transition-colors">
                        Lihat Pasien Terkait
                    </a>
                </div>

                <!-- Cluster 2: Butuh Perhatian / Risiko Tinggi -->
                <div class="rec-card">
                    <div>
                        <span class="cluster-tag tag-tinggi">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Cluster Butuh Perhatian (Risiko Tinggi)
                        </span>
                        <h3>Intervensi Intensif & Konseling Mendalam</h3>
                        <p>Pasien mengalami tekanan psikologis yang signifikan atau disfungsi regulasi emosi. Diperlukan tindakan aktif segera.</p>

                        <ul class="action-list">
                            <li>
                                <svg class="text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Lakukan asesmen klinis komprehensif 1-on-1 segera.</span>
                            </li>
                            <li>
                                <svg class="text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Rancang safety plan dan intervensi CBT/terapi suportif.</span>
                            </li>
                            <li>
                                <svg class="text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Libatkan support system terpercaya atau rujukan spesialis jika perlu.</span>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('psikolog.pengguna') }}" class="inline-flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl font-bold text-sm bg-red-50 text-red-700 hover:bg-red-100 transition-colors">
                        Lihat Pasien Prioritas
                    </a>
                </div>
            </div>

            <!-- Catatan Protokol Tambahan -->
            <div class="panel">
                <div class="panel-header">
                    <h2>Standar Operasional Pendampingan Pasien</h2>
                    <p>Prinsip etika dan kerahasiaan yang wajib diterapkan oleh setiap psikolog penanggung jawab.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-slate-600 leading-relaxed">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <h4 class="font-bold text-slate-900 mb-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                            Kerahasiaan Data & Kode Etik
                        </h4>
                        <p>Seluruh rekaman kuesioner dan catatan psikolog bersifat rahasia dan hanya dapat diakses oleh profesional yang berwenang.</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                        <h4 class="font-bold text-slate-900 mb-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            Kolaborasi & Catatan Perkembangan
                        </h4>
                        <p>Pastikan setiap sesi konsultasi dicatatkan pada menu <em>Catatan Pasien</em> untuk memonitor progres perubahan skor screening pasien.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
