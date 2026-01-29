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
      <section class="py-16 lg:py-24 bg-gradient-to-br from-coffee-50 to-cream-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
              <span class="inline-block px-4 py-2 bg-coffee-100 text-coffee-600 text-sm font-medium rounded-full mb-4">
                Tentang Kami
              </span>
              <h1 class="font-serif text-4xl lg:text-5xl font-bold text-coffee-900 mb-6">
                Cerita Calthea
              </h1>
              <p class="text-coffee-600 text-lg leading-relaxed mb-6">
                Calthea Cafe & Nature lahir dari kecintaan kami terhadap kopi berkualitas dan keindahan alam Kota Batu. Sejak 2019, kami berkomitmen menghadirkan pengalaman ngopi yang berbeda dengan nuansa alam yang menenangkan.
              </p>
              <p class="text-coffee-600 leading-relaxed">
                Berlokasi di lereng Gunung Arjuno, kami menyajikan kopi premium dengan pemandangan alam yang memukau. Setiap cangkir kopi yang kami sajikan adalah hasil dari seleksi biji kopi terbaik dan proses brewing yang sempurna.
              </p>
            </div>
            <div class="relative">
              <div class="aspect-square bg-gradient-to-br from-coffee-200 to-coffee-300 rounded-3xl flex items-center justify-center">
                <i class="fas fa-store text-8xl text-coffee-600"></i>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Values Section -->
      <section class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <div class="text-center mb-12">
            <h2 class="font-serif text-3xl lg:text-4xl font-bold text-coffee-900 mb-4">
              Nilai-Nilai Kami
            </h2>
            <p class="text-coffee-600 text-lg">
              Prinsip yang kami pegang dalam setiap cangkir kopi
            </p>
          </div>

          <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white rounded-3xl p-8 text-center hover:shadow-xl transition-shadow">
              <div class="w-16 h-16 bg-coffee-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-award text-coffee-600 text-3xl"></i>
              </div>
              <h3 class="font-serif text-2xl font-bold text-coffee-900 mb-4">Kualitas</h3>
              <p class="text-coffee-600">
                Kami hanya menggunakan biji kopi premium pilihan dan bahan-bahan berkualitas tinggi untuk setiap menu.
              </p>
            </div>

            <div class="bg-white rounded-3xl p-8 text-center hover:shadow-xl transition-shadow">
              <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-leaf text-green-600 text-3xl"></i>
              </div>
              <h3 class="font-serif text-2xl font-bold text-coffee-900 mb-4">Alam</h3>
              <p class="text-coffee-600">
                Kami peduli lingkungan dan berkomitmen menggunakan bahan organik serta kemasan ramah lingkungan.
              </p>
            </div>

            <div class="bg-white rounded-3xl p-8 text-center hover:shadow-xl transition-shadow">
              <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-users text-amber-600 text-3xl"></i>
              </div>
              <h3 class="font-serif text-2xl font-bold text-coffee-900 mb-4">Komunitas</h3>
              <p class="text-coffee-600">
                Kami menciptakan ruang yang nyaman untuk berkumpul, bekerja, dan berbagi cerita bersama.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Timeline Section -->
      <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
          <div class="text-center mb-12">
            <h2 class="font-serif text-3xl lg:text-4xl font-bold text-coffee-900 mb-4">
              Perjalanan Kami
            </h2>
            <p class="text-coffee-600 text-lg">
              Dari mimpi menjadi kenyataan
            </p>
          </div>

          <div class="space-y-8">
            <div class="flex gap-6">
              <div class="flex-shrink-0 w-24 text-right">
                <span class="font-serif text-2xl font-bold text-coffee-600">2019</span>
              </div>
              <div class="flex-1 pb-8 border-l-2 border-coffee-200 pl-6">
                <h3 class="font-serif text-xl font-bold text-coffee-900 mb-2">Awal Mula</h3>
                <p class="text-coffee-600">
                  Calthea Cafe dibuka dengan visi menghadirkan pengalaman kopi yang unik di tengah alam Kota Batu.
                </p>
              </div>
            </div>

            <div class="flex gap-6">
              <div class="flex-shrink-0 w-24 text-right">
                <span class="font-serif text-2xl font-bold text-coffee-600">2021</span>
              </div>
              <div class="flex-1 pb-8 border-l-2 border-coffee-200 pl-6">
                <h3 class="font-serif text-xl font-bold text-coffee-900 mb-2">Ekspansi Menu</h3>
                <p class="text-coffee-600">
                  Menambah variasi menu makanan dan minuman berdasarkan feedback pelanggan setia kami.
                </p>
              </div>
            </div>

            <div class="flex gap-6">
              <div class="flex-shrink-0 w-24 text-right">
                <span class="font-serif text-2xl font-bold text-coffee-600">2023</span>
              </div>
              <div class="flex-1 pb-8 border-l-2 border-coffee-200 pl-6">
                <h3 class="font-serif text-xl font-bold text-coffee-900 mb-2">Renovasi</h3>
                <p class="text-coffee-600">
                  Memperluas area outdoor dan menambah fasilitas untuk kenyamanan pengunjung.
                </p>
              </div>
            </div>

            <div class="flex gap-6">
              <div class="flex-shrink-0 w-24 text-right">
                <span class="font-serif text-2xl font-bold text-coffee-600">2026</span>
              </div>
              <div class="flex-1 pl-6">
                <h3 class="font-serif text-xl font-bold text-coffee-900 mb-2">Masa Depan</h3>
                <p class="text-coffee-600">
                  Terus berinovasi dan memberikan pengalaman terbaik untuk setiap pengunjung.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="py-16 bg-gradient-to-br from-coffee-600 to-coffee-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
          <h2 class="font-serif text-3xl lg:text-4xl font-bold mb-4">
            Kunjungi Kami
          </h2>
          <p class="text-coffee-100 text-lg mb-8">
            Rasakan sendiri pengalaman Cafe & Nature di Calthea
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a
              href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6"
              target="_blank"
              class="inline-flex items-center gap-2 px-8 py-4 bg-white text-coffee-700 font-semibold rounded-full hover:bg-coffee-50 transition-all duration-300"
            >
              <i class="fas fa-map-marker-alt"></i>
              <span>Lihat Lokasi</span>
            </a>
            <a
              href="https://www.instagram.com/caltheabatu"
              target="_blank"
              class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-pink-500 to-orange-400 text-white font-semibold rounded-full hover:from-pink-600 hover:to-orange-500 transition-all duration-300"
            >
              <i class="fab fa-instagram"></i>
              <span>Follow Instagram</span>
            </a>
          </div>
        </div>
      </section>
    </main>

    <Footer />
    <MobileNav />
    <WhatsAppFloat />
  </div>
</template>
