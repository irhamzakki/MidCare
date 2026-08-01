<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-16">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl p-10">
            <h1 class="text-3xl font-bold text-slate-900 mb-4">Kuesioner Pengguna</h1>
            <p class="text-slate-600 mb-6">Halaman ini dapat menampilkan ringkasan pengisian kuesioner Anda. Untuk melakukan screening, silakan kembali ke halaman <a href="{{ url('/screening') }}" class="text-blue-600 underline">Screening</a>.</p>
            <div class="rounded-2xl bg-slate-100 p-6 text-slate-700">
                Data rinci akan tersedia setelah Anda melakukan screening dan login menggunakan akun Anda.
            </div>
        </div>
    </div>
</x-app-layout>
