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
        /* =========================================================
TABEL PSIKOLOG
========================================================= */

.psychologist-table-wrapper {
width: 100%;
overflow-x: auto;
border: 1px solid #e2e8f0;
border-radius: 16px;
background: #ffffff;
box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
}

/* Scrollbar khusus tabel */
.psychologist-table-wrapper::-webkit-scrollbar {
height: 6px;
}

.psychologist-table-wrapper::-webkit-scrollbar-track {
background: #f1f5f9;
border-radius: 10px;
}

.psychologist-table-wrapper::-webkit-scrollbar-thumb {
background: #bae6fd;
border-radius: 10px;
}

/* =========================================================
TABLE
========================================================= */

.psychologist-table {
width: 100%;
min-width: 720px;
border-collapse: separate;
border-spacing: 0;
font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
}

/* =========================================================
TABLE HEADER
========================================================= */

.psychologist-table thead th {
background: #f8fafc;
color: #475569;
font-size: 12px;
font-weight: 750;
letter-spacing: 0.02em;
text-align: left;
padding: 15px 18px;
border-bottom: 1px solid #e2e8f0;
white-space: nowrap;
}

/* Header pertama */
.psychologist-table thead th:first-child {
border-top-left-radius: 15px;
}

/* Header terakhir */
.psychologist-table thead th:last-child {
border-top-right-radius: 15px;
}

/* =========================================================
TABLE BODY
========================================================= */

.psychologist-table tbody td {
padding: 17px 18px;
color: #475569;
font-size: 13px;
line-height: 1.5;
vertical-align: middle;
border-bottom: 1px solid #f1f5f9;
}

/* Baris terakhir */
.psychologist-table tbody tr:last-child td {
border-bottom: none;
}

/* =========================================================
HOVER ROW
========================================================= */

.psychologist-table tbody tr {
background: #ffffff;
transition:
background-color 0.2s ease,
transform 0.2s ease;
}

.psychologist-table tbody tr:hover {
background: #f8fcff;
}

/* =========================================================
PROFILE PSIKOLOG
========================================================= */

.psychologist-profile {
display: flex;
align-items: center;
gap: 12px;
min-width: 190px;
}

/* Avatar */
.psychologist-avatar {
width: 44px;
height: 44px;
min-width: 44px;
border-radius: 13px;

display: flex;
align-items: center;
justify-content: center;

background: linear-gradient(
    135deg,
    #0284c7,
    #0ea5e9
);

color: #ffffff;
font-size: 13px;
font-weight: 800;

box-shadow:
    0 5px 12px rgba(14, 165, 233, 0.20);

}

/* Nama */
.psychologist-name {
color: #0f172a;
font-size: 14px;
font-weight: 750;
line-height: 1.4;
}

/* Role */
.psychologist-role {
margin-top: 2px;
color: #94a3b8;
font-size: 11px;
line-height: 1.4;
}

/* =========================================================
JADWAL
========================================================= */

.psychologist-table td small {
display: inline-block;
margin-top: 2px;
color: #94a3b8;
font-size: 11px;
}

/* =========================================================
STATUS TERSEDIA
========================================================= */

.status-available {
display: inline-flex;
align-items: center;
gap: 7px;

padding: 6px 10px;

border-radius: 999px;

background: #ecfdf5;
border: 1px solid #bbf7d0;

color: #15803d;

font-size: 11px;
font-weight: 750;

white-space: nowrap;

}

/* Titik status */
.status-dot {
width: 7px;
height: 7px;
border-radius: 50%;
background: #22c55e;

box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.10);

}

/* =========================================================
BUTTON HUBUNGI
========================================================= */

.btn-contact {
display: inline-flex;
align-items: center;
justify-content: center;
gap: 7px;
padding: 9px 14px;
border-radius: 10px;
background: linear-gradient(
    135deg,
    #0284c7,
    #0ea5e9
);

color: #ffffff;

font-size: 12px;
font-weight: 750;

text-decoration: none;
white-space: nowrap;

box-shadow:
    0 4px 12px rgba(14, 165, 233, 0.18);

transition:
    transform 0.2s ease,
    box-shadow 0.2s ease,
    filter 0.2s ease;
}

.psychologist-table-wrapper {
width: 100%;
overflow-x: auto;
border: 1px solid #e2e8f0;
border-radius: 16px;
background: #ffffff;
box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
}

/* Scrollbar khusus tabel */
.psychologist-table-wrapper::-webkit-scrollbar {
height: 6px;
}

.psychologist-table-wrapper::-webkit-scrollbar-track {
background: #f1f5f9;
border-radius: 10px;
}

.psychologist-table-wrapper::-webkit-scrollbar-thumb {
background: #bae6fd;
border-radius: 10px;
}

/* =========================================================
TABLE
========================================================= */

.psychologist-table {
width: 100%;
min-width: 720px;
border-collapse: separate;
border-spacing: 0;
font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
}

/* =========================================================
TABLE HEADER
========================================================= */

.psychologist-table thead th {
background: #f8fafc;
color: #475569;
font-size: 12px;
font-weight: 750;
letter-spacing: 0.02em;
text-align: left;
padding: 15px 18px;
border-bottom: 1px solid #e2e8f0;
white-space: nowrap;
}

/* Header pertama */
.psychologist-table thead th {
border-top-left-radius: 15px;
}

/* Header terakhir */
.psychologist-table thead th {
border-top-right-radius: 15px;
}

/* =========================================================
TABLE BODY
========================================================= */

.psychologist-table tbody td {
padding: 17px 18px;
color: #475569;
font-size: 13px;
line-height: 1.5;
vertical-align: middle;
border-bottom: 1px solid #f1f5f9;
}

/* Baris terakhir */
.psychologist-table tbody tr td {
border-bottom: none;
}

/* =========================================================
HOVER ROW
========================================================= */

.psychologist-table tbody tr {
background: #ffffff;
transition:
background-color 0.2s ease,
transform 0.2s ease;
}

.psychologist-table tbody tr {
background: #f8fcff;
}

/* =========================================================
PROFILE PSIKOLOG
========================================================= */

.psychologist-profile {
display: flex;
align-items: center;
gap: 12px;
min-width: 190px;
}

/* Avatar */
.psychologist-avatar {
width: 44px;
height: 44px;
min-width: 44px;
border-radius: 13px;

display: flex;
align-items: center;
justify-content: center;

background: linear-gradient(
    135deg,
    #0284c7,
    #0ea5e9
);

color: #ffffff;
font-size: 13px;
font-weight: 800;

box-shadow:
    0 5px 12px rgba(14, 165, 233, 0.20);

}

/* Nama */
.psychologist-name {
color: #0f172a;
font-size: 14px;
font-weight: 750;
line-height: 1.4;
}

/* Role */
.psychologist-role {
margin-top: 2px;
color: #94a3b8;
font-size: 11px;
line-height: 1.4;
}

/* =========================================================
JADWAL
========================================================= */

.psychologist-table td small {
display: inline-block;
margin-top: 2px;
color: #94a3b8;
font-size: 11px;
}

/* =========================================================
STATUS TERSEDIA
========================================================= */

.status-available {
display: inline-flex;
align-items: center;
gap: 7px;

padding: 6px 10px;

border-radius: 999px;

background: #ecfdf5;
border: 1px solid #bbf7d0;

color: #15803d;

font-size: 11px;
font-weight: 750;

white-space: nowrap;

}

/* Titik status */
.status-dot {
width: 7px;
height: 7px;
border-radius: 50%;
background: #22c55e;

box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.10);

}

/* =========================================================
BUTTON HUBUNGI
========================================================= */

.btn-contact {
display: inline-flex;
align-items: center;
justify-content: center;
gap: 7px;

padding: 9px 14px;

border-radius: 10px;

background: linear-gradient(
    135deg,
    #0284c7,
    #0ea5e9
);

color: #ffffff;

font-size: 12px;
font-weight: 750;

text-decoration: none;
white-space: nowrap;

box-shadow:
    0 4px 12px rgba(14, 165, 233, 0.18);

transition:
    transform 0.2s ease,
    box-shadow 0.2s ease,
    filter 0.2s ease;

}

/* Hover */
.btn-contact {
transform: translateY(-2px);

box-shadow:
    0 7px 17px rgba(14, 165, 233, 0.28);

filter: brightness(1.03);

}

/* Active */
.btn-contact {
transform: translateY(0);
}

/* =========================================================
RESPONSIVE
========================================================= */

@media (max-width: 700px) {

.psychologist-table-wrapper {
    border-radius: 14px;
}

.psychologist-table {
    min-width: 680px;
}

.psychologist-table thead th {
    padding: 13px 14px;
    font-size: 11px;
}

.psychologist-table tbody td {
    padding: 14px;
    font-size: 12px;
}

.psychologist-avatar {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 11px;
    font-size: 12px;
}

.psychologist-name {
    font-size: 13px;
}

.psychologist-role {
    font-size: 10px;
}

.btn-contact {
    padding: 8px 12px;
    font-size: 11px;
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

        <div class="psychologist-table-wrapper">

                <table class="psychologist-table">

                    <thead>
                        <tr>
                            <th>Psikolog</th>
                            <th>Spesialisasi</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- PSIKOLOG 1 --}}
                        <tr>

                            <td>
                                <div class="psychologist-profile">

                                    <div class="psychologist-avatar">
                                        P1
                                    </div>

                                    <div>
                                        <div class="psychologist-name">
                                            Psikolog 1
                                        </div>

                                        <div class="psychologist-role">
                                            Psikolog Profesional
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <td>
                                Konseling Remaja
                            </td>

                            <td>
                                Senin - Jumat
                                <br>
                                <small style="color:#94a3b8;">
                                    09.00 - 15.00
                                </small>
                            </td>

                            <td>
                                <span class="status-available">
                                    <span class="status-dot"></span>
                                    Tersedia
                                </span>
                            </td>

                            <td>
                                <a href="wa.me/6281234567890" class="btn-contact">
                                    Hubungi →
                                </a>
                            </td>

                        </tr>


                        {{-- PSIKOLOG 2 --}}
                        <tr>

                            <td>
                                <div class="psychologist-profile">

                                    <div class="psychologist-avatar">
                                        P2
                                    </div>

                                    <div>
                                        <div class="psychologist-name">
                                            Psikolog 2
                                        </div>

                                        <div class="psychologist-role">
                                            Psikolog Profesional
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <td>
                                Manajemen Stres
                            </td>

                            <td>
                                Senin - Sabtu
                                <br>
                                <small style="color:#94a3b8;">
                                    10.00 - 16.00
                                </small>
                            </td>

                            <td>
                                <span class="status-available">
                                    <span class="status-dot"></span>
                                    Tersedia
                                </span>
                            </td>

                            <td>
                                <a href="wa.me/6285792251325" class="btn-contact">
                                    Hubungi →
                                </a>
                            </td>

                        </tr>

                    </tbody>

                </table>

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