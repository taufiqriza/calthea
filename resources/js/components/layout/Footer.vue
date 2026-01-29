<script setup>
const currentYear = new Date().getFullYear();
</script>

<template>
  <footer class="bg-coffee-900 text-white pt-12 lg:pt-16 pb-24 lg:pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <!-- Mobile Footer - Compact -->
      <div class="lg:hidden">
        <!-- Brand & Social (Mobile) -->
        <div class="text-center mb-8">
          <div class="flex items-center justify-center gap-3 mb-4">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center overflow-hidden p-0.5">
              <img src="/images/logo-calthea.jpg" alt="Calthea" class="w-full h-full object-cover rounded-full">
            </div>
            <div class="text-left">
              <span class="font-serif text-xl font-bold block">Calthea</span>
              <span class="text-coffee-400 text-xs">Cafe & Nature 🌿</span>
            </div>
          </div>
          <p class="text-coffee-400 text-sm mb-4">Open daily from 10 AM • Kota Batu</p>
          
          <!-- Social Icons -->
          <div class="flex justify-center gap-3">
            <a href="https://www.instagram.com/caltheabatu" target="_blank" class="w-11 h-11 bg-gradient-to-br from-pink-500 to-orange-400 rounded-full flex items-center justify-center shadow-lg">
              <i class="fab fa-instagram text-white text-lg"></i>
            </a>
            <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="w-11 h-11 bg-coffee-700 rounded-full flex items-center justify-center">
              <i class="fab fa-whatsapp text-white text-lg"></i>
            </a>
            <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="w-11 h-11 bg-coffee-700 rounded-full flex items-center justify-center">
              <i class="fas fa-map-marker-alt text-white"></i>
            </a>
          </div>
        </div>

        <!-- Quick Info Cards (Mobile) -->
        <div class="grid grid-cols-2 gap-3 mb-6">
          <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="bg-coffee-800/50 rounded-xl p-4 text-center hover:bg-coffee-800 transition">
            <i class="fas fa-map-marker-alt text-coffee-400 text-xl mb-2"></i>
            <p class="text-white text-sm font-medium">Lokasi</p>
            <p class="text-coffee-400 text-xs">Kota Batu</p>
          </a>
          <div class="bg-coffee-800/50 rounded-xl p-4 text-center">
            <div class="flex items-center justify-center gap-1 text-green-400 mb-1">
              <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
              <span class="text-xs font-medium">Open</span>
            </div>
            <p class="text-white text-lg font-bold">10 AM</p>
            <p class="text-coffee-400 text-xs">Daily</p>
          </div>
        </div>

        <!-- Copyright (Mobile) -->
        <div class="text-center pt-4 border-t border-coffee-800">
          <p class="text-coffee-500 text-xs">© {{ currentYear }} Calthea Cafe & Nature</p>
        </div>
      </div>

      <!-- Desktop Footer - Full -->
      <div class="hidden lg:block">
        <div class="grid grid-cols-4 gap-10 mb-12">
          <!-- Brand -->
          <div>
            <div class="flex items-center gap-3 mb-6">
              <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center overflow-hidden p-1">
                <img src="/images/logo-calthea.jpg" alt="Calthea" class="w-full h-full object-cover rounded-full">
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

          <!-- Quick Links -->
          <div>
            <h4 class="font-serif text-lg font-semibold mb-6">Navigasi</h4>
            <ul class="space-y-3">
              <li><a href="/#beranda" class="text-coffee-300 hover:text-white transition">Beranda</a></li>
              <li><a href="/menu" class="text-coffee-300 hover:text-white transition">Menu</a></li>
              <li><a href="/tentang" class="text-coffee-300 hover:text-white transition">Tentang Kami</a></li>
              <li><a href="/galeri" class="text-coffee-300 hover:text-white transition">Galeri</a></li>
              <li><a href="/#ulasan" class="text-coffee-300 hover:text-white transition">Ulasan</a></li>
              <li><a href="/reservasi" class="text-coffee-300 hover:text-white transition">Reservasi</a></li>
            </ul>
          </div>

          <!-- Contact -->
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

          <!-- Hours -->
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

        <!-- Bottom -->
        <div class="border-t border-coffee-800 pt-8">
          <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
            <p class="text-coffee-400 text-sm">© {{ currentYear }} Calthea Cafe & Nature - Kota Batu. Hak Cipta Dilindungi.</p>
            <div class="flex gap-6 text-sm">
              <a href="#" class="text-coffee-400 hover:text-white transition">Kebijakan Privasi</a>
              <a href="#" class="text-coffee-400 hover:text-white transition">Syarat & Ketentuan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
