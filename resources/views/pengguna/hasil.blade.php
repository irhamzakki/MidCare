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
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900 mb-2 tracking-tight">Hasil Screening Kesehatan Mental</h1>
                <p class="text-slate-500 text-sm">Lihat riwayat hasil screening Anda dan kategori risiko yang teridentifikasi oleh model K-Means.</p>
            </div>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="mb-6 rounded-3xl bg-emerald-50 border border-emerald-200 p-5 text-emerald-900 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Jika ada hasil terbaru -->
            @if($recentResult)
                <!-- Hasil Terbaru -->
                <div class="rounded-3xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 p-8 mb-10 shadow-sm">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Hasil Terbaru</p>
                            <h2 class="text-2xl font-bold text-slate-900 mt-2">Screening {{ $recentResult->created_at->format('d M Y') }}</h2>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-semibold text-slate-500 uppercase">Tingkat Risiko</p>
                            @php
                                $riskColor = match($recentResult->tingkat_risiko) {
                                    'Risiko Rendah' => 'emerald',
                                    'Risiko Sedang' => 'amber',
                                    'Risiko Tinggi' => 'rose',
                                    default => 'slate'
                                };
                            @endphp
                            <p class="text-2xl font-bold text-{{ $riskColor }}-600 mt-2">{{ $recentResult->tingkat_risiko }}</p>
                        </div>
                    </div>

                    <!-- Fitur Data -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white rounded-2xl p-4 border border-slate-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase">Nama</p>
                            <p class="text-lg font-bold text-slate-900 mt-1">{{ $recentResult->fiturPengguna->nama }}</p>
                        </div>
                        <div class="bg-white rounded-2xl p-4 border border-slate-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase">Usia</p>
                            <p class="text-lg font-bold text-slate-900 mt-1">{{ $recentResult->fiturPengguna->usia }} tahun</p>
                        </div>
                        <div class="bg-white rounded-2xl p-4 border border-slate-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase">Jenis Kelamin</p>
                            <p class="text-lg font-bold text-slate-900 mt-1">{{ $recentResult->fiturPengguna->jenis_kelamin }}</p>
                        </div>
                        <div class="bg-white rounded-2xl p-4 border border-slate-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase">Cluster</p>
                            <p class="text-lg font-bold text-slate-900 mt-1">{{ $recentResult->cluster }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('pengguna.hasil.show', $recentResult->id) }}" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-500 transition">
                            Lihat Detail Lengkap
                        </a>
                    </div>
                </div>

                <!-- Riwayat Screening -->
                @if($hasil->count() > 1)
                    <div class="rounded-3xl bg-white border border-slate-200 p-8 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 mb-6">Riwayat Screening</h3>
                        <div class="space-y-3">
                            @foreach($hasil as $item)
                                <a href="{{ route('pengguna.hasil.show', $item->id) }}" class="block p-4 rounded-2xl border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $item->created_at->format('d F Y H:i') }}</p>
                                            <p class="text-sm text-slate-600 mt-1">{{ $item->fiturPengguna->nama }} • Cluster {{ $item->cluster }}</p>
                                        </div>
                                        <div class="text-right">
                                            @php
                                                $riskBadgeColor = match($item->tingkat_risiko) {
                                                    'Kondisi Baik / Risiko Rendah' => 'bg-emerald-100 text-emerald-700',
                                                    'Risiko Moderat' => 'bg-amber-100 text-amber-700',
                                                    'Risiko Tinggi / Perlu Perhatian' => 'bg-rose-100 text-rose-700',
                                                    default => 'bg-slate-100 text-slate-700'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center rounded-full {{ $riskBadgeColor }} px-3 py-1 text-xs font-semibold">
                                                {{ $item->tingkat_risiko }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <!-- Jika belum ada hasil -->
                <div class="rounded-3xl bg-white border border-slate-200 p-12 text-center shadow-sm">
                    <div class="mb-6">
                        <svg class="w-20 h-20 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Belum Ada Hasil Screening</h3>
                    <p class="text-slate-600 mb-6">Anda belum melakukan screening kesehatan mental. Silakan isi kuesioner untuk mendapatkan hasil yang akurat.</p>
                    <a href="{{ route('screening') }}" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow hover:bg-blue-500 transition">
                        Mulai Screening Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>