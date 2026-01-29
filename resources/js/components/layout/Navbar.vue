<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { RouterLink } from 'vue-router';

const scrolled = ref(false);

const handleScroll = () => {
  scrolled.value = window.scrollY > 50;
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
  <header 
    class="hidden lg:block fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    :class="scrolled ? 'glass shadow-xl shadow-coffee-200/20 py-2' : 'bg-transparent py-4'"
  >
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <RouterLink to="/" class="flex items-center gap-3 group">
          <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-lg shadow-coffee-200/40 group-hover:shadow-xl group-hover:shadow-coffee-300/50 transition-all duration-300 group-hover:scale-105 overflow-hidden p-1">
            <img src="/images/logo-calthea.jpg" alt="Calthea" class="w-full h-full object-cover rounded-xl">
          </div>
          <div>
            <span class="font-serif text-2xl font-bold text-coffee-800 block leading-tight group-hover:text-coffee-600 transition-colors">Calthea</span>
            <span class="text-xs text-coffee-500 font-medium tracking-wider">Cafe & Nature 🌿</span>
          </div>
        </RouterLink>

        <!-- Nav -->
        <nav class="flex items-center bg-white/60 backdrop-blur-md rounded-full px-2 py-2 shadow-lg shadow-coffee-100/50 border border-white/50">
          <RouterLink 
            to="/" 
            class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300"
          >
            <i class="fas fa-home text-sm opacity-70 group-hover:opacity-100"></i>
            <span>Beranda</span>
          </RouterLink>
          <RouterLink 
            to="/menu" 
            class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300"
          >
            <i class="fas fa-coffee text-sm opacity-70 group-hover:opacity-100"></i>
            <span>Menu</span>
          </RouterLink>
          <RouterLink 
            to="/tentang" 
            class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300"
          >
            <i class="fas fa-heart text-sm opacity-70 group-hover:opacity-100"></i>
            <span>Tentang</span>
          </RouterLink>
          <RouterLink 
            to="/galeri" 
            class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300"
          >
            <i class="fas fa-images text-sm opacity-70 group-hover:opacity-100"></i>
            <span>Galeri</span>
          </RouterLink>
          <a 
            href="#ulasan" 
            class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300"
          >
            <i class="fas fa-star text-sm opacity-70 group-hover:opacity-100"></i>
            <span>Ulasan</span>
          </a>
          <RouterLink 
            to="/reservasi" 
            class="group flex items-center gap-2 px-5 py-2.5 rounded-full text-coffee-700 hover:bg-coffee-600 hover:text-white font-medium transition-all duration-300"
          >
            <i class="fas fa-calendar-check text-sm opacity-70 group-hover:opacity-100"></i>
            <span>Reservasi</span>
          </RouterLink>
        </nav>

        <!-- CTA Buttons -->
        <div class="flex items-center gap-3">
          <a 
            href="tel:+621234567890" 
            class="w-12 h-12 bg-coffee-100 hover:bg-coffee-200 rounded-xl flex items-center justify-center text-coffee-600 transition-all duration-300 hover:scale-105"
          >
            <i class="fas fa-phone"></i>
          </a>
          <div class="relative group">
            <button class="px-6 py-3 bg-gradient-to-r from-coffee-600 to-coffee-700 text-white font-semibold rounded-xl hover:from-coffee-700 hover:to-coffee-800 hover:shadow-xl hover:shadow-coffee-600/40 transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
              <i class="fas fa-motorcycle"></i>
              <span>Order Online</span>
            </button>
            
            <!-- Dropdown -->
            <div class="absolute top-full right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl shadow-coffee-300/30 border border-coffee-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
              <div class="p-4">
                <p class="text-sm text-coffee-600 mb-3 font-medium">Pesan via:</p>
                <div class="space-y-2">
                  <a href="https://gofood.link/calthea" target="_blank" class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-50 transition-colors group/item">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                      <i class="fas fa-motorcycle text-white"></i>
                    </div>
                    <div class="flex-1">
                      <p class="font-semibold text-coffee-800 text-sm">GoFood</p>
                      <p class="text-xs text-coffee-500">Pesan sekarang</p>
                    </div>
                    <i class="fas fa-arrow-right text-coffee-400 group-hover/item:text-green-500 transition-colors"></i>
                  </a>
                  <a href="https://food.grab.com/id/en/restaurant/calthea" target="_blank" class="flex items-center gap-3 p-3 rounded-xl hover:bg-emerald-50 transition-colors group/item">
                    <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center">
                      <i class="fas fa-utensils text-white"></i>
                    </div>
                    <div class="flex-1">
                      <p class="font-semibold text-coffee-800 text-sm">GrabFood</p>
                      <p class="text-xs text-coffee-500">Pesan sekarang</p>
                    </div>
                    <i class="fas fa-arrow-right text-coffee-400 group-hover/item:text-emerald-600 transition-colors"></i>
                  </a>
                  <a href="https://shopee.co.id/universal-link/food" target="_blank" class="flex items-center gap-3 p-3 rounded-xl hover:bg-orange-50 transition-colors group/item">
                    <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                      <i class="fas fa-shopping-bag text-white"></i>
                    </div>
                    <div class="flex-1">
                      <p class="font-semibold text-coffee-800 text-sm">ShopeeFood</p>
                      <p class="text-xs text-coffee-500">Pesan sekarang</p>
                    </div>
                    <i class="fas fa-arrow-right text-coffee-400 group-hover/item:text-orange-500 transition-colors"></i>
                  </a>
                </div>
                <div class="mt-3 pt-3 border-t border-coffee-100">
                  <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 bg-coffee-600 hover:bg-coffee-700 text-white text-sm font-semibold rounded-lg transition-colors">
                    <i class="fab fa-whatsapp"></i>
                    <span>Order via WhatsApp</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Mobile Header -->
  <header class="lg:hidden fixed top-0 left-0 right-0 z-50 glass shadow-lg">
    <div class="flex items-center justify-between h-16 px-4">
      <RouterLink to="/" class="flex items-center gap-2">
        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center overflow-hidden shadow p-0.5">
          <img src="/images/logo-calthea.jpg" alt="Calthea" class="w-full h-full object-cover rounded-lg">
        </div>
        <div>
          <span class="font-serif text-lg font-bold text-coffee-800 block leading-tight">Calthea</span>
          <span class="text-xs text-coffee-500">Cafe & Nature</span>
        </div>
      </RouterLink>
      <a 
        href="https://www.instagram.com/caltheabatu" 
        target="_blank" 
        class="w-10 h-10 bg-gradient-to-br from-pink-500 to-orange-400 rounded-full flex items-center justify-center text-white shadow"
      >
        <i class="fab fa-instagram"></i>
      </a>
    </div>
  </header>
</template>

<style scoped>
.glass {
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}
</style>
