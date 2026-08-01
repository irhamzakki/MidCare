<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Komponen Sidebar Samping -->
        @include('layouts.navigation')

        <!-- PAKSA MARGIN KIRI DI SEMUA UKURAN LAYAR -->
        <div class="ml-[280px] transition-all duration-300">
            
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
            
        </div>
    </div>
</body>