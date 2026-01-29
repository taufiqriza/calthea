<script setup>
import Navbar from '@components/layout/Navbar.vue';
import Footer from '@components/layout/Footer.vue';
import MobileNav from '@components/layout/MobileNav.vue';
import WhatsAppFloat from '@components/shared/WhatsAppFloat.vue';
</script>

<template>
  <div>
    <Navbar />
    
    <main class="pt-24 pb-32 lg:pb-16 min-h-screen bg-cream-50">
      <!-- Hero Section -->
      <section class="py-12 lg:py-16 bg-gradient-to-br from-coffee-50 to-cream-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
          <span class="inline-block px-4 py-2 bg-coffee-100 text-coffee-600 text-sm font-medium rounded-full mb-4">
            Hubungi Kami
          </span>
          <h1 class="font-serif text-4xl lg:text-5xl font-bold text-coffee-900 mb-4">
            Kontak & Lokasi
          </h1>
          <p class="text-coffee-600 text-lg max-w-2xl mx-auto">
            Kami siap melayani Anda. Hubungi kami atau kunjungi langsung cafe kami.
          </p>
        </div>
      </section>

      <!-- Contact Cards -->
      <section class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
          <div class="grid md:grid-cols-3 gap-6">
            <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="bg-white rounded-3xl p-8 text-center hover:shadow-xl transition-shadow group">
              <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                <i class="fab fa-whatsapp text-green-600 text-3xl"></i>
              </div>
              <h3 class="font-serif text-xl font-bold text-coffee-900 mb-2">WhatsApp</h3>
              <p class="text-coffee-600 text-sm mb-3">Chat langsung dengan kami</p>
              <span class="text-coffee-700 font-semibold">Klik untuk chat</span>
            </a>

            <a href="https://www.instagram.com/caltheabatu" target="_blank" class="bg-white rounded-3xl p-8 text-center hover:shadow-xl transition-shadow group">
              <div class="w-16 h-16 bg-gradient-to-br from-pink-100 to-orange-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                <i class="fab fa-instagram text-pink-600 text-3xl"></i>
              </div>
              <h3 class="font-serif text-xl font-bold text-coffee-900 mb-2">Instagram</h3>
              <p class="text-coffee-600 text-sm mb-3">Follow untuk update terbaru</p>
              <span class="text-coffee-700 font-semibold">@caltheabatu</span>
            </a>

            <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="bg-white rounded-3xl p-8 text-center hover:shadow-xl transition-shadow group">
              <div class="w-16 h-16 bg-coffee-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-map-marker-alt text-coffee-600 text-3xl"></i>
              </div>
              <h3 class="font-serif text-xl font-bold text-coffee-900 mb-2">Lokasi</h3>
              <p class="text-coffee-600 text-sm mb-3">Lihat di Google Maps</p>
              <span class="text-coffee-700 font-semibold">Kota Batu</span>
            </a>
          </div>
        </div>
      </section>

      <!-- Map & Address -->
      <section class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
          <div class="bg-white rounded-3xl overflow-hidden shadow-xl">
            <div class="aspect-video bg-gradient-to-br from-coffee-200 to-coffee-300 flex items-center justify-center">
              <div class="text-center">
                <i class="fas fa-map text-6xl text-coffee-600 mb-4"></i>
                <p class="text-coffee-800 font-semibold">Google Maps Embed</p>
                <p class="text-coffee-600 text-sm">Placeholder untuk peta interaktif</p>
              </div>
            </div>
            <div class="p-8">
              <h3 class="font-serif text-2xl font-bold text-coffee-900 mb-4">Alamat Lengkap</h3>
              <p class="text-coffee-700 text-lg mb-6">
                Jl. Arjuno Atas No.99, Dsn. Tlogorejo, Bumiaji, Kota Batu, Jawa Timur 65331
              </p>
              <div class="grid sm:grid-cols-2 gap-6">
                <div>
                  <h4 class="font-semibold text-coffee-900 mb-2">Jam Operasional</h4>
                  <p class="text-coffee-600">Setiap Hari</p>
                  <p class="text-coffee-700 font-semibold">10:00 - 22:00 WIB</p>
                </div>
                <div>
                  <h4 class="font-semibold text-coffee-900 mb-2">Akses</h4>
                  <p class="text-coffee-600">Parkir luas tersedia</p>
                  <p class="text-coffee-600">15 menit dari pusat Kota Batu</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <Footer />
    <MobileNav />
    <WhatsAppFloat />
  </div>
</template>
