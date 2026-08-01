<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MindCare - Screening Kesehatan Mental</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', 'Segoe UI', sans-serif; }
        .glass {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.82);
        }
    </style>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            color: #ffffff;
            overflow-x: hidden;
            background:
                radial-gradient(circle at top left, rgba(6,182,212,.25), transparent 35%),
                radial-gradient(circle at top right, rgba(37,99,235,.28), transparent 35%),
                linear-gradient(135deg, #020617 0%, #0f172a 45%, #111827 100%);
        }

        .page {
            position: relative;
            min-height: 100vh;
            padding: 40px 7%;
            overflow: hidden;
        }

        .grid-bg {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
            background-size: 55px 55px;
            animation: moveGrid 35s linear infinite;
            pointer-events: none;
        }

        @keyframes moveGrid {
            from { transform: translateY(0); }
            to { transform: translateY(-300px); }
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .45;
            animation: orbMove 8s ease-in-out infinite;
        }

        .orb-1 {
            width: 380px;
            height: 380px;
            background: #06b6d4;
            top: -120px;
            left: -100px;
        }

        .orb-2 {
            width: 420px;
            height: 420px;
            background: #2563eb;
            right: -120px;
            top: 180px;
            animation-delay: 1s;
        }

        .orb-3 {
            width: 350px;
            height: 350px;
            background: #6366f1;
            bottom: -100px;
            left: 38%;
            animation-delay: 2s;
        }

        @keyframes orbMove {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-35px) scale(1.08); }
        }

        .container {
            position: relative;
            z-index: 2;
            max-width: 1180px;
            margin: auto;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 36px;
            color: #cffafe;
            text-decoration: none;
            font-weight: 800;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.16);
            padding: 13px 22px;
            border-radius: 999px;
            backdrop-filter: blur(14px);
            transition: .3s;
        }

        .back-link:hover {
            transform: translateY(-4px);
            background: rgba(255,255,255,.16);
        }

        .hero {
            position: relative;
            text-align: center;
            padding: 60px 35px;
            border-radius: 42px;
            background: rgba(15,23,42,.68);
            border: 1px solid rgba(125,211,252,.20);
            backdrop-filter: blur(28px);
            box-shadow:
                0 35px 90px rgba(0,0,0,.45),
                inset 0 0 50px rgba(14,165,233,.05);
            overflow: hidden;
            animation: fadeUp .8s ease forwards;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(120deg, transparent, rgba(6,182,212,.12), transparent);
            transform: translateX(-100%);
            animation: scanLight 5s infinite;
        }

        @keyframes scanLight {
            0% { transform: translateX(-120%); }
            45%, 100% { transform: translateX(120%); }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(35px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .photo-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
            position: relative;
            z-index: 2;
        }

        .photo-core{
    position:relative;

    width:320px;
    height:320px;

    display:flex;
    justify-content:center;
    align-items:center;
}

.photo-border{

    position:absolute;

    inset:0;

    border-radius:50%;

    background:conic-gradient(
        #38bdf8,
        #2563eb,
        #38bdf8
    );

    animation:rotateRing 4s linear infinite;

    box-shadow:
        0 0 40px rgba(56,189,248,.4),
        0 0 90px rgba(37,99,235,.25);
}

.photo-core img{

    position:relative;
    z-index:2;

    width:300px;
    height:300px;

    object-fit:cover;

    border-radius:50%;

    border:6px solid #020617;

    filter: drop-shadow(0 0 18px rgba(6,182,212,.25));
}

        .photo-core::before {
            content: "";
            position: absolute;
            inset: -18px;
            border-radius: 50%;
            border: 2px dashed rgba(125,211,252,.45);
            animation: rotateRing 12s linear infinite;
        }

        .photo-core::after {
            content: "";
            position: absolute;
            inset: -34px;
            border-radius: 50%;
            border: 1px solid rgba(226,232,240,.20);
            animation: rotateRingReverse 18s linear infinite;
        }

        .photo-core img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 7px solid #020617;
        }

        @keyframes heroFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-18px); }
        }

        @keyframes colorSpin {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(360deg); }
        }

        @keyframes rotateRing {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes rotateRingReverse {
            from { transform: rotate(360deg); }
            to { transform: rotate(0deg); }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 12px 22px;
            border-radius: 999px;
            background: rgba(14,165,233,.12);
            border: 1px solid rgba(125,211,252,.28);
            color: #7dd3fc;
            font-weight: 900;
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .badge span {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #22d3ee;
            box-shadow: 0 0 18px #22d3ee;
            animation: blink 1.2s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: .3; }
        }

        .hero h1 {
            font-size: 64px;
            line-height: 1.05;
            font-weight: 950;
            letter-spacing: 1px;
            margin-bottom: 18px;
            position: relative;
            z-index: 2;
        }

        .gradient-text {
            background: linear-gradient(135deg, #e0f2fe, #38bdf8, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 40px rgba(56,189,248,.4);
        }

        .subtitle {
            color: #cbd5e1;
            max-width: 820px;
            margin: auto;
            font-size: 17px;
            line-height: 1.8;
            position: relative;
            z-index: 2;
        }

        .hero-actions {
            margin-top: 32px;
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .btn {
            padding: 15px 26px;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 900;
            transition: .3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #38bdf8, #2563eb);
            color: white;
            box-shadow: 0 15px 35px rgba(37,99,235,.35);
        }

        .btn-secondary {
            color: white;
            border: 1px solid rgba(255,255,255,.18);
            background: rgba(255,255,255,.08);
        }

        .btn:hover {
            transform: translateY(-5px);
        }

        .stats {
            margin-top: 34px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .stat-card {
            padding: 22px;
            border-radius: 24px;
            background: rgba(15,23,42,.58);
            border: 1px solid rgba(255,255,255,.10);
            backdrop-filter: blur(18px);
            text-align: center;
            transition: .35s;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            border-color: rgba(56,189,248,.35);
            box-shadow: 0 20px 45px rgba(0,0,0,.25);
        }

        .stat-card h3 {
            font-size: 30px;
            color: #7dd3fc;
            margin-bottom: 6px;
        }

        .stat-card p {
            color: #cbd5e1;
            font-size: 14px;
        }

        .section-grid {
            margin-top: 34px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .card {
            padding: 30px;
            border-radius: 30px;
            background: rgba(15,23,42,.55);
            border: 1px solid rgba(255,255,255,.10);
            backdrop-filter: blur(20px);
            transition: .35s;
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(56,189,248,.12);
            border-radius: 50%;
            right: -45px;
            top: -45px;
            filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-10px);
            border-color: rgba(56,189,248,.35);
            background: rgba(30,41,59,.75);
        }

        .card-icon {
            width: 62px;
            height: 62px;
            border-radius: 20px;
            background: linear-gradient(135deg, #38bdf8, #2563eb);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 20px;
            box-shadow: 0 14px 30px rgba(37,99,235,.25);
        }

        .card h3 {
            font-size: 23px;
            margin-bottom: 12px;
        }

        .card p {
            color: #cbd5e1;
            line-height: 1.7;
        }

        .skills-section {
            margin-top: 34px;
            padding: 32px;
            border-radius: 32px;
            background: rgba(15,23,42,.58);
            border: 1px solid rgba(255,255,255,.10);
            backdrop-filter: blur(20px);
        }

        .skills-section h2 {
            text-align: center;
            font-size: 34px;
            margin-bottom: 28px;
        }

        .skills {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .skill {
            background: rgba(255,255,255,.07);
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 20px;
            padding: 18px;
        }

        .skill-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: 900;
        }

        .bar {
            width: 100%;
            height: 12px;
            background: rgba(255,255,255,.10);
            border-radius: 999px;
            overflow: hidden;
        }

        .bar span {
            display: block;
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #38bdf8, #2563eb);
            animation: loadBar 2s ease forwards;
        }

        @keyframes loadBar {
            from { width: 0; }
        }

        .footer-mini {
            margin-top: 34px;
            text-align: center;
            color: #94a3b8;
            padding-bottom: 20px;
        }

        @media(max-width: 900px) {
            .hero h1 {
                font-size: 40px;
            }

            .photo-core {
                width: 240px;
                height: 240px;
            }

            .stats,
            .section-grid,
            .skills {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 45px 22px;
            }
        }
    </style>
</head>

<body>
    @include('header')
    <div class="grid-bg"></div>

    <main class="page">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <div class="container">

            <section class="hero">
                <div class="photo-wrapper">
    <div class="photo-core">

        <div class="photo-border"></div>

        <img
            src="{{ asset('images/zaki.jpg') }}"
            alt="Irham Ghoffar Muzakki">

    </div>
</div>

                <div class="badge">
                    <span></span>
                    <!-- Cyber Hero Developer • MindCare System -->
                </div>

                <h1>
                    IRHAM GHOFFAR <br>
                    <span class="gradient-text">MUZAKKI</span>
                </h1>

                <p class="subtitle">
                    Mahasiswa S1 Informatika Universitas Muhammadiyah Semarang yang mengembangkan
                    MindCare sebagai sistem deteksi dini kesehatan mental berbasis screening,
                    K-Means Clustering, dan rekomendasi tindak lanjut.
                </p>

                <div class="hero-actions">
                    <a href="{{ url('/edukasi') }}" class="btn btn-primary">
                        Explore MindCare
                    </a>

                    <a href="{{ url('/artikel') }}" class="btn btn-secondary">
                        Artikel Edukasi
                    </a>
                </div>
            </section>

            <section class="stats">
                <div class="stat-card">
                    <h3>Laravel</h3>
                    <p>Framework Utama</p>
                </div>

                <div class="stat-card">
                    <h3>K-Means</h3>
                    <p>Metode Clustering</p>
                </div>

                <div class="stat-card">
                    <h3>MySQL</h3>
                    <p>Database System</p>
                </div>

                <div class="stat-card">
                    <h3>2026</h3>
                    <p>Research Project</p>
                </div>
            </section>

            <section class="section-grid">
                <div class="card">
                    <div class="card-icon">🤖</div>
                    <h3>Transformer Concept</h3>
                    <p>
                        Mengusung nuansa teknologi futuristik dengan elemen visual seperti sistem AI,
                        grid digital, glow neon, dan panel cyber modern.
                    </p>
                </div>

                <div class="card">
                    <div class="card-icon">⚡</div>
                    <h3>Super Hero Energy</h3>
                    <p>
                        Tampilan dibuat kuat, dinamis, dan percaya diri seperti karakter hero teknologi
                        dengan animasi cahaya dan energi visual.
                    </p>
                </div>

                <div class="card">
                    <div class="card-icon">🧠</div>
                    <h3>MindCare Project</h3>
                    <p>
                        Sistem ini dikembangkan untuk membantu screening kesehatan mental melalui
                        analisis data dan rekomendasi tindak lanjut.
                    </p>
                </div>
            </section>

            <section class="skills-section">
                <h2>Power Skill System</h2>

                <div class="skills">
                    <div class="skill">
                        <div class="skill-top">
                            <span>Laravel Development</span>
                            <span>95%</span>
                        </div>
                        <div class="bar"><span style="width:95%"></span></div>
                    </div>

                    <div class="skill">
                        <div class="skill-top">
                            <span>PHP & MySQL</span>
                            <span>90%</span>
                        </div>
                        <div class="bar"><span style="width:90%"></span></div>
                    </div>

                    <div class="skill">
                        <div class="skill-top">
                            <span>Data Mining</span>
                            <span>88%</span>
                        </div>
                        <div class="bar"><span style="width:88%"></span></div>
                    </div>

                    <div class="skill">
                        <div class="skill-top">
                            <span>K-Means Clustering</span>
                            <span>92%</span>
                        </div>
                        <div class="bar"><span style="width:92%"></span></div>
                    </div>
                </div>
            </section>

            <div class="footer-mini">
                © {{ date('Y') }} MindCare — Developed by Irham Ghoffar Muzakki
            </div>
        </div>
    </main>
</body>
</html>