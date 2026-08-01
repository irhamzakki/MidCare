<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl p-10">
            <h1 class="text-3xl font-bold text-slate-900 mb-4">Hasil Screening</h1>
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-5 text-emerald-900">{{ session('success') }}</div>
            @endif
            <p class="text-slate-600 mb-6">Halaman hasil hanya dapat diakses oleh pengguna yang sudah login. Jika Anda belum melihat hasil rinci, silakan lakukan screening dan pastikan Anda masuk ke akun.</p>
            <div class="rounded-2xl bg-slate-100 p-6 text-slate-700">
                Mohon maaf, detail hasil belum tersedia karena data screening belum dihubungkan ke profil pengguna.
                Sementara ini, Anda dapat kembali ke <a href="{{ url('/screening') }}" class="text-blue-600 underline">halaman screening</a> untuk mengisi ulang atau melihat langkah berikutnya.
            </div>
        </div>
    </div>
</x-app-layout>
