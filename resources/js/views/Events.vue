<script setup>
import Navbar from '@components/layout/Navbar.vue';
import Footer from '@components/layout/Footer.vue';
import MobileNav from '@components/layout/MobileNav.vue';
import WhatsAppFloat from '@components/shared/WhatsAppFloat.vue';
</script>

<template>
  <div>
    <Navbar />
    
    <main class="pt-24 pb-32 lg:pb-16 min-h-screen">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
          <h1 class="font-serif text-4xl lg:text-5xl font-bold text-coffee-900 mb-4">
            Promo & Event
          </h1>
          <p class="text-coffee-600 text-lg">
            Halaman promo & event akan segera hadir
          </p>
        </div>
      </div>
    </main>

    <Footer />
    <MobileNav />
    <WhatsAppFloat />
  </div>
</template>
