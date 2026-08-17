<x-app-layout>
    <style>
        /* =========================================================
           MINDCARE - KELOLA PSIKOLOG
           Modern Professional Dashboard
        ========================================================= */

        .psychologist-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at top right, rgba(14, 165, 233, .08), transparent 28%),
                linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .psychologist-page {
                padding-left: 296px;
                padding-right: 36px;
                padding-top: 32px;
                padding-bottom: 40px;
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            .psychologist-page {
                padding-left: 240px;
                padding-right: 24px;
            }
        }

        .psychologist-container {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
        }

        /* =========================================================
           TOP HEADER
        ========================================================= */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .page-title-wrapper {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .page-icon {
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
            letter-spacing: -0.025em;
            margin: 0;
        }

        .page-subtitle {
            margin-top: 3px;
            color: #64748b;
            font-size: 14px;
        }

        /* =========================================================
           STATISTIC CARD
        ========================================================= */

        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 18px 20px;
            min-width: 160px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e0f2fe;
            color: #0284c7;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .stat-number {
            margin-top: 2px;
            font-size: 23px;
            font-weight: 800;
            color: #0f172a;
        }

        /* =========================================================
           HERO
        ========================================================= */

        .hero-card {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0f172a 0%, #164e63 52%, #0284c7 100%);
            border-radius: 24px;
            padding: 30px 34px;
            color: white;
            margin-bottom: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .14);
        }

        .hero-decoration {
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            background: rgba(255,255,255,.05);
            right: -70px;
            top: -90px;
        }

        .hero-decoration-two {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
            right: 120px;
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
           ALERT
        ========================================================= */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px 18px;
            border-radius: 15px;
            margin-bottom: 22px;
            font-size: 13px;
            border: 1px solid;
        }

        .alert-success {
            background: #ecfdf5;
            border-color: #a7f3d0;
            color: #065f46;
        }

        .alert-error {
            background: #fff1f2;
            border-color: #fecdd3;
            color: #9f1239;
        }

        .alert-title {
            font-weight: 800;
            margin-bottom: 3px;
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
            margin-bottom: 24px;
        }

        .card-header {
            padding: 21px 24px;
            border-bottom: 1px solid #eef2f7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-heading-icon {
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
            margin: 0;
        }

        .card-description {
            color: #64748b;
            font-size: 12px;
            margin-top: 3px;
        }

        .card-body {
            padding: 26px;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .form-input,
        .form-select {
            width: 100%;
            box-sizing: border-box;
            min-height: 47px;
            border: 1px solid #dbe3ec;
            border-radius: 12px;
            background: #fbfdff;
            color: #0f172a;
            font-size: 13px;
            padding: 11px 14px 11px 42px;
            outline: none;
            transition: all .2s ease;
        }

        .form-select {
            padding-left: 42px;
            cursor: pointer;
        }

        .form-input:hover,
        .form-select:hover {
            border-color: #bae6fd;
            background: white;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #0ea5e9;
            background: white;
            box-shadow: 0 0 0 4px rgba(14,165,233,.10);
        }

        .form-error {
            margin-top: 6px;
            color: #e11d48;
            font-size: 11px;
            font-weight: 600;
        }

        /* =========================================================
           PASSWORD INFO
        ========================================================= */

        .password-info {
            margin-top: 23px;
            padding: 16px 18px;
            border-radius: 14px;
            background: linear-gradient(135deg, #eff6ff, #f0f9ff);
            border: 1px solid #bae6fd;
            display: flex;
            gap: 13px;
            align-items: flex-start;
        }

        .password-icon {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #0284c7;
            box-shadow: 0 3px 8px rgba(14,165,233,.08);
        }

        .password-title {
            color: #075985;
            font-size: 13px;
            font-weight: 800;
        }

        .password-text {
            color: #0369a1;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 2px;
        }

        .password-value {
            font-weight: 800;
            background: rgba(255,255,255,.65);
            padding: 2px 6px;
            border-radius: 5px;
        }

        /* =========================================================
           FORM FOOTER
        ========================================================= */

        .form-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #eef2f7;
            display: flex;
            justify-content: flex-end;
        }

        .submit-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 45px;
            padding: 0 21px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 7px 15px rgba(14,165,233,.20);
            transition: all .2s ease;
        }

        .submit-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(14,165,233,.27);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        /* =========================================================
           TABLE
        ========================================================= */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .psychologist-table {
            width: 100%;
            min-width: 850px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .psychologist-table thead th {
            background: #f8fafc;
            color: #64748b;
            padding: 13px 20px;
            text-align: left;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .07em;
            border-bottom: 1px solid #e2e8f0;
        }

        .psychologist-table tbody td {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .psychologist-table tbody tr {
            transition: background .18s ease;
        }

        .psychologist-table tbody tr:hover {
            background: #f8fbff;
        }

        .psychologist-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .number-cell {
            width: 50px;
            color: #94a3b8 !important;
            font-weight: 700;
        }

        .profile-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e0f2fe, #dbeafe);
            color: #0369a1;
            font-weight: 800;
            font-size: 14px;
        }

        .profile-name {
            color: #0f172a;
            font-size: 13px;
            font-weight: 800;
        }

        .profile-role {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 600;
        }

        .email-cell {
            color: #475569;
        }

        .specialization-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 8px;
            background: #f0f9ff;
            color: #0369a1;
            font-size: 11px;
            font-weight: 700;
        }

        .str-number {
            font-family: 'Consolas', monospace;
            font-size: 12px;
            color: #475569;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #ecfdf5;
            color: #047857;
            font-size: 10px;
            font-weight: 800;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
        }

        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #94a3b8;
        }

        .empty-title {
            margin-top: 15px;
            color: #334155;
            font-size: 14px;
            font-weight: 800;
        }

        .empty-description {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 12px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 767px) {

            .psychologist-page {
                padding: 16px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-title {
                font-size: 23px;
            }

            .page-icon {
                width: 46px;
                height: 46px;
            }

            .stat-card {
                width: 100%;
            }

            .hero-card {
                padding: 24px;
                border-radius: 20px;
            }

            .hero-title {
                font-size: 23px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .card-header {
                align-items: flex-start;
            }

            .card-body {
                padding: 20px;
            }

            .form-footer {
                justify-content: stretch;
            }

            .submit-button {
                width: 100%;
            }
        }
    </style>

    <div class="psychologist-page">
        <div class="psychologist-container">

            {{-- =====================================================
                 PAGE HEADER
            ====================================================== --}}
            <div class="page-header">

                <div class="page-title-wrapper">

                    <div class="page-icon">
                        <svg width="25" height="25" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8zm5 1a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>

                    <div>
                        <h1 class="page-title">Kelola Psikolog</h1>
                        <p class="page-subtitle">
                            Manajemen akun psikolog pada sistem MindCare
                        </p>
                    </div>

                </div>

                <div class="stat-card">

                    <div class="stat-icon">
                        <svg width="21" height="21" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8z"/>
                        </svg>
                    </div>

                    <div>
                        <div class="stat-label">Total Psikolog</div>
                        <div class="stat-number">
                            {{ $psikologs->count() }}
                        </div>
                    </div>

                </div>

            </div>


            {{-- =====================================================
                 HERO
            ====================================================== --}}
            <div class="hero-card">

                <div class="hero-decoration"></div>
                <div class="hero-decoration-two"></div>

                <div class="hero-content">

                    <div class="hero-label">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v18m9-9H3"/>
                        </svg>
                        Administrator
                    </div>

                    <h2 class="hero-title">
                        Tambahkan Psikolog Baru
                    </h2>

                    <p class="hero-description">
                        Daftarkan praktisi psikologi baru agar dapat mengakses
                        sistem MindCare dan membantu proses pemantauan kesehatan mental pengguna.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                 SUCCESS MESSAGE
            ====================================================== --}}
            @if(session('success'))

                <div class="alert alert-success">

                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>
                    </svg>

                    <div>
                        <div class="alert-title">Berhasil</div>
                        <div>{{ session('success') }}</div>
                    </div>

                </div>

            @endif


            {{-- =====================================================
                 ERROR MESSAGE
            ====================================================== --}}
            @if($errors->any())

                <div class="alert alert-error">

                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86l-8.18 14a2 2 0 001.72 3h16.34a2 2 0 001.72-3l-8.18-14a2 2 0 00-3.42 0z"/>
                    </svg>

                    <div>

                        <div class="alert-title">
                            Data belum dapat disimpan
                        </div>

                        <ul style="margin:0; padding-left:18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                 FORM TAMBAH PSIKOLOG
            ====================================================== --}}
            <div class="content-card" id="tambah-psikolog">

                <div class="card-header">

                    <div class="card-heading">

                        <div class="card-heading-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>

                        <div>
                            <h3 class="card-title">
                                Informasi Akun Psikolog
                            </h3>

                            <p class="card-description">
                                Lengkapi informasi berikut untuk membuat akun baru.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    <form action="{{ route('admin.psikolog.store') }}" method="POST">

                        @csrf

                        <div class="form-grid">

                            {{-- NAMA --}}
                            <div class="form-group">

                                <label for="nama" class="form-label">
                                    Nama Lengkap
                                </label>

                                <div class="input-wrapper">

                                    <svg class="input-icon" width="18" height="18"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0"/>
                                    </svg>

                                    <input
                                        type="text"
                                        name="nama"
                                        id="nama"
                                        value="{{ old('nama') }}"
                                        placeholder="Masukkan nama lengkap psikolog"
                                        required
                                        class="form-input"
                                    >

                                </div>

                                @error('nama')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror

                            </div>


                            {{-- EMAIL --}}
                            <div class="form-group">

                                <label for="email" class="form-label">
                                    Alamat Email
                                </label>

                                <div class="input-wrapper">

                                    <svg class="input-icon" width="18" height="18"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email') }}"
                                        placeholder="contoh@email.com"
                                        required
                                        class="form-input"
                                    >

                                </div>

                                @error('email')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror

                            </div>


                            {{-- SPESIALISASI --}}
                            <div class="form-group">

                                <label for="spesialisasi" class="form-label">
                                    Spesialisasi
                                </label>

                                <div class="input-wrapper">

                                    <svg class="input-icon" width="18" height="18"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.5 13.5L4 19m0 0l3 1 1-3m-4 2l6-6m3-7a4 4 0 015.66 5.66l-6.83 6.83a2 2 0 01-2.83 0L7.5 16.5a2 2 0 010-2.83L14.33 6.84A4 4 0 0117 5z"/>
                                    </svg>

                                    <select
                                        name="spesialisasi"
                                        id="spesialisasi"
                                        required
                                        class="form-select"
                                    >

                                        <option value="">
                                            Pilih spesialisasi
                                        </option>

                                        <option value="Psikologi Klinis"
                                            {{ old('spesialisasi') == 'Psikologi Klinis' ? 'selected' : '' }}>
                                            Psikologi Klinis
                                        </option>

                                        <option value="Psikologi Pendidikan"
                                            {{ old('spesialisasi') == 'Psikologi Pendidikan' ? 'selected' : '' }}>
                                            Psikologi Pendidikan
                                        </option>

                                        <option value="Psikologi Anak dan Remaja"
                                            {{ old('spesialisasi') == 'Psikologi Anak dan Remaja' ? 'selected' : '' }}>
                                            Psikologi Anak dan Remaja
                                        </option>

                                        <option value="Psikologi Konseling"
                                            {{ old('spesialisasi') == 'Psikologi Konseling' ? 'selected' : '' }}>
                                            Psikologi Konseling
                                        </option>

                                    </select>

                                </div>

                                @error('spesialisasi')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror

                            </div>


                            {{-- STR --}}
                            <div class="form-group">

                                <label for="no_str" class="form-label">
                                    Nomor STR
                                </label>

                                <div class="input-wrapper">

                                    <svg class="input-icon" width="18" height="18"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/>
                                    </svg>

                                    <input
                                        type="text"
                                        name="no_str"
                                        id="no_str"
                                        value="{{ old('no_str') }}"
                                        placeholder="Masukkan nomor STR"
                                        required
                                        class="form-input"
                                    >

                                </div>

                                @error('no_str')
                                    <div class="form-error">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>


                        {{-- PASSWORD --}}
                        <div class="password-info">

                            <div class="password-icon">

                                <svg width="18" height="18"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm3-11V7a3 3 0 116 0v1"/>
                                </svg>

                            </div>

                            <div>

                                <div class="password-title">
                                    Password Awal Akun
                                </div>

                                <div class="password-text">
                                    Akun akan dibuat menggunakan password awal
                                    <span class="password-value">psikolog123</span>.
                                    Psikolog dapat menggantinya setelah berhasil login.
                                </div>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="form-footer">

                            <button
                                type="submit"
                                class="submit-button"
                            >

                                <svg width="18" height="18"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4v16m8-8H4"/>
                                </svg>

                                Simpan Akun Psikolog

                            </button>

                        </div>

                    </form>

                </div>

            </div>


            {{-- =====================================================
                 DATA PSIKOLOG
            ====================================================== --}}
            <div class="content-card">

                <div class="card-header">

                    <div class="card-heading">

                        <div class="card-heading-icon">

                            <svg width="20" height="20"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8z"/>
                            </svg>

                        </div>

                        <div>

                            <h3 class="card-title">
                                Daftar Psikolog
                            </h3>

                            <p class="card-description">
                                Daftar seluruh psikolog yang terdaftar dalam sistem.
                            </p>

                        </div>

                    </div>


                    <div class="specialization-badge">
                        {{ $psikologs->count() }} Psikolog
                    </div>

                </div>


                @if($psikologs->isEmpty())

                    {{-- EMPTY STATE --}}

                    <div class="empty-state">

                        <div class="empty-icon">

                            <svg width="28" height="28"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8z"/>
                            </svg>

                        </div>

                        <div class="empty-title">
                            Belum Ada Data Psikolog
                        </div>

                        <div class="empty-description">
                            Tambahkan akun psikolog menggunakan formulir di atas.
                        </div>

                    </div>

                @else

                    {{-- TABLE --}}

                    <div class="table-wrapper">

                        <table class="psychologist-table">

                            <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Psikolog</th>
                                    <th>Email</th>
                                    <th>Spesialisasi</th>
                                    <th>No. STR</th>
                                    <th>Status</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($psikologs as $psikolog)

                                    <tr>

                                        <td class="number-cell">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>

                                            <div class="profile-cell">

                                                <div class="avatar">
                                                    {{ strtoupper(substr($psikolog->name, 0, 1)) }}
                                                </div>

                                                <div>

                                                    <div class="profile-name">
                                                        {{ $psikolog->name }}
                                                    </div>

                                                    <div class="profile-role">
                                                        Psikolog MindCare
                                                    </div>

                                                </div>

                                            </div>

                                        </td>

                                        <td class="email-cell">
                                            {{ $psikolog->email }}
                                        </td>

                                        <td>

                                            <span class="specialization-badge">
                                                {{ $psikolog->spesialisasi ?? '-' }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="str-number">
                                                {{ $psikolog->no_str ?? '-' }}
                                            </span>

                                        </td>

                                        <td>

                                            <span class="status-badge">

                                                <span class="status-dot"></span>

                                                Aktif

                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>