<x-app-layout>

    <style>
        /* =========================================================
           MINDCARE - BUAT AKUN BARU
        ========================================================= */

        .create-user-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at top right, rgba(14, 165, 233, .08), transparent 28%),
                linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            box-sizing: border-box;
        }

        @media (min-width: 1024px) {
            .create-user-page {
                padding-left: 296px;
                padding-right: 36px;
                padding-top: 32px;
                padding-bottom: 40px;
            }
        }

        @media (min-width: 640px) and (max-width: 1023px) {
            .create-user-page {
                padding-left: 240px;
                padding-right: 24px;
            }
        }

        .create-user-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .page-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
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
            flex-shrink: 0;
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
           MAIN CARD
        ========================================================= */

        .form-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .055);
            overflow: hidden;
        }

        .card-header {
            padding: 22px 26px;
            border-bottom: 1px solid #eef2f7;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f9ff;
            color: #0284c7;
            flex-shrink: 0;
        }

        .card-title {
            color: #0f172a;
            font-size: 17px;
            font-weight: 800;
        }

        .card-description {
            margin-top: 3px;
            color: #64748b;
            font-size: 12px;
        }

        .card-body {
            padding: 28px 26px;
        }

        /* =========================================================
           SUCCESS
        ========================================================= */

        .success-alert {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 14px 16px;
            margin-bottom: 23px;
            border-radius: 13px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            font-size: 13px;
            font-weight: 600;
        }

        .success-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: #059669;
            flex-shrink: 0;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-wrapper {
            display: flex;
            flex-direction: column;
            gap: 21px;
        }

        .form-group {
            width: 100%;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
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
            display: block;
            width: 100%;
            min-height: 47px;
            box-sizing: border-box;
            padding: 11px 14px 11px 42px;
            border: 1px solid #dbe3ec;
            border-radius: 12px;
            background: #fbfdff;
            color: #0f172a;
            font-size: 13px;
            outline: none;
            transition: all .2s ease;
        }

        .form-select {
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
            box-shadow: 0 0 0 4px rgba(14, 165, 233, .10);
        }

        .form-error {
            margin-top: 6px;
            font-size: 11px;
            color: #e11d48;
            font-weight: 600;
        }

        /* =========================================================
           PASSWORD SECTION
        ========================================================= */

        .password-section {
            margin-top: 2px;
            padding-top: 24px;
            border-top: 1px solid #eef2f7;
        }

        .password-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 17px;
            color: #334155;
            font-size: 13px;
            font-weight: 800;
        }

        .password-title-icon {
            color: #0284c7;
        }

        /* =========================================================
           BUTTON AREA
        ========================================================= */

        .form-footer {
            margin-top: 4px;
            padding-top: 23px;
            border-top: 1px solid #eef2f7;
            display: flex;
            justify-content: flex-end;
        }

        .submit-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 46px;
            padding: 0 22px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, #0284c7, #0ea5e9);
            color: white;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 7px 16px rgba(14, 165, 233, .20);
            transition: all .2s ease;
        }

        .submit-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(14, 165, 233, .27);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 767px) {

            .create-user-page {
                padding: 16px;
            }

            .page-header {
                align-items: flex-start;
            }

            .page-icon {
                width: 46px;
                height: 46px;
            }

            .page-title {
                font-size: 23px;
            }

            .page-subtitle {
                font-size: 12px;
            }

            .card-header {
                padding: 19px 20px;
            }

            .card-body {
                padding: 22px 20px;
            }

            .form-footer {
                justify-content: stretch;
            }

            .submit-button {
                width: 100%;
            }
        }
    </style>


    <div class="create-user-page">

        <div class="create-user-container">

            {{-- =====================================================
                 PAGE HEADER
            ====================================================== --}}
            <div class="page-header">

                <div class="page-icon">

                    <svg width="25" height="25"
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

                    <h1 class="page-title">
                        Buat Akun Baru
                    </h1>

                    <p class="page-subtitle">
                        Admin dapat membuat akun pasien atau psikolog dari halaman ini.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                 MAIN FORM CARD
            ====================================================== --}}
            <div class="form-card">

                {{-- CARD HEADER --}}
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
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0"/>

                        </svg>

                    </div>

                    <div>

                        <div class="card-title">
                            Informasi Akun
                        </div>

                        <div class="card-description">
                            Lengkapi data pengguna untuk membuat akun baru.
                        </div>

                    </div>

                </div>


                <div class="card-body">

                    {{-- =================================================
                         SUCCESS MESSAGE
                    ================================================== --}}
                    @if(session('success'))

                        <div class="success-alert">

                            <div class="success-icon">

                                <svg width="16" height="16"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"/>

                                </svg>

                            </div>

                            <span>
                                {{ session('success') }}
                            </span>

                        </div>

                    @endif


                    {{-- =================================================
                         FORM
                    ================================================== --}}
                    <form
                        method="POST"
                        action="{{ route('Admin.users.store') }}"
                        class="form-wrapper">

                        @csrf


                        {{-- NAMA --}}
                        <div class="form-group">

                            <label
                                for="name"
                                class="form-label">

                                Nama Lengkap

                            </label>

                            <div class="input-wrapper">

                                <svg
                                    class="input-icon"
                                    width="18"
                                    height="18"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0"/>

                                </svg>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="Masukkan nama lengkap"
                                    class="form-input"
                                >

                            </div>

                            <x-input-error
                                :messages="$errors->get('name')"
                                class="form-error"
                            />

                        </div>


                        {{-- EMAIL --}}
                        <div class="form-group">

                            <label
                                for="email"
                                class="form-label">

                                Email

                            </label>

                            <div class="input-wrapper">

                                <svg
                                    class="input-icon"
                                    width="18"
                                    height="18"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>

                                </svg>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="contoh@email.com"
                                    class="form-input"
                                >

                            </div>

                            <x-input-error
                                :messages="$errors->get('email')"
                                class="form-error"
                            />

                        </div>


                        {{-- ROLE --}}
                        <div class="form-group">

                            <label
                                for="role"
                                class="form-label">

                                Peran

                            </label>

                            <div class="input-wrapper">

                                <svg
                                    class="input-icon"
                                    width="18"
                                    height="18"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8z"/>

                                </svg>

                                <select
                                    id="role"
                                    name="role"
                                    required
                                    class="form-select">

                                    <option
                                        value="pasien"
                                        {{ old('role') === 'pasien' ? 'selected' : '' }}>

                                        Pasien

                                    </option>

                                    <option
                                        value="psikolog"
                                        {{ old('role') === 'psikolog' ? 'selected' : '' }}>

                                        Psikolog

                                    </option>

                                </select>

                            </div>

                            <x-input-error
                                :messages="$errors->get('role')"
                                class="form-error"
                            />

                        </div>


                        {{-- PASSWORD --}}
                        <div class="password-section">

                            <div class="password-title">

                                <svg
                                    class="password-title-icon"
                                    width="17"
                                    height="17"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm3-11V7a3 3 0 116 0v1"/>

                                </svg>

                                Keamanan Akun

                            </div>


                            {{-- PASSWORD --}}
                            <div class="form-group">

                                <label
                                    for="password"
                                    class="form-label">

                                    Password

                                </label>

                                <div class="input-wrapper">

                                    <svg
                                        class="input-icon"
                                        width="18"
                                        height="18"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-7a2 2 0 00-2-2H6a2 2 0 00-2 2v7a2 2 0 002 2zm3-11V7a3 3 0 116 0v1"/>

                                    </svg>

                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        required
                                        placeholder="Masukkan password"
                                        class="form-input"
                                    >

                                </div>

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="form-error"
                                />

                            </div>


                            {{-- KONFIRMASI PASSWORD --}}
                            <div class="form-group" style="margin-top: 21px;">

                                <label
                                    for="password_confirmation"
                                    class="form-label">

                                    Konfirmasi Password

                                </label>

                                <div class="input-wrapper">

                                    <svg
                                        class="input-icon"
                                        width="18"
                                        height="18"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5-1V7a3 3 0 00-3-3H7a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3v-2"/>

                                    </svg>

                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        required
                                        placeholder="Masukkan kembali password"
                                        class="form-input"
                                    >

                                </div>

                                <x-input-error
                                    :messages="$errors->get('password_confirmation')"
                                    class="form-error"
                                />

                            </div>

                        </div>


                        {{-- =================================================
                             BUTTON
                        ================================================== --}}
                        <div class="form-footer">

                            <button
                                type="submit"
                                class="submit-button">

                                <svg
                                    width="18"
                                    height="18"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"/>

                                </svg>

                                Simpan Akun

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>