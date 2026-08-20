<x-app-layout>
    <style>
        .page-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc, #e0f2fe, #eef2ff);
            padding: 24px;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            box-sizing: border-box;
        }
        @media (min-width: 1024px) {
            .page-wrapper {
                padding-left: 296px;
                padding-top: 36px;
                padding-bottom: 36px;
                padding-right: 36px;
            }
        }
        .page-container {
            max-width: 1100px;
            margin: 0 auto;
        }
    </style>

    <div class="page-wrapper">
        <div class="page-container">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 sm:p-10">
                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Riwayat Screening</h1>
                <p class="text-slate-500 mb-6 text-sm">Riwayat screening Anda akan ditampilkan di halaman ini setelah sistem mengaitkan hasil dengan akun Anda.</p>
                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-6 text-slate-600 text-sm">
                    Tidak ada data riwayat yang tersedia saat ini. Pastikan Anda sudah melakukan screening dan login dengan akun Anda.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
