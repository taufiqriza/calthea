<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>{{ $title ?? 'Beranda' }} - Calthea Cafe & Nature</title>
    <meta name="description" content="Calthea Cafe & Nature - Kafe dengan nuansa alam di Kota Batu. Open daily from 10 AM.">
    
    <link rel="icon" type="image/png" href="{{ asset('images/logo-calthea.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        coffee: {
                            50: '#faf6f3',
                            100: '#f5ede5',
                            200: '#e8d5c4',
                            300: '#d9b89c',
                            400: '#c49a76',
                            500: '#b17f56',
                            600: '#8b5a2b',
                            700: '#6f4a25',
                            800: '#5c3d21',
                            900: '#4a311b',
                            950: '#3d2715'
                        },
                        cream: {
                            50: '#fefdfb',
                            100: '#fdf9f3',
                            200: '#faf3e8',
                            300: '#f5e9d8',
                            400: '#eddcc3',
                            500: '#e3cbaa'
                        },
                        beige: {
                            50: '#faf8f5',
                            100: '#f5f1eb',
                            200: '#ebe3d7',
                            300: '#ddd0bc',
                            400: '#c9b599',
                            500: '#b59b7a'
                        }
                    },
                    fontFamily: {
                        'serif': ['Playfair Display', 'Georgia', 'serif'],
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .glass-dark {
            background: rgba(93, 64, 55, 0.9);
            backdrop-filter: blur(20px);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f5f1eb; }
        ::-webkit-scrollbar-thumb { background: #c49a76; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #8b5a2b; }
        
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease forwards; }
        
        /* Mobile Bottom Nav Padding */
        .main-content { padding-bottom: 5rem; }
        @media (min-width: 1024px) { .main-content { padding-bottom: 0; } }
        
        /* Safe area for iOS */
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
        
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-cream-50 text-coffee-900 antialiased">

    {{-- Desktop Header --}}
    <header class="hidden lg:block fixed top-0 left-0 right-0 z-50 transition-all duration-500" 
        x-data="{ scrolled: false }"
        @scroll.window="scrolled = window.scrollY > 50"
        :class="scrolled ? 'glass shadow-xl shadow-coffee-200/20 py-2' : 'bg-transparent py-4'">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between">
                {{-- Logo --}}
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg shadow-coffee-500/20 group-hover:shadow-xl group-hover:shadow-coffee-500/30 transition-all duration-300 group-hover:scale-105 overflow-hidden">
                        <img src="{{ asset('images/logo-calthea.jpg') }}" alt="Calthea" class="w-10 h-10 object-contain">
                    </div>
                    <div>
                        <span class="font-serif text-2xl font-bold text-coffee-800 block leading-tight">Calthea</span>
                        <span class="text-xs text-coffee-500 font-medium tracking-wider">Cafe & Nature 🌿</span>
                    </div>
                </a>

                {{-- Nav --}}
                <nav class="flex items-center bg-white/60 backdrop-blur-md rounded-full px-2 py-2 shadow-lg shadow-coffee-100/50 border border-white/50">
                    <a href="#beranda" class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300">
                        <i class="fas fa-home text-sm opacity-70 group-hover:opacity-100"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="#menu" class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300">
                        <i class="fas fa-coffee text-sm opacity-70 group-hover:opacity-100"></i>
                        <span>Menu</span>
                    </a>
                    <a href="#tentang" class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300">
                        <i class="fas fa-heart text-sm opacity-70 group-hover:opacity-100"></i>
                        <span>Tentang</span>
                    </a>
                    <a href="#ulasan" class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300">
                        <i class="fas fa-star text-sm opacity-70 group-hover:opacity-100"></i>
                        <span>Ulasan</span>
                    </a>
                    <a href="#reservasi" class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300">
                        <i class="fas fa-calendar-check text-sm opacity-70 group-hover:opacity-100"></i>
                        <span>Reservasi</span>
                    </a>
                </nav>

                {{-- CTA Buttons --}}
                <div class="flex items-center gap-3">
                    <a href="tel:+621234567890" class="w-12 h-12 bg-coffee-100 hover:bg-coffee-200 rounded-xl flex items-center justify-center text-coffee-600 transition-all duration-300 hover:scale-105">
                        <i class="fas fa-phone"></i>
                    </a>
                    <a href="#pesan" class="group px-6 py-3 bg-gradient-to-r from-coffee-600 to-coffee-700 text-white font-semibold rounded-xl hover:from-coffee-700 hover:to-coffee-800 hover:shadow-xl hover:shadow-coffee-600/40 transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                        <i class="fas fa-shopping-bag group-hover:animate-bounce"></i>
                        <span>Pesan Sekarang</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Mobile Header --}}
    <header class="lg:hidden fixed top-0 left-0 right-0 z-50 glass shadow-lg">
        <div class="flex items-center justify-between h-16 px-4">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow">
                    <img src="{{ asset('images/logo-calthea.jpg') }}" alt="Calthea" class="w-8 h-8 object-contain">
                </div>
                <div>
                    <span class="font-serif text-lg font-bold text-coffee-800 block leading-tight">Calthea</span>
                    <span class="text-xs text-coffee-500">Cafe & Nature</span>
                </div>
            </a>
            <a href="https://www.instagram.com/caltheabatu" target="_blank" class="w-10 h-10 bg-gradient-to-br from-pink-500 to-orange-400 rounded-full flex items-center justify-center text-white shadow">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="main-content">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-coffee-900 text-white pt-16 pb-8 lg:pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('images/logo-calthea.jpg') }}" alt="Calthea" class="w-12 h-12 object-contain">
                        </div>
                        <div>
                            <span class="font-serif text-2xl font-bold block">Calthea</span>
                            <span class="text-coffee-400 text-sm">Cafe & Nature 🌿</span>
                        </div>
                    </div>
                    <p class="text-coffee-300 text-sm leading-relaxed mb-6">
                        Nikmati kopi premium dengan nuansa alam yang menenangkan di Kota Batu. Open daily from 10 AM.
                    </p>
                    <div class="flex gap-3">
                        <a href="https://www.instagram.com/caltheabatu" target="_blank" class="w-10 h-10 bg-gradient-to-br from-pink-500 to-orange-400 hover:from-pink-600 hover:to-orange-500 rounded-full flex items-center justify-center transition shadow-lg">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-10 h-10 bg-coffee-700 hover:bg-coffee-600 rounded-full flex items-center justify-center transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="w-10 h-10 bg-coffee-700 hover:bg-coffee-600 rounded-full flex items-center justify-center transition">
                            <i class="fas fa-map-marker-alt"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-serif text-lg font-semibold mb-6">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="#beranda" class="text-coffee-300 hover:text-white transition">Beranda</a></li>
                        <li><a href="#menu" class="text-coffee-300 hover:text-white transition">Menu</a></li>
                        <li><a href="#tentang" class="text-coffee-300 hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#ulasan" class="text-coffee-300 hover:text-white transition">Ulasan</a></li>
                        <li><a href="#reservasi" class="text-coffee-300 hover:text-white transition">Reservasi</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="font-serif text-lg font-semibold mb-6">Kontak</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-coffee-500 mt-1"></i>
                            <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="text-coffee-300 text-sm hover:text-white transition">Jl. Arjuno Atas No.99, Dsn. Tlogorejo,<br>Bumiaji, Kota Batu, Jawa Timur 65331</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fab fa-whatsapp text-coffee-500"></i>
                            <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="text-coffee-300 text-sm hover:text-white transition">Chat via WhatsApp</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fab fa-instagram text-coffee-500"></i>
                            <a href="https://www.instagram.com/caltheabatu" target="_blank" class="text-coffee-300 text-sm hover:text-white transition">@caltheabatu</a>
                        </li>
                    </ul>
                </div>

                {{-- Hours --}}
                <div>
                    <h4 class="font-serif text-lg font-semibold mb-6">Jam Operasional</h4>
                    <div class="bg-coffee-800 rounded-2xl p-4 mb-4">
                        <div class="flex items-center gap-2 text-green-400 mb-2">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            <span class="font-semibold">Open Daily</span>
                        </div>
                        <p class="text-3xl font-bold text-white">10:00 AM</p>
                        <p class="text-coffee-400 text-sm">sampai selesai</p>
                    </div>
                    <p class="text-coffee-400 text-sm italic">🌿 Cafe & Nature experience</p>
                </div>
            </div>

            {{-- Bottom --}}
            <div class="border-t border-coffee-800 pt-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
                    <p class="text-coffee-400 text-sm">© {{ date('Y') }} Calthea Cafe & Nature - Kota Batu. Hak Cipta Dilindungi.</p>
                    <div class="flex gap-6 text-sm">
                        <a href="#" class="text-coffee-400 hover:text-white transition">Kebijakan Privasi</a>
                        <a href="#" class="text-coffee-400 hover:text-white transition">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Mobile Bottom Navigation --}}
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 glass-dark safe-area-bottom">
        <div class="flex items-center justify-around h-16">
            <a href="#beranda" class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition">
                <i class="fas fa-home text-lg"></i>
                <span class="text-xs">Beranda</span>
            </a>
            <a href="#menu" class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition">
                <i class="fas fa-coffee text-lg"></i>
                <span class="text-xs">Menu</span>
            </a>
            <a href="#pesan" class="flex flex-col items-center gap-1 -mt-6">
                <div class="w-14 h-14 bg-coffee-500 rounded-full flex items-center justify-center shadow-lg shadow-coffee-500/50 border-4 border-coffee-900">
                    <i class="fas fa-shopping-bag text-white text-lg"></i>
                </div>
                <span class="text-xs text-white mt-1">Pesan</span>
            </a>
            <a href="#ulasan" class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition">
                <i class="fas fa-star text-lg"></i>
                <span class="text-xs">Ulasan</span>
            </a>
            <a href="#reservasi" class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition">
                <i class="fas fa-calendar text-lg"></i>
                <span class="text-xs">Reservasi</span>
            </a>
        </div>
    </nav>

    {{-- WhatsApp Floating Button --}}
    <div x-data="{ showGreeting: false, hasShown: false }" 
         x-init="setTimeout(() => { if(!hasShown) { showGreeting = true; hasShown = true; } }, 3000)"
         class="fixed z-50 lg:bottom-8 lg:right-8 bottom-24 right-4">
        
        {{-- Greeting Modal --}}
        <div x-show="showGreeting" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="absolute bottom-full right-0 mb-4 w-72 bg-white rounded-2xl shadow-2xl shadow-coffee-300/30 p-5 border border-coffee-100"
             x-cloak>
            <button @click="showGreeting = false" class="absolute top-3 right-3 w-6 h-6 text-coffee-400 hover:text-coffee-600 transition">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex items-center gap-3 mb-3">
                <img src="{{ asset('images/logo-calthea.jpg') }}" alt="Calthea" class="w-12 h-12 rounded-full object-cover border-2 border-coffee-200">
                <div>
                    <p class="font-semibold text-coffee-800">Calthea Cafe</p>
                    <p class="text-xs text-coffee-500">Biasanya membalas dalam 1 jam</p>
                </div>
            </div>
            <div class="bg-coffee-50 rounded-xl p-3 mb-4">
                <p class="text-sm text-coffee-700">Halo! 👋 Ada yang bisa kami bantu? Silakan chat untuk reservasi atau info menu.</p>
            </div>
            <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" 
               class="flex items-center justify-center gap-2 w-full py-3 bg-coffee-600 hover:bg-coffee-700 text-white font-semibold rounded-xl transition-all duration-300">
                <i class="fab fa-whatsapp text-lg"></i>
                Mulai Chat
            </a>
        </div>
        
        {{-- Floating Button --}}
        <button @click="showGreeting = !showGreeting" 
                class="group w-16 h-16 bg-gradient-to-br from-coffee-500 to-coffee-700 hover:from-coffee-600 hover:to-coffee-800 rounded-full flex items-center justify-center shadow-xl shadow-coffee-500/40 hover:shadow-2xl hover:shadow-coffee-500/50 transition-all duration-300 hover:scale-110">
            <i class="fab fa-whatsapp text-white text-3xl group-hover:scale-110 transition-transform"></i>
        </button>
        
        {{-- Pulse Animation --}}
        <span class="absolute top-0 right-0 w-4 h-4">
            <span class="absolute inline-flex h-full w-full rounded-full bg-coffee-400 opacity-75 animate-ping"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-coffee-500"></span>
        </span>
    </div>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
