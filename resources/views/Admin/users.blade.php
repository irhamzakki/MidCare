<x-app-layout>

    <style>
        /* =========================================================
           MINDCARE - KELOLA USER
        ========================================================= */

        .user-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at top right, rgba(14, 165, 233, .08), transparent 28%),
                linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .user-page {
                padding-left: 296px;
                padding-right: 36px;
                padding-top: 32px;
                padding-bottom: 40px;
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            .user-page {
                padding-left: 240px;
                padding-right: 24px;
            }
        }

        .user-container {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .title-wrapper {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .title-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
            box-shadow: 0 8px 20px rgba(14, 165, 233, .20);
        }

        .page-title {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -.025em;
            margin: 0;
        }

        .page-subtitle {
            margin-top: 3px;
            color: #64748b;
            font-size: 14px;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .create-button {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            min-height: 45px;
            padding: 0 18px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 7px 15px rgba(14, 165, 233, .20);
            transition: all .2s ease;
        }

        .create-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(14, 165, 233, .27);
        }

        /* =========================================================
           HERO
        ========================================================= */

        .hero-card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(
                135deg,
                #0f172a 0%,
                #164e63 52%,
                #0284c7 100%
            );
            border-radius: 24px;
            padding: 30px 34px;
            color: white;
            margin-bottom: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .14);
        }

        .hero-circle-one {
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
            right: -70px;
            top: -90px;
        }

        .hero-circle-two {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
            right: 130px;
            bottom: -100px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 760px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 11px;
            border-radius: 999px;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.12);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
            margin-bottom: 13px;
        }

        .hero-title {
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.02em;
            margin: 0;
        }

        .hero-description {
            margin-top: 8px;
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
        }

        /* =========================================================
           INFORMATION CARDS
        ========================================================= */

        .role-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .role-card {
            position: relative;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 8px 28px rgba(15, 23, 42, .045);
            transition: all .2s ease;
        }

        .role-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, .07);
        }

        .role-header {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .role-icon {
            width: 45px;
            height: 45px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .patient-icon {
            background: #ecfeff;
            color: #0891b2;
        }

        .psychologist-icon {
            background: #eff6ff;
            color: #2563eb;
        }

        .role-title {
            color: #0f172a;
            font-size: 15px;
            font-weight: 800;
        }

        .role-subtitle {
            margin-top: 3px;
            color: #64748b;
            font-size: 11px;
        }

        .role-description {
            margin-top: 15px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.7;
        }

        .role-badge {
            display: inline-flex;
            margin-top: 14px;
            padding: 5px 9px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 800;
        }

        .patient-badge {
            background: #ecfeff;
            color: #0e7490;
        }

        .psychologist-badge {
            background: #eff6ff;
            color: #1d4ed8;
        }

        /* =========================================================
           MAIN CARD
        ========================================================= */

        .content-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            box-shadow: 0 8px 28px rgba(15, 23, 42, .045);
            overflow: hidden;
        }

        .card-header {
            padding: 22px 24px;
            border-bottom: 1px solid #eef2f7;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f9ff;
            color: #0284c7;
        }

        .card-title {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
        }

        .card-description {
            margin-top: 3px;
            color: #64748b;
            font-size: 12px;
        }

        .card-body {
            padding: 26px;
        }

        /* =========================================================
           NOTICE
        ========================================================= */

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 17px 18px;
            border-radius: 15px;
            background: linear-gradient(135deg, #eff6ff, #f0f9ff);
            border: 1px solid #bae6fd;
        }

        .notice-icon {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #0284c7;
        }

        .notice-title {
            color: #075985;
            font-size: 13px;
            font-weight: 800;
        }

        .notice-text {
            margin-top: 4px;
            color: #0369a1;
            font-size: 12px;
            line-height: 1.7;
        }

        /* =========================================================
           ADMIN NOTICE
        ========================================================= */

        .admin-notice {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 20px;
            padding: 16px 18px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .admin-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-icon {
            width: 37px;
            height: 37px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-title {
            color: #334155;
            font-size: 12px;
            font-weight: 800;
        }

        .admin-text {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 11px;
        }

        .admin-badge {
            padding: 6px 10px;
            border-radius: 999px;
            background: #e2e8f0;
            color: #475569;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 767px) {

            .user-page {
                padding: 16px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .create-button {
                width: 100%;
                justify-content: center;
            }

            .page-title {
                font-size: 23px;
            }

            .title-icon {
                width: 46px;
                height: 46px;
            }

            .hero-card {
                padding: 24px;
                border-radius: 20px;
            }

            .hero-title {
                font-size: 23px;
            }

            .role-grid {
                grid-template-columns: 1fr;
            }

            .card-body {
                padding: 20px;
            }

            .admin-notice {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>


    <div class="user-page">

        <div class="user-container">

            {{-- =====================================================
                 HEADER
            ====================================================== --}}
            <div class="page-header">

                <div class="title-wrapper">

                    <div class="title-icon">

                        <svg width="25" height="25"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8z"/>

                        </svg>

                    </div>

                    <div>

                        <h1 class="page-title">
                            Kelola User
                        </h1>

                        <p class="page-subtitle">
                            Kelola akun pengguna dan akses sistem MindCare
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('Admin.users.create') }}"
                    class="create-button">

                    <svg width="18" height="18"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"/>

                    </svg>

                    Buat Akun Baru

                </a>

            </div>


            {{-- =====================================================
                 HERO
            ====================================================== --}}
            <div class="hero-card">

                <div class="hero-circle-one"></div>
                <div class="hero-circle-two"></div>

                <div class="hero-content">

                    <div class="hero-label">

                        <svg width="14" height="14"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4v16m8-8H4"/>

                        </svg>

                        Administrator

                    </div>

                    <h2 class="hero-title">
                        Manajemen Akun Pengguna
                    </h2>

                    <p class="hero-description">
                        Kelola pembuatan akun pasien dan psikolog dalam satu
                        tempat. Gunakan fitur ini untuk memastikan setiap
                        pengguna mendapatkan akses sesuai dengan perannya
                        dalam sistem MindCare.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                 ROLE CARDS
            ====================================================== --}}
            <div class="role-grid">

                {{-- PASIEN --}}
                <div class="role-card">

                    <div class="role-header">

                        <div class="role-icon patient-icon">

                            <svg width="22" height="22"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 7a3 3 0 11-6 0 3 3 0 016 0zM4 21a8 8 0 0116 0"/>

                            </svg>

                        </div>

                        <div>

                            <div class="role-title">
                                Akun Pasien
                            </div>

                            <div class="role-subtitle">
                                Pengguna layanan MindCare
                            </div>

                        </div>

                    </div>

                    <p class="role-description">
                        Akun pasien digunakan untuk melakukan screening,
                        melihat hasil risiko kesehatan mental, melihat
                        riwayat pemeriksaan, dan menerima rekomendasi.
                    </p>

                    <span class="role-badge patient-badge">
                        ROLE : PASIEN
                    </span>

                </div>


                {{-- PSIKOLOG --}}
                <div class="role-card">

                    <div class="role-header">

                        <div class="role-icon psychologist-icon">

                            <svg width="22" height="22"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8z"/>

                            </svg>

                        </div>

                        <div>

                            <div class="role-title">
                                Akun Psikolog
                            </div>

                            <div class="role-subtitle">
                                Praktisi kesehatan mental
                            </div>

                        </div>

                    </div>

                    <p class="role-description">
                        Akun psikolog digunakan untuk melihat profil cluster,
                        memantau riwayat pemeriksaan pasien, melihat detail
                        hasil, serta memberikan rekomendasi.
                    </p>

                    <span class="role-badge psychologist-badge">
                        ROLE : PSIKOLOG
                    </span>

                </div>

            </div>


            {{-- =====================================================
                 CONTENT CARD
            ====================================================== --}}
            <div class="content-card">

                <div class="card-header">

                    <div class="card-icon">

                        <svg width="20" height="20"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 4v16m8-8H4"/>

                        </svg>

                    </div>

                    <div>

                        <div class="card-title">
                            Pembuatan Akun
                        </div>

                        <div class="card-description">
                            Gunakan tombol "Buat Akun Baru" untuk menambahkan
                            pasien atau psikolog.
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    {{-- INFORMATION --}}

                    <div class="notice">

                        <div class="notice-icon">

                            <svg width="19" height="19"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>

                            </svg>

                        </div>

                        <div>

                            <div class="notice-title">
                                Informasi Pengelolaan User
                            </div>

                            <div class="notice-text">
                                Administrator dapat membuat akun baru untuk
                                pasien maupun psikolog melalui halaman
                                pembuatan akun. Pastikan data yang dimasukkan
                                sudah sesuai agar akun dapat digunakan dengan
                                baik.
                            </div>

                        </div>

                    </div>


                    {{-- ADMIN INFORMATION --}}

                    <div class="admin-notice">

                        <div class="admin-content">

                            <div class="admin-icon">

                                <svg width="18" height="18"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm3-11V7a3 3 0 116 0v1"/>

                                </svg>

                            </div>

                            <div>

                                <div class="admin-title">
                                    Akun Administrator
                                </div>

                                <div class="admin-text">
                                    Pembuatan akun admin dilakukan melalui
                                    seeder atau console Laravel.
                                </div>

                            </div>

                        </div>

                        <span class="admin-badge">
                            ADMIN ONLY
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>