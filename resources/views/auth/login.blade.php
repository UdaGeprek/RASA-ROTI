<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PT Rasa Roti Nusantara</title>
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
            background-image: radial-gradient(#E8DFC8 0.75px, transparent 0.75px);
            background-size: 16px 16px;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex items-center justify-center p-4 sm:p-6 text-bakery-900">

    <div class="w-full max-w-md space-y-6">
        
        <div class="text-center space-y-3">
            <a href="{{ route('public.home') }}" class="inline-block group transition-transform duration-300 hover:scale-105">
                <div class="w-24 h-24 mx-auto rounded-2xl bg-white p-2.5 shadow-xl border-2 border-bakery-300 flex items-center justify-center">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo PT Rasa Roti Nusantara" class="w-full h-full object-contain">
                </div>
            </a>
            <div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-bakery-900">Panel Pengelola Toko</h1>
                <p class="text-xs text-bakery-600 font-medium mt-1">PT Rasa Roti Nusantara • Artisan Bakery & Patisserie</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-bakery-200 shadow-xl p-6 sm:p-8 space-y-6">
            
            <div class="p-4 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/80 shadow-sm space-y-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-base">⚡</span>
                        <span class="text-xs font-bold text-amber-950 uppercase tracking-wider">Akses Uji Coba Cepat</span>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-400 text-bakery-950">
                        Demo Akun
                    </span>
                </div>
                <p class="text-[11px] text-amber-900/80 leading-relaxed">
                    Klik tombol di bawah ini untuk mengisi formulir login secara otomatis menggunakan kredensial akun demo:
                </p>
                <button type="button" id="btn-fill-demo" class="w-full py-2.5 px-3 bg-amber-400 hover:bg-amber-300 active:scale-[0.99] text-bakery-950 text-xs font-bold rounded-xl transition-all shadow-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-bakery-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    <span>Gunakan Demo Akun (admin@rasaroti.com)</span>
                </button>
                <div id="demo-badge" class="hidden text-center text-[11px] font-bold text-emerald-700 bg-emerald-100/80 py-1 rounded-lg transition-all">
                    ✓ Kredensial akun demo berhasil diisi!
                </div>
            </div>

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
                    @foreach($errors->all() as $err)
                        <div class="flex items-center gap-1.5">
                            <span>✕</span>
                            <span>{{ $err }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-1.5 font-medium">
                    <span>✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-bakery-800 mb-1">
                        Alamat Email / Username Admin *
                    </label>
                    <div class="relative">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="admin@rasaroti.com" class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm bg-bakery-50 border border-bakery-300 rounded-xl focus:ring-2 focus:ring-bakery-500 focus:outline-none transition-all">
                        <svg class="w-4 h-4 text-bakery-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-xs font-bold text-bakery-800">
                            Kata Sandi (Password) *
                        </label>
                        <span class="text-[10px] text-bakery-500">Demo: <code>admin123</code></span>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="password" required placeholder="••••••••" class="w-full pl-10 pr-10 py-2.5 text-xs sm:text-sm bg-bakery-50 border border-bakery-300 rounded-xl focus:ring-2 focus:ring-bakery-500 focus:outline-none transition-all">
                        <svg class="w-4 h-4 text-bakery-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <button type="button" onclick="togglePassword()" class="absolute right-3.5 top-3 text-bakery-400 hover:text-bakery-700 text-xs focus:outline-none" title="Lihat/Sembunyikan Sandi">
                            👁️
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-amber-600 border-bakery-300 rounded focus:ring-amber-500">
                        <span class="text-xs text-bakery-700 font-medium">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 bg-bakery-900 hover:bg-bakery-800 text-amber-300 font-bold text-sm rounded-xl transition-all shadow-lg shadow-bakery-900/10 flex items-center justify-center gap-2">
                    <span>Masuk ke Dashboard Admin</span>
                    <span>&rarr;</span>
                </button>

            </form>

        </div>

        <div class="text-center">
            <a href="{{ route('public.home') }}" class="text-xs font-semibold text-bakery-700 hover:text-bakery-900 transition-colors inline-flex items-center gap-1.5">
                <span>&larr;</span>
                <span>Kembali ke Katalog Toko Publik</span>
            </a>
        </div>

    </div>

    <script>
        document.getElementById('btn-fill-demo').addEventListener('click', function () {
            const emailInput = document.getElementById('email');
            const passInput = document.getElementById('password');
            const badge = document.getElementById('demo-badge');

            emailInput.value = 'admin@rasaroti.com';
            passInput.value = 'admin123';

            // Visual feedback highlight
            emailInput.classList.add('ring-2', 'ring-amber-400', 'bg-amber-50');
            passInput.classList.add('ring-2', 'ring-amber-400', 'bg-amber-50');

            setTimeout(() => {
                emailInput.classList.remove('ring-2', 'ring-amber-400', 'bg-amber-50');
                passInput.classList.remove('ring-2', 'ring-amber-400', 'bg-amber-50');
            }, 1200);

            badge.classList.remove('hidden');
        });

        function togglePassword() {
            const input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>

</body>
</html>
