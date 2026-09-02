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
                @php
                    $role = Auth::user()->role ?? '';
                    $backUrl = match($role) {
                        'admin' => route('admin.kuesioner.index'),
                        'psikolog' => route('psikolog.dashboard'),
                        'pasien' => route('pengguna.hasil'),
                        default => url()->previous(),
                    };
                @endphp
                <a href="{{ $backUrl }}" class="text-sky-600 hover:text-sky-700 font-semibold mb-3 inline-flex items-center text-sm bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm transition hover:shadow">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900 mt-2 mb-1 tracking-tight">Detail Hasil Screening</h1>
                <p class="text-slate-500 text-sm">Waktu pemeriksaan: {{ optional($hasil->created_at)->format('d F Y H:i') ?? now()->format('d F Y H:i') }}</p>
            </div>

            <!-- Ringkasan Status -->
            <div class="rounded-3xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 p-8 mb-10 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Profil -->
                    <div>
                        <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-6">Profil Responden</p>
                        <div class="space-y-4">
                            <div class="flex justify-between border-b border-blue-100 pb-3">
                                <span class="text-slate-600">Nama</span>
                                <span class="font-semibold text-slate-900">{{ optional($hasil->fiturPengguna)->nama ?? 'Responden' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-blue-100 pb-3">
                                <span class="text-slate-600">Usia</span>
                                <span class="font-semibold text-slate-900">{{ optional($hasil->fiturPengguna)->usia ?? '-' }} tahun</span>
                            </div>
                            <div class="flex justify-between border-b border-blue-100 pb-3">
                                <span class="text-slate-600">Jenis Kelamin</span>
                                <span class="font-semibold text-slate-900">{{ optional($hasil->fiturPengguna)->jenis_kelamin ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-600">Status Orang Tua</span>
                                <span class="font-semibold text-slate-900">{{ optional($hasil->fiturPengguna)->orangtua ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Analisis -->
                    <div>
                        <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-6">Hasil Analisis K-Means</p>
                        <div class="bg-white rounded-2xl p-6 border border-slate-200">
                            <div class="mb-6">
                                <p class="text-xs text-slate-500 font-semibold uppercase">Cluster</p>
                                <p class="text-4xl font-bold text-blue-600 mt-2">{{ $hasil->cluster }}</p>
                            </div>
                            @php
                                $riskColor = match($hasil->tingkat_risiko) {
                                    'Kondisi Baik / Risiko Rendah' => 'emerald',
                                    'Risiko Moderat' => 'amber',
                                    'Risiko Tinggi / Perlu Perhatian' => 'rose',
                                    default => 'slate'
                                };
                                $riskBg = match($hasil->tingkat_risiko) {
                                    'Kondisi Baik / Risiko Rendah' => 'bg-emerald-100',
                                    'Risiko Moderat' => 'bg-amber-100',
                                    'Risiko Tinggi / Perlu Perhatian' => 'bg-rose-100',
                                    default => 'bg-slate-100'
                                };
                            @endphp
                            <div>
                                <p class="text-xs text-slate-500 font-semibold uppercase">Kategori Risiko</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center rounded-full {{ $riskBg }} px-4 py-2 text-sm font-bold text-{{ $riskColor }}-700">
                                        {{ $hasil->tingkat_risiko }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Jawaban per Kategori -->
            <div class="space-y-8">
                @php
                    $kategoris = [
                        'Karakter & Regulasi Emosi' => [
                            'rasional', 'mampu_menyelesaikan_masalah_sendiri', 'mudah_putus_asa', 'emosional',
                            'mengontrol_emosi', 'agresif', 'diam_marah', 'kontrol_fisik', 'emosi_tidak_terkontrol',
                            'fisik_sulit_dikontrol', 'perilaku_baik_situasi_rumit', 'tenang_saat_emosi',
                            'kontrol_diri_saat_emosi', 'kontrol_bicara', 'tingkah_tidak_terkontrol', 'nilai_emosi'
                        ],
                        'Koping & Penerimaan' => [
                            'terima_peristiwa', 'cari_dukungan', 'tidak_terima_peristiwa', 'terima_peristiwa_buruk',
                            'ubah_mindset', 'terima_emosi', 'tidak_malu_menangis', 'tidak_terima_emosi', 'malu_menangis'
                        ],
                        'Hubungan dengan Ayah' => [
                            'ayah_hargai_perasaan', 'ayah_baik', 'ingin_ortu_berbeda', 'ayah_terima_saya',
                            'senang_masukan_ayah', 'percuma_perlihatkan_ayah', 'ayah_tahu_marah', 'malu_bodoh_dengan_ayah',
                            'ayah_hargai_pendapat', 'ayah_percaya_saya', 'tak_mau_merepotkan_ayah', 'ayah_bantu_pahami',
                            'cerita_pada_ayah', 'kurang_perhatian_ayah', 'ayah_dorong_cerita', 'ayah_pahami_saya',
                            'ayah_pahami_marah', 'percaya_ayah', 'ayah_tidak_paham', 'ayah_tidak_bisa_diandalkan', 'ayah_peduli'
                        ],
                        'Hubungan dengan Ibu' => [
                            'ibu_hargai_perasaan', 'ibu_baik', 'ingin_ibu_berbeda', 'ibu_terima_saya',
                            'senang_masukan_ibu', 'percuma_perlihatkan_ibu', 'ibu_tahu_marah', 'malu_bodoh_dengan_ibu',
                            'gundah_dengan_ibu', 'ibu_tahu_sedikit', 'ibu_hargai_pendapat', 'ibu_percaya_saya',
                            'tak_mau_repotkan_ibu', 'ibu_bantu_pahami', 'cerita_ibu', 'marah_dengan_ibu',
                            'kurang_perhatian_ibu', 'ibu_dorong_cerita', 'ibu_pahami_saya', 'ibu_pahami_marah_saya',
                            'percaya_ibu', 'ibu_tidak_paham', 'ibu_tidak_bisa_diandalkan', 'ibu_peduli'
                        ]
                    ];
                    
                    $labelPertanyaan = [
                        'rasional' => 'Saya cenderung menggunakan logika dan berpikir rasional saat mengambil keputusan.',
                        'mampu_menyelesaikan_masalah_sendiri' => 'Saya merasa mampu menyelesaikan masalah saya sendiri.',
                        'mudah_putus_asa' => 'Saya mudah putus asa ketika menghadapi kegagalan.',
                        'emosional' => 'Saya orang yang emosional.',
                        'mengontrol_emosi' => 'Saya mampu mengontrol emosi saya dengan baik.',
                        'agresif' => 'Saya sering bertindak agresif saat marah.',
                        'diam_marah' => 'Saya cenderung diam saat sedang marah.',
                        'kontrol_fisik' => 'Saya bisa mengontrol fisik/tubuh saya saat emosi.',
                        'emosi_tidak_terkontrol' => 'Emosi saya seringkali tidak terkontrol.',
                        'fisik_sulit_dikontrol' => 'Fisik saya sulit dikontrol ketika emosi memuncak.',
                        'perilaku_baik_situasi_rumit' => 'Saya tetap berperilaku baik meskipun dalam situasi rumit.',
                        'tenang_saat_emosi' => 'Saya bisa tetap tenang saat emosi.',
                        'kontrol_diri_saat_emosi' => 'Saya memiliki kontrol diri yang baik saat emosi.',
                        'kontrol_bicara' => 'Saya bisa mengontrol ucapan/bicara saya saat marah.',
                        'tingkah_tidak_terkontrol' => 'Tingkah laku saya tidak terkontrol saat emosi.',
                        'nilai_emosi' => 'Saya menghargai dan menyadari nilai dari emosi yang saya rasakan.',
                        'terima_peristiwa' => 'Saya bisa menerima peristiwa apa pun yang terjadi.',
                        'cari_dukungan' => 'Saya aktif mencari dukungan dari orang lain saat kesulitan.',
                        'tidak_terima_peristiwa' => 'Saya sulit menerima peristiwa yang sudah terjadi.',
                        'terima_peristiwa_buruk' => 'Saya bisa menerima peristiwa buruk dengan lapang dada.',
                        'ubah_mindset' => 'Saya berusaha mengubah mindset/pola pikir menjadi positif saat ada masalah.',
                        'terima_emosi' => 'Saya menerima emosi negatif yang sedang saya rasakan.',
                        'tidak_malu_menangis' => 'Saya tidak malu menangis jika itu membuat saya lega.',
                        'tidak_terima_emosi' => 'Saya menolak atau menekan emosi yang saya rasakan.',
                        'malu_menangis' => 'Saya merasa malu jika harus menangis.',
                        'ayah_hargai_perasaan' => 'Ayah menghargai perasaan saya.',
                        'ayah_baik' => 'Ayah saya adalah orang yang baik.',
                        'ingin_ortu_berbeda' => 'Saya ingin orang tua/Ayah saya berbeda dari sekarang.',
                        'ayah_terima_saya' => 'Ayah menerima saya apa adanya.',
                        'senang_masukan_ayah' => 'Saya senang mendengarkan masukan dari Ayah.',
                        'percuma_perlihatkan_ayah' => 'Rasanya percuma memperlihatkan perasaan saya kepada Ayah.',
                        'ayah_tahu_marah' => 'Ayah tahu dan paham ketika saya sedang marah.',
                        'malu_bodoh_dengan_ayah' => 'Saya malu terlihat bodoh di depan Ayah.',
                        'ayah_hargai_pendapat' => 'Ayah menghargai pendapat atau pendapatan saya.',
                        'ayah_percaya_saya' => 'Ayah percaya kepada kemampuan saya.',
                        'tak_mau_merepotkan_ayah' => 'Saya tidak mau merepotkan Ayah.',
                        'ayah_bantu_pahami' => 'Ayah membantu saya memahami masalah yang saya hadapi.',
                        'cerita_pada_ayah' => 'Saya merasa nyaman bercerita kepada Ayah.',
                        'kurang_perhatian_ayah' => 'Saya merasa kurang perhatian dari Ayah.',
                        'ayah_dorong_cerita' => 'Ayah selalu mendorong saya untuk bercerita.',
                        'ayah_pahami_saya' => 'Ayah memahami keadaan saya.',
                        'ayah_pahami_marah' => 'Ayah memahami alasan mengapa saya marah.',
                        'percaya_ayah' => 'Saya sepenuhnya percaya kepada Ayah.',
                        'ayah_tidak_paham' => 'Ayah tidak paham dengan apa yang saya rasakan.',
                        'ayah_tidak_bisa_diandalkan' => 'Ayah tidak bisa diandalkan saat saya butuh bantuan.',
                        'ayah_peduli' => 'Ayah sangat peduli kepada saya.',
                        'ibu_hargai_perasaan' => 'Ibu menghargai perasaan saya.',
                        'ibu_baik' => 'Ibu saya adalah orang yang baik.',
                        'ingin_ibu_berbeda' => 'Saya ingin Ibu saya berbeda dari sekarang.',
                        'ibu_terima_saya' => 'Ibu menerima saya apa adanya.',
                        'senang_masukan_ibu' => 'Saya senang mendengarkan masukan dari Ibu.',
                        'percuma_perlihatkan_ibu' => 'Rasanya percuma memperlihatkan perasaan saya kepada Ibu.',
                        'ibu_tahu_marah' => 'Ibu tahu dan paham ketika saya sedang marah.',
                        'malu_bodoh_dengan_ibu' => 'Saya malu terlihat bodoh di depan Ibu.',
                        'gundah_dengan_ibu' => 'Saya sering merasa gundah/gelisah terhadap Ibu.',
                        'ibu_tahu_sedikit' => 'Ibu hanya tahu sedikit tentang kehidupan atau masalah saya.',
                        'ibu_hargai_pendapat' => 'Ibu menghargai pendapat saya.',
                        'ibu_percaya_saya' => 'Ibu percaya kepada kemampuan saya.',
                        'tak_mau_repotkan_ibu' => 'Saya tidak mau merepotkan Ibu.',
                        'ibu_bantu_pahami' => 'Ibu membantu saya memahami masalah yang saya hadapi.',
                        'cerita_ibu' => 'Saya merasa nyaman bercerita kepada Ibu.',
                        'marah_dengan_ibu' => 'Saya sering merasa marah terhadap Ibu.',
                        'kurang_perhatian_ibu' => 'Saya merasa kurang perhatian dari Ibu.',
                        'ibu_dorong_cerita' => 'Ibu selalu mendorong saya untuk bercerita.',
                        'ibu_pahami_saya' => 'Ibu memahami keadaan saya.',
                        'ibu_pahami_marah_saya' => 'Ibu memahami alasan mengapa saya marah.',
                        'percaya_ibu' => 'Saya sepenuhnya percaya kepada Ibu.',
                        'ibu_tidak_paham' => 'Ibu tidak paham dengan apa yang saya rasakan.',
                        'ibu_tidak_bisa_diandalkan' => 'Ibu tidak bisa diandalkan saat saya butuh bantuan.',
                        'ibu_peduli' => 'Ibu sangat peduli kepada saya.',
                    ];
                @endphp

                @foreach($kategoris as $kategoriNama => $koloms)
                    <div class="rounded-3xl bg-white border border-slate-200 p-8 shadow-sm">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">{{ $kategoriNama }}</h2>
                        <div class="space-y-4">
                            @foreach($koloms as $kolom)
                                @php
                                    $nilai = $hasil->fiturPengguna->{$kolom};
                                    $labelSkor = match($nilai) {
                                        1 => 'Sangat Tidak Setuju',
                                        2 => 'Tidak Setuju',
                                        3 => 'Netral',
                                        4 => 'Setuju',
                                        5 => 'Sangat Setuju',
                                        default => 'N/A'
                                    };
                                    $colorClass = match($nilai) {
                                        1 => 'bg-rose-100 text-rose-700',
                                        2 => 'bg-orange-100 text-orange-700',
                                        3 => 'bg-slate-100 text-slate-700',
                                        4 => 'bg-cyan-100 text-cyan-700',
                                        5 => 'bg-emerald-100 text-emerald-700',
                                        default => 'bg-slate-100 text-slate-700'
                                    };
                                @endphp
                                <div class="flex items-start gap-4 pb-4 border-b border-slate-100 last:border-0">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center rounded-full {{ $colorClass }} w-12 h-12 font-bold text-sm">
                                            {{ $nilai ?? '—' }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-slate-900 leading-relaxed">{{ $labelPertanyaan[$kolom] ?? ucfirst(str_replace('_', ' ', $kolom)) }}</p>
                                        <p class="text-xs text-slate-500 mt-1">{{ $labelSkor }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Rekomendasi -->
            <div class="mt-10 rounded-3xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900 mb-4">Rekomendasi</h2>
                <div class="bg-white rounded-2xl p-6 border border-blue-100">
                    @php
                        $risiko = $hasil->tingkat_risiko;
                        $rekomendasi = match($risiko) {
                            'Kondisi Baik / Risiko Rendah' => 'Profil Anda menunjukkan kondisi yang baik dan stabil. Tetap jaga keseimbangan emosi dan dukungan sosial Anda. Lanjutkan kebiasaan positif yang Anda miliki.',
                            'Risiko Moderat' => 'Profil Anda menunjukkan beberapa area yang perlu perhatian. Disarankan untuk tetap menjaga kesehatan mental melalui aktivitas positif, berbicara dengan orang terpercaya, dan mempertimbangkan konsultasi dengan profesional jika diperlukan.',
                            'Risiko Tinggi / Perlu Perhatian' => 'Profil Anda menunjukkan beberapa indikasi yang perlu perhatian khusus. Sangat disarankan untuk berkonsultasi dengan tenaga profesional kesehatan mental atau konselor untuk mendapatkan dukungan yang lebih komprehensif.',
                            default => 'Lanjutkan monitoring kesehatan mental Anda secara berkala.'
                        };
                    @endphp
                    <p class="text-slate-700 leading-relaxed">{{ $rekomendasi }}</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-10 flex gap-4 justify-center">
                <a href="{{ route('pengguna.hasil') }}" class="inline-flex items-center justify-center rounded-full bg-slate-200 px-8 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-300 transition">
                    Kembali ke Hasil
                </a>
                <a href="{{ route('screening') }}" class="inline-flex items-center justify-center rounded-full bg-blue-600 px-8 py-3 text-sm font-semibold text-white shadow hover:bg-blue-500 transition">
                    Lakukan Screening Lagi
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
