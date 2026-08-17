<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-slate-950 px-4 py-10 relative overflow-hidden text-slate-100">

    <div class="relative w-full max-w-lg animate-[fadeIn_0.8s_ease-out]">

        <div class="text-center mb-6">
            <div class="mx-auto w-20 h-20 rounded-full bg-slate-900 border border-slate-700/60 flex items-center justify-center shadow-lg shadow-indigo-500/10 transition-transform duration-300 hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-10 h-10 text-indigo-400"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5.121 17.804A9 9 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0zm-3 5c-2.67 0-8 1.34-8 4v1h16v-1c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>

            <h1 class="mt-5 text-3xl font-bold tracking-tight text-white">
                MindCare
            </h1>

            <p class="mt-2 text-sm text-slate-400">
                Daftar untuk menggunakan sistem deteksi kesehatan mental.
            </p>
        </div>

        <div class="bg-slate-900/80 backdrop-blur-xl rounded-3xl border border-slate-800 shadow-2xl p-8 transition-all duration-300 hover:border-slate-700">

            <div class="flex items-center gap-2 mb-6 text-sm font-medium text-indigo-400">
                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500 -ml-4"></span>
                Buat akun baru dengan langkah yang sederhana
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" class="font-semibold text-slate-200 text-sm mb-1.5 block"/>

                    <x-text-input
                        id="name"
                        class="block w-full rounded-xl border-slate-800 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:ring-2 focus:ring-indigo-500/20"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap"/>

                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" class="font-semibold text-slate-200 text-sm mb-1.5 block"/>

                    <x-text-input
                        id="email"
                        class="block w-full rounded-xl border-slate-800 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:ring-2 focus:ring-indigo-500/20"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        placeholder="Masukkan email"/>

                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="role" :value="__('Daftar Sebagai')" class="font-semibold text-slate-200 text-sm mb-1.5 block"/>

                    <select
                        id="role"
                        name="role"
                        class="block w-full rounded-xl border-slate-800 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:ring-2 focus:ring-indigo-500/20"
                        required>
                        <option value="pasien" {{ old('role') === 'pasien' ? 'selected' : '' }}>Pasien</option>
                        <option value="psikolog" {{ old('role') === 'psikolog' ? 'selected' : '' }}>Psikolog</option>
                    </select>

                    <x-input-error :messages="$errors->get('role')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" class="font-semibold text-slate-200 text-sm mb-1.5 block"/>

                    <x-text-input
                        id="password"
                        class="block w-full rounded-xl border-slate-800 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:ring-2 focus:ring-indigo-500/20"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Masukkan password"/>

                    <p class="mt-1.5 text-xs text-slate-400">Gunakan kombinasi huruf, angka, dan simbol agar lebih aman.</p>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div>
                    <x-input-label for="password_confirmation"
                                   :value="__('Konfirmasi Password')"
                                   class="font-semibold text-slate-200 text-sm mb-1.5 block"/>

                    <x-text-input
                        id="password_confirmation"
                        class="block w-full rounded-xl border-slate-800 bg-slate-950/60 px-4 py-3 text-sm text-slate-100 placeholder-slate-500 transition-all duration-200 focus:border-indigo-500 focus:bg-slate-950 focus:ring-2 focus:ring-indigo-500/20"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi password"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <button
                    type="submit"
                    class="w-full py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 transition-all duration-200 text-white font-semibold text-sm shadow-lg shadow-indigo-600/25 active:scale-[0.99] mt-2">

                    {{ __('Daftar Sekarang') }}

                </button>

                <div class="pt-2 text-center">

                    <a href="{{ route('login') }}"
                       class="text-sm text-slate-400 transition-colors duration-200 hover:text-slate-200">

                        Sudah memiliki akun?

                        <span class="font-semibold text-indigo-400 hover:text-indigo-300 ml-1">
                            Masuk di sini
                        </span>

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</x-guest-layout>