<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - PT Rasa Roti Nusantara')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bakery: {
                            50: '#FDFBF7',
                            100: '#F7F3EA',
                            200: '#EDE3D2',
                            300: '#DECDB3',
                            500: '#B88648',
                            600: '#9E6D32',
                            700: '#7E5221',
                            800: '#5F3C18',
                            900: '#3D250E',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            aside, header, .no-print {
                display: none !important;
            }
            body {
                background: #ffffff !important;
                color: #000000 !important;
            }
            main {
                padding: 0 !important;
                margin: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-stone-100 text-stone-800 font-sans antialiased min-h-screen flex flex-col md:flex-row">

    <aside class="w-full md:w-64 bg-bakery-900 text-white flex-shrink-0 flex flex-col justify-between border-r border-bakery-800 shadow-xl">
        <div>
            <div class="p-6 border-b border-bakery-800 flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-white p-1 shadow-md flex items-center justify-center flex-shrink-0">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="font-bold text-base tracking-tight block">Panel Manajemen</span>
                    <span class="text-[10px] text-amber-300 tracking-wider uppercase block font-semibold">Rasa Roti Bakery</span>
                </div>
            </div>

            <nav class="p-4 space-y-1.5 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-amber-400 text-bakery-950 font-bold shadow-md' : 'text-bakery-200 hover:bg-bakery-800 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.products.*') ? 'bg-amber-400 text-bakery-950 font-bold shadow-md' : 'text-bakery-200 hover:bg-bakery-800 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Kelola Produk (CRUD)</span>
                </a>

                <a href="{{ route('admin.sales.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.sales.*') ? 'bg-amber-400 text-bakery-950 font-bold shadow-md' : 'text-bakery-200 hover:bg-bakery-800 hover:text-white' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span>Data Penjualan (Orders)</span>
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-bakery-800 space-y-3">
            @auth
                <div class="flex items-center gap-2 px-1 text-xs">
                    <div class="w-8 h-8 rounded-full bg-amber-400 text-bakery-950 font-bold flex items-center justify-center text-xs flex-shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="leading-tight overflow-hidden">
                        <span class="font-bold text-white block truncate">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-amber-300 block truncate">{{ Auth::user()->email }}</span>
                    </div>
                </div>
                
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl bg-rose-950/70 hover:bg-rose-900 text-rose-200 text-xs font-semibold transition-all border border-rose-800/60">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            @endauth

            <a href="{{ route('public.home') }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-bakery-800 hover:bg-bakery-700 text-amber-300 text-xs font-semibold transition-all">
                <span>Kunjungi Toko Publik</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </a>
            <div class="text-[11px] text-bakery-400 text-center">
                PT Rasa Roti Nusantara • 2026
            </div>
        </div>
    </aside>

    <div class="flex-grow flex flex-col min-h-screen">
        
        <header class="bg-white border-b border-stone-200 px-6 py-4 flex items-center justify-between shadow-sm">
            <div>
                <h1 class="text-lg font-bold text-stone-900">@yield('page_title', 'Dashboard')</h1>
                <p class="text-xs text-stone-500">Sistem Informasi Manajemen Katalog & Penjualan UMKM</p>
            </div>

            <div class="flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-semibold text-stone-700">MySQL Database Aktif</span>
            </div>
        </header>

        <div class="p-6 pb-0">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between text-xs sm:text-sm font-medium shadow-sm mb-6">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-xl flex items-center justify-between text-xs sm:text-sm font-medium shadow-sm mb-6">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">&times;</button>
                </div>
            @endif
        </div>

        <main class="p-6 flex-grow">
            @yield('content')
        </main>

    </div>

</body>
</html>
