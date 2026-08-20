<!-- Pastikan Alpine.js sudah di-load di layout utama, contoh:
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
-->

<div x-data="{ open: false, profileOpen: false }">

    <style>
        /* Overlay gelap saat sidebar terbuka di mobile */
        .mc-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .5);
            z-index: 40;
        }

        /* Wrapper utama Sidebar */
        .mc-sidebar {
            background: linear-gradient(180deg, #0f172a, #1e293b);
            border-right: 1px solid rgba(255,255,255,.08);
            font-family: 'Segoe UI', sans-serif;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 280px;
            z-index: 50;
            box-shadow: 10px 0 35px rgba(15,23,42,.15);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px 16px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);

            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .mc-sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .mc-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 999px;
        }

        .mc-sidebar-top {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .mc-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            padding-left: 8px;
        }

        .mc-logo-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mc-logo-box img {
            width: 44px;
            height: 44px;
            object-fit: contain;
            display: block;
        }

        .mc-brand {
            font-size: 24px;
            font-weight: 900;
            color: white;
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        .mc-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mc-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 14px;
            text-decoration: none;
            color: #cbd5e1;
            font-weight: 700;
            font-size: 14px;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .mc-link:hover {
            background: rgba(255,255,255,.06);
            color: white;
            padding-left: 20px;
        }

        .mc-link.active {
            background: rgba(255,255,255,.12);
            color: white;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.08);
        }

        /* Tombol tutup menu, hanya tampil di mobile */
        .mc-close-menu-btn {
            display: none;
            align-items: center;
            gap: 8px;
            width: 100%;
            margin-top: 8px;
            padding: 12px 16px;
            border-radius: 14px;
            border: 1px dashed rgba(255,255,255,.15);
            background: transparent;
            color: #94a3b8;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: .2s;
        }

        .mc-close-menu-btn:hover {
            color: white;
            border-color: rgba(255,255,255,.3);
        }

        .mc-sidebar-bottom {
            position: relative; /* diperlukan agar dropdown ter-posisi dengan benar */
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 20px;
            margin-top: 20px;
        }

        .mc-user-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 10px;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.08);
            color: white;
            padding: 12px;
            border-radius: 16px;
            cursor: pointer;
            transition: .25s;
        }

        .mc-user-button:hover {
            background: rgba(255,255,255,.12);
        }

        .mc-user-left {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .mc-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #22d3ee, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: white;
            font-size: 16px;
            flex-shrink: 0;
        }

        .mc-user-info {
            text-align: left;
            line-height: 1.3;
            min-width: 0;
        }

        .mc-user-name {
            font-size: 14px;
            font-weight: 800;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .mc-user-role {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 600;
        }

        /* Dropdown profil (sebelumnya tidak punya style sama sekali) */
        .mc-dropdown-menu {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 0;
            right: 0;
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
        }

        .mc-dropdown-link {
            display: block;
            padding: 12px 16px;
            color: #334155;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
        }

        .mc-dropdown-link:hover {
            background: #f1f5f9;
        }

        .mc-hamburger {
            position: fixed;
            top: 16px;
            right: 16px;
            background: #0f172a;
            border: 1px solid rgba(255,255,255,.12);
            color: white;
            padding: 10px;
            border-radius: 12px;
            cursor: pointer;
            z-index: 60;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        @media (max-width: 1024px) {
            .mc-sidebar {
                transform: translateX(-100%);
            }
            .mc-sidebar.open {
                transform: translateX(0);
            }
            .mc-hamburger {
                display: inline-flex;
            }
            .mc-close-menu-btn {
                display: flex;
            }
        }
    </style>

    <!-- Overlay gelap, hanya aktif di mobile saat sidebar terbuka -->
    <div x-show="open"
         x-transition.opacity
         @click="open = false"
         class="mc-overlay"
         style="display: none;"></div>

    <!-- Sidebar -->
    <nav :class="{ 'open': open }" class="mc-sidebar" id="sidebar">

        <div class="mc-sidebar-top">
            @php
                $role = strtolower(Auth::user()->role ?? '');
                $logoUrl = match($role) {
                    'admin' => route('Admin.dashboard'),
                    'psikolog' => route('psikolog.dashboard'),
                    'pasien' => route('pasien.dashboard'),
                    default => route('home'),
                };
            @endphp
            <a href="{{ $logoUrl }}" class="mc-logo">
                <div class="mc-logo-box">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <span class="mc-brand">MindCare</span>
            </a>

            <div class="mc-menu">
                {{-- Menu Admin --}}
                @if($role === 'admin')
                    <a href="{{ route('Admin.dashboard') }}"
                       class="mc-link {{ request()->routeIs('Admin.dashboard') ? 'active' : '' }}">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('Admin.Pasien.Pasien') }}"
                       class="mc-link {{ request()->routeIs('Admin.Pasien.*') ? 'active' : '' }}">
                        <span>Kelola Pasien</span>
                    </a>

                    <a href="{{ route('Admin.Psikolog.index') }}"
                       class="mc-link {{ request()->routeIs('Admin.Psikolog.*') ? 'active' : '' }}">
                        <span>Kelola Psikolog</span>
                    </a>

                    <a href="{{ route('Admin.users') }}"
                       class="mc-link {{ request()->routeIs('Admin.users*') ? 'active' : '' }}">
                        <span>Kelola User</span>
                    </a>

                    <a href="{{ route('Admin.Edukasi.Edukasi') }}"
                       class="mc-link {{ request()->routeIs('Admin.Edukasi.*') ? 'active' : '' }}">
                        <span>Kelola Edukasi</span>
                    </a>

                    <a href="{{ route('Admin.Artikel.Artikel') }}"
                       class="mc-link {{ request()->routeIs('Admin.Artikel.*') ? 'active' : '' }}">
                        <span>Kelola Artikel</span>
                    </a>

                    <a href="{{ route('admin.kuesioner.index') }}"
                       class="mc-link {{ request()->routeIs('admin.kuesioner.*') || request()->routeIs('pengguna.hasil-detail') ? 'active' : '' }}">
                        <span>Data Kuesioner</span>
                    </a>

                    <a href="{{ route('Admin.laporan') }}"
                       class="mc-link {{ request()->routeIs('Admin.laporan') ? 'active' : '' }}">
                        <span>Statistik / Laporan</span>
                    </a>
                @elseif($role === 'psikolog')
                    {{-- Menu Psikolog --}}
                    <a href="{{ route('psikolog.dashboard') }}"
                       class="mc-link {{ request()->routeIs('psikolog.dashboard') ? 'active' : '' }}">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('psikolog.pengguna') }}"
                       class="mc-link {{ request()->routeIs('psikolog.pengguna') ? 'active' : '' }}">
                        <span>Riwayat Pemeriksaan</span>
                    </a>

                    <a href="{{ route('psikolog.detail') }}"
                       class="mc-link {{ request()->routeIs('psikolog.detail') ? 'active' : '' }}">
                        <span>Detail Pasien</span>
                    </a>

                    <a href="{{ route('psikolog.hasil') }}"
                       class="mc-link {{ request()->routeIs('psikolog.hasil') ? 'active' : '' }}">
                        <span>Hasil Pemeriksaan</span>
                    </a>

                    <a href="{{ route('psikolog.cluster') }}"
                       class="mc-link {{ request()->routeIs('psikolog.cluster') ? 'active' : '' }}">
                        <span>Profil Cluster</span>
                    </a>

                @elseif($role === 'pasien')
                    {{-- Menu Pasien --}}
                    <a href="{{ route('pasien.dashboard') }}"
                       class="mc-link {{ request()->routeIs('pasien.dashboard') ? 'active' : '' }}">
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('pasien.tes') }}"
                       class="mc-link {{ request()->routeIs('pasien.tes') ? 'active' : '' }}">
                        <span>Tes Kesehatan Mental</span>
                    </a>

                    <a href="{{ route('pasien.hasil') }}"
                       class="mc-link {{ request()->routeIs('pasien.hasil') ? 'active' : '' }}">
                        <span>Hasil Risiko</span>
                    </a>

                    <a href="{{ route('pasien.riwayat') }}"
                       class="mc-link {{ request()->routeIs('pasien.riwayat') ? 'active' : '' }}">
                        <span>Riwayat Pemeriksaan</span>
                    </a>

                    <a href="{{ route('pasien.rekomendasi') }}"
                       class="mc-link {{ request()->routeIs('pasien.rekomendasi') ? 'active' : '' }}">
                        <span>Rekomendasi</span>
                    </a>
                @else
                    {{-- Jika role tidak valid, tampilkan link ke halaman beranda --}}
                    <a href="{{ route('home') }}" class="mc-link">
                        <span>Home</span>
                    </a>
                @endif

                <!-- Tombol tutup menu (hanya tampil di mobile) -->
                <button type="button" class="mc-close-menu-btn" @click="open = false">
                    ✖ <span>Tutup Navigasi</span>
                </button>
            </div>
        </div>

        <!-- Profil & Logout -->
        <div class="mc-sidebar-bottom">
            <button type="button" class="mc-user-button" @click="profileOpen = !profileOpen">
                <div class="mc-user-left">
                    <div class="mc-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="mc-user-info">
                        <div class="mc-user-name">{{ Auth::user()->name ?? 'User' }}</div>
                        <div class="mc-user-role">{{ Auth::user()->role ?? 'Pengguna' }}</div>
                    </div>
                </div>
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"
                     :style="profileOpen ? 'transform: rotate(180deg)' : ''">
                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="profileOpen"
                 x-transition
                 @click.away="profileOpen = false"
                 class="mc-dropdown-menu"
                 style="display: none;">
                <a href="{{ route('profile.edit') }}" class="mc-dropdown-link">
                    ⚙️ Profil Saya
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="mc-dropdown-link" style="width: 100%; text-align: left; border: none; background: none; cursor: pointer; padding: 10px 12px;">
                        🚪 Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Tombol Hamburger (sekarang berada dalam scope x-data yang sama dengan nav) -->
    <button @click="open = !open" class="mc-hamburger" aria-label="Toggle Menu">
        <svg x-show="!open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>