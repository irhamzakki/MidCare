<style>
    /* ==========================
   MODERN NAVBAR MINDCARE
========================== */

.navbar-mindcare{
    position: sticky;
    top: 0;
    z-index: 999;
    backdrop-filter: blur(20px);
    background: rgba(255,255,255,.75);
    border-bottom: 1px solid rgba(226,232,240,.8);
    box-shadow: 0 8px 30px rgba(15,23,42,.05);
}

.navbar-container{
    max-width: 1280px;
    margin: auto;
    padding: 0 24px;
    height: 82px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-logo{
    display: flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
}

.navbar-logo img{
    width: 58px;
    height: 58px;
    object-fit: contain;

    transition: .3s;
}

.navbar-logo:hover img{
    transform: rotate(-8deg) scale(1.05);
}

.brand-title{
    font-size: 22px;
    font-weight: 900;
    color: #0f172a;
    line-height: 1;
}

.brand-subtitle{
    font-size: 12px;
    color: #64748b;
    margin-top: 3px;
}

/* MENU */

.navbar-menu{
    display: flex;
    align-items: center;
    gap: 12px;
}

.navbar-menu a{
    position: relative;

    padding: 10px 18px;
    border-radius: 14px;

    font-size: 15px;
    font-weight: 700;

    color: #475569;
    text-decoration: none;

    transition: .3s;
}

.navbar-menu a:hover{
    color: #0284c7;
    background: rgba(14,165,233,.08);
}

.navbar-menu a::after{
    content:'';
    position:absolute;

    bottom:5px;
    left:50%;

    width:0;
    height:2px;

    background:#0ea5e9;
    transition:.3s;
}

.navbar-menu a:hover::after{
    width:60%;
    left:20%;
}

/* BUTTON */

.navbar-action{
    display:flex;
    align-items:center;
    gap:12px;
}

.btn-login{
    padding:12px 22px;
    border-radius:16px;

    font-weight:700;
    text-decoration:none;

    color:#334155;
    transition:.3s;
}

.btn-login:hover{
    background:#f1f5f9;
}

.btn-register{
    padding:12px 24px;

    border-radius:18px;

    background:linear-gradient(
        135deg,
        #06b6d4,
        #2563eb
    );

    color:white;
    font-weight:800;
    text-decoration:none;

    box-shadow:
        0 10px 25px rgba(37,99,235,.25);

    transition:.3s;
}

.btn-register:hover{
    transform:translateY(-2px);
    box-shadow:
        0 16px 35px rgba(37,99,235,.35);
}

.btn-dashboard{
    padding:12px 24px;

    border-radius:18px;

    background:linear-gradient(
        135deg,
        #0891b2,
        #2563eb
    );

    color:white;
    font-weight:800;
    text-decoration:none;

    box-shadow:
        0 10px 25px rgba(37,99,235,.25);

    transition:.3s;
}

.btn-dashboard:hover{
    transform:translateY(-2px);
}

/* MOBILE */

@media(max-width:900px){

    .navbar-menu{
        display:none;
    }

    .brand-title{
        font-size:18px;
    }

    .navbar-logo img{
        width:48px;
        height:48px;
    }
}
</style>
<header class="navbar-mindcare">

    <div class="navbar-container">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-logo">

            <img src="{{ asset('Images/Logo.png') }}" alt="MindCare">

            <div>
                <div class="brand-title">
                    MindCare
                </div>

                <div class="brand-subtitle">
                    Mental Health Screening System
                </div>
            </div>

        </a>

        <!-- Menu -->
        <div class="navbar-menu">

            <a href="{{ url('/') }}">
                Beranda
            </a>

            <a href="{{ url('/screening') }}">
                Screening
            </a>

            <a href="{{ url('/Edukasi') }}">
                Edukasi
            </a>

            <a href="{{ url('/artikel') }}">
                Artikel
            </a>
            <a href="{{ url('/profil') }}">
                Profil
            </a>
            

        </div>

        <!-- Action -->
        <div class="navbar-action">

            @auth
                @php
                    $role = strtolower(Auth::user()->role ?? '');
                    $dashboardUrl = match($role) {
                        'admin' => route('Admin.dashboard'),
                        'psikolog' => route('psikolog.dashboard'),
                        'pasien' => route('pasien.dashboard'),
                        default => url('/'),
                    };
                @endphp
                <a href="{{ $dashboardUrl }}"
                   class="btn-dashboard">
                    Dashboard
                </a>

            @else

                <a href="{{ route('login') }}"
                   class="btn-login">
                    Login
                </a>

                @if(Route::has('register'))

                    <a href="{{ route('register') }}"
                       class="btn-register">
                        Daftar
                    </a>

                @endif

            @endauth

        </div>

    </div>

</header>