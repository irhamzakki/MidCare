{{-- Footer Portofolio Pembuat --}}
<footer id="kontak" class="bg-slate-950 text-slate-300 py-16 border-t border-slate-800">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <!-- Profil Pembuat -->
            <div>
                <h2 class="text-white text-2xl font-extrabold mb-6">
                    Developer Profile
                </h2>

                <div class="flex items-center gap-4 mb-5">

                    <img
                        src="{{ asset('Images/zaki.jpg') }}"
                        alt="Zaki Profile Picture"
                        class="w-24 h-24 rounded-2xl object-cover border-4 border-cyan-500 shadow-xl"
                    >

                    <div>
                        <h3 class="text-white text-lg font-bold">
                            Irham Ghoffar Muzakki
                        </h3>

                        <p class="text-cyan-400 text-sm font-semibold">
                            Informatics Student | Web Developer
                        </p>
                    </div>

                </div>

                <p class="leading-relaxed text-sm text-slate-400">
                    Mahasiswa S1 Informatika Universitas Muhammadiyah Semarang
                    yang memiliki minat pada bidang Web Development, Data Mining,
                    Machine Learning, Artificial Intelligence, dan Sistem Informasi.
                    Pengembang Website MindCare sebagai sistem deteksi dini
                    kesehatan mental berbasis K-Means Clustering.
                </p>
            </div>

            <!-- Keahlian -->
            <div>
                <h2 class="text-white text-2xl font-extrabold mb-6">
                    Keahlian
                </h2>

                <div class="space-y-3">

                    <div class="bg-slate-900 rounded-xl p-3">
                        💻 Laravel Framework
                    </div>

                    <div class="bg-slate-900 rounded-xl p-3">
                        🎨 Bootstrap & Tailwind CSS
                    </div>

                    <div class="bg-slate-900 rounded-xl p-3">
                        🗄️ MySQL Database
                    </div>

                    <div class="bg-slate-900 rounded-xl p-3">
                        📊 Data Mining & Clustering
                    </div>

                    <div class="bg-slate-900 rounded-xl p-3">
                        🤖 Artificial Intelligence
                    </div>

                </div>
            </div>

            <!-- Tentang Sistem -->
            <div>
                <h2 class="text-white text-2xl font-extrabold mb-6">
                    Tentang MindCare
                </h2>

                <p class="text-slate-400 leading-relaxed mb-5">
                    MindCare merupakan sistem screening kesehatan mental
                    yang membantu pengguna dalam melakukan deteksi dini
                    risiko kesehatan mental melalui kuesioner,
                    analisis clustering K-Means, serta rekomendasi
                    tindak lanjut yang sesuai.
                </p>

                <div class="space-y-2 text-sm">

                    <p>
                        🧠 Mental Health Screening System
                    </p>

                    <p>
                        📊 K-Means Clustering Analysis
                    </p>

                    <p>
                        💬 Psychological Recommendation
                    </p>

                    <p>
                        🎓 Research Project 2026
                    </p>

                </div>
            </div>

        </div>

        <!-- Garis -->
        <div class="border-t border-slate-800 my-10"></div>

        <!-- Copyright -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">

            <div>
                <h3 class="text-white font-bold">
                    MindCare
                </h3>

                <p class="text-sm text-slate-500">
                    Mental Health Screening & Recommendation System
                </p>
            </div>

            <div class="text-center md:text-right">
                <p class="text-sm text-slate-500">
                    © {{ date('Y') }} MindCare. All Rights Reserved.
                </p>

                <p class="text-cyan-400 font-semibold">
                    Developed by Irham Ghoffar Muzakki
                </p>
            </div>

        </div>

    </div>

</footer>   