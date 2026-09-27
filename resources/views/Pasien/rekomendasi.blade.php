<x-app-layout>
    <style>
        .rec-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .rec-page {
                padding-left: 296px;
                padding-right: 36px;
                padding-top: 32px;
                padding-bottom: 40px;
            }
        }

        .rec-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .hero-banner {
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
            padding: 32px;
            border-radius: 24px;
            margin-bottom: 28px;
            box-shadow: 0 12px 30px rgba(14, 165, 233, 0.2);
        }

        .hero-banner h1 {
            font-size: 26px;
            font-weight: 800;
            margin: 0 0 8px 0;
        }

        .hero-banner p {
            color: #e0f2fe;
            margin: 0;
            line-height: 1.6;
            max-width: 700px;
        }

        .rec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .rec-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .rec-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .rec-icon.blue { background: #e0f2fe; color: #0284c7; }
        .rec-icon.green { background: #dcfce7; color: #16a34a; }
        .rec-icon.purple { background: #f3e8ff; color: #9333ea; }
        .rec-icon.amber { background: #fef3c7; color: #d97706; }

        .rec-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 8px 0;
        }

        .rec-card p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .action-banner {
            background: white;
            border-radius: 22px;
            padding: 24px 30px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .action-banner-text h3 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .action-banner-text p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .btn-screening {
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(14, 165, 233, 0.25);
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-screening:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
        }
    </style>

    <div class="rec-page">
        <div class="rec-container">
            
            <div class="hero-banner">
                <h1>Rekomendasi Kesehatan Mental</h1>
                <p>Panduan praktis dan langkah mandiri untuk membantu mengelola stres, regulasi emosi, serta menjaga kesejahteraan mental harian Anda.</p>
            </div>

            <div class="rec-grid">
                <div class="rec-card">
                    <div>
                        <div class="rec-icon blue">🧘‍♂️</div>
                        <h3>Teknik Relaksasi & Pernapasan</h3>
                        <p>Lakukan teknik pernapasan 4-7-8 atau latihan *mindfulness* selama 5-10 menit ketika merasakan lonjakan ketegangan emosi.</p>
                    </div>
                </div>

                <div class="rec-card">
                    <div>
                        <div class="rec-icon green">✍️</div>
                        <h3>Refleksi Emosi (Journaling)</h3>
                        <p>Tuliskan perasaan atau peristiwa yang dialami secara jujur. Mengenali pemicu emosi membantu proses penerimaan diri secara lebih rasional.</p>
                    </div>
                </div>

                <div class="rec-card">
                    <div>
                        <div class="rec-icon purple">🗣️</div>
                        <h3>Bercerita & Dukungan Sosial</h3>
                        <p>Jangan ragu untuk mengutarakan unek-unek kepada orang terpercaya, keluarga, atau rekan terdekat saat menghadapi situasi rumit.</p>
                    </div>
                </div>

                <div class="rec-card">
                    <div>
                        <div class="rec-icon amber">⏰</div>
                        <h3>Manajemen Istirahat & Screen Time</h3>
                        <p>Jaga ritme tidur teratur minimal 7-8 jam per malam dan luangkan jeda berkala dari paparan layar gawai untuk menurunkan kecemasan.</p>
                    </div>
                </div>
            </div>

            <div class="action-banner">
                <div class="action-banner-text">
                    <h3>Ingin Mengetahui Kondisi Mental Terbaru Anda?</h3>
                    <p>Lakukan pemeriksaan kuesioner psikologis berkala untuk memantau perkembangan kesehatan mental Anda.</p>
                </div>
                <a href="{{ route('pasien.tes') }}" class="btn-screening">
                    Mulai Tes Kuesioner →
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
