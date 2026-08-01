<!-- Mengintegrasikan status open langsung ke pembungkus utama -->
<nav x-data="{ open: false }" 
     :class="{ 'open': open }" 
     class="mc-sidebar" 
     id="sidebar">
     
    <style>
        /* Mengubah total pembungkus menjadi Sidebar Samping */
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
            
            /* PERBAIKAN 1: Mengaktifkan scroll mandiri jika isi menu terlalu panjang */
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Sembunyikan scrollbar bawaan browser agar sidebar tetap minimalis */
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

        /* Menu Navigasi Vertikal */
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
            padding-left: 20px; /* Efek bergeser sedikit saat hover */
        }

        .mc-link.active {
            background: rgba(255,255,255,.12);
            color: white;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.08);
        }

        /* Informasi Pengguna Terkunci di Bagian Bawah Sidebar */
        .mc-sidebar-bottom {
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 20px;
            margin-top: 20px; /* Jaga jarak jika menu atas menumpuk */
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

        /* Tombol Pemicu Mobile Toggle (Hamburger) */
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
            display: none; /* Default tersembunyi di desktop */
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Responsif Layar Gawai (Mobile & Tablet) */
        @media (max-width: 1024px) {
            .mc-sidebar {
                transform: translateX(-100%);
            }
            /* PERBAIKAN 2: Memastikan kelas open terpicu dengan transisi halus */
            .mc-sidebar.open {
                transform: translateX(0);
            }
            .mc-hamburger {
                display: inline-flex;
            }
        }
    </style>

    <!-- Bagian Atas Sidebar: Logo & Navigasi Utama -->
    <div class="mc-sidebar-top">
        <a href="{{ route('Admin.dashboard') }}" class="mc-logo">
            <div class="mc-logo-box">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            <span class="mc-brand">MindCare</span>
        </a>

        <div class="mc-menu">
            <a href="{{ route('Admin.dashboard') }}"
               class="mc-link {{ request()->routeIs('Admin.dashboard') ? 'active' : '' }}">
                <span>Dashboard</span>
            </a>

            <a href="{{ route('Admin.Pasien.Pasien') }}"
               class="mc-link {{ request()->routeIs('Admin.Pasien.Pasien') ? 'active' : '' }}">
                <span>Pasien</span>
            </a>

            <a href="{{ route('Admin.Edukasi.Edukasi') }}"
               class="mc-link {{ request()->routeIs('Admin.Edukasi.Edukasi') ? 'active' : '' }}">
                <span>Edukasi</span>
            </a>

            <a href="{{ route('Admin.Artikel.Artikel') }}"
               class="mc-link {{ request()->routeIs('Admin.Artikel.Artikel') ? 'active' : '' }}">
                <span>Artikel</span>
            </a>

            <a href="{{ route('Admin.CekMel.CekMel') }}"
               class="mc-link {{ request()->routeIs('Admin.CekMel.CekMel') ? 'active' : '' }}">
                <span>Cek Kesehatan Mental</span>
            </a>
            <!-- Tombol Interaktif Pengontrol Tampilan Sidebar -->
            <button type="button" class="sidebar-toggle-btn" onclick="toggleSidebarLayout()">
                📋 <span>Buka / Tutup Navigasi</span>
            </button>
        </div>
    </div>

    <!-- Bagian Bawah Sidebar: Profil Akun & Dropdown Keluar -->
    <div class="mc-sidebar-bottom">
        <x-dropdown align="top" width="48">
            <x-slot name="trigger">
                <button class="mc-user-button">
                    <div class="mc-user-left">
                        <div class="mc-avatar">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="mc-user-info">
                            <div class="mc-user-name">{{ Auth::user()->name ?? 'User' }}</div>
                            <div class="mc-user-role">{{ Auth::user()->role ?? 'Pengguna' }}</div>
                        </div>
                    </div>
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <a href="{{ route('profile.edit') }}" class="mc-dropdown-link">
                    Profil Saya
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       class="mc-dropdown-link"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </a>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>

<!-- Tombol Toggle Hamburger Khusus Layar Ponsel / Tablet -->
<button @click="open = !open" class="mc-hamburger" aria-label="Toggle Menu">
    <!-- Icon Hamburger -->
    <svg x-show="!open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
    <!-- Icon Close -->
    <svg x-show="open" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>