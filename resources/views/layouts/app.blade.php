<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT Rasa Roti Nusantara - Artisan Bakery & Patisserie')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                        },
                        crust: {
                            500: '#C05621',
                            600: '#9C4221',
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #FAF8F5;
            color: #2D241E;
        }
        .grain-bg {
            background-color: #FAF8F5;
            background-image: radial-gradient(#E8DFC8 0.75px, transparent 0.75px);
            background-size: 16px 16px;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col grain-bg">

    <div class="bg-bakery-900 text-bakery-100 text-xs py-2 px-4 text-center tracking-wide font-medium">
        🍞 <span class="font-semibold text-amber-300">Freshly Baked Every Dawn</span> — Dipanggang segar setiap pagi dengan 100% mentega Prancis & ragi alami tanpa pengawet.
    </div>

    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-bakery-200 transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <a href="{{ route('public.home') }}" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-2xl bg-white p-1 border border-bakery-200 shadow-sm flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo Rasa Roti" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <div class="font-serif text-xl sm:text-2xl font-bold tracking-tight text-bakery-900 leading-tight">
                            Rasa Roti
                        </div>
                        <div class="text-[10px] sm:text-xs font-semibold tracking-widest text-bakery-600 uppercase">
                            Artisan Bakery & Patisserie
                        </div>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-bakery-800">
                    <a href="{{ route('public.home') }}" class="hover:text-bakery-600 transition-colors">Beranda</a>
                    <a href="{{ route('public.home') }}#katalog" class="hover:text-bakery-600 transition-colors">Katalog Produk</a>
                    <a href="{{ route('public.home') }}#tentang-kami" class="hover:text-bakery-600 transition-colors">Tentang Kami</a>
                    <a href="{{ route('public.track') }}" class="hover:text-bakery-600 transition-colors flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-bakery-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Lacak Pesanan
                    </a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="{{ route('public.track') }}" class="md:hidden text-xs text-bakery-700 font-medium px-2.5 py-1.5 rounded-lg border border-bakery-200">
                        Lacak Order
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-bakery-100 hover:bg-bakery-200 text-bakery-900 text-xs sm:text-sm font-semibold transition-all border border-bakery-300">
                        <svg class="w-4 h-4 text-bakery-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Panel Admin</span>
                    </a>
                </div>

            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-lg leading-none">&times;</button>
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-bakery-900 text-bakery-200 mt-20 border-t border-bakery-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-white p-1 shadow-md flex items-center justify-center">
                            <img src="{{ asset('images/logo.svg') }}" alt="Logo Rasa Roti" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <span class="font-serif text-2xl font-bold text-white tracking-tight">Rasa Roti</span>
                            <span class="block text-xs font-semibold tracking-widest text-amber-400 uppercase">Artisan Bakery & Patisserie</span>
                        </div>
                    </div>
                    <p class="text-sm text-bakery-300 leading-relaxed max-w-md">
                        UMKM Bakery & Patisserie artisanal yang menghadirkan roti sourdough fermentasi alami, pastry butter Prancis autentik, dan kue basah pilihan. Dibuat dengan cinta, dedikasi, dan bahan baku lokal berkualitas tinggi.
                    </p>
                    <div class="pt-2 flex items-center gap-4 text-xs text-bakery-400">
                        <span>📍 Senopati, Jakarta Selatan</span>
                        <span>•</span>
                        <span>🕒 Buka: 07.00 - 21.00 WIB</span>
                    </div>
                </div>

                <div>
                    <h3 class="font-serif text-lg font-semibold text-white mb-4">Kategori Produk</h3>
                    <ul class="space-y-2 text-sm text-bakery-300">
                        <li><a href="{{ route('public.home', ['category' => 'sourdough-roti-tawar']) }}" class="hover:text-amber-400 transition-colors">Sourdough & Roti Tawar</a></li>
                        <li><a href="{{ route('public.home', ['category' => 'viennoiserie-pastry']) }}" class="hover:text-amber-400 transition-colors">Viennoiserie & Pastry</a></li>
                        <li><a href="{{ route('public.home', ['category' => 'roti-manis-buns']) }}" class="hover:text-amber-400 transition-colors">Roti Manis & Buns</a></li>
                        <li><a href="{{ route('public.home', ['category' => 'cakes-tart']) }}" class="hover:text-amber-400 transition-colors">Cakes & Tart</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-serif text-lg font-semibold text-white mb-4">Keunggulan Roti</h3>
                    <div class="space-y-2 text-xs text-bakery-300 leading-relaxed">
                        <p>✓ 100% Ragi Sourdough Alami 24 Jam</p>
                        <p>✓ Mentega Murni AOP Prancis</p>
                        <p>✓ Tanpa Pemutih, Pengawet & Pengembang Sintetis</p>
                        <p>✓ Dipanggang Hangat Setiap Subuh</p>
                    </div>
                </div>

            </div>

            <div class="border-t border-bakery-800 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-bakery-400 gap-4">
                <p>&copy; {{ date('Y') }} PT Rasa Roti Nusantara. Seluruh Hak Cipta Dilindungi.</p>
                <p class="text-bakery-400">Freshly Baked Artisan Bakery & Patisserie.</p>
            </div>
        </div>
    </footer>

</body>
</html>
