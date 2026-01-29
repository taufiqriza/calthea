<script setup>
import { ref } from 'vue';
import { RouterLink } from 'vue-router';

const showOrderMenu = ref(false);

const toggleOrderMenu = () => {
  showOrderMenu.value = !showOrderMenu.value;
};
</script>

<template>
  <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 glass-dark safe-area-bottom">
    <div class="flex items-center justify-around h-16">
      <RouterLink 
        to="/" 
        class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition"
      >
        <i class="fas fa-home text-lg"></i>
        <span class="text-xs">Beranda</span>
      </RouterLink>
      <RouterLink 
        to="/menu" 
        class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition"
      >
        <i class="fas fa-coffee text-lg"></i>
        <span class="text-xs">Menu</span>
      </RouterLink>
      <button
        @click="toggleOrderMenu"
        class="flex flex-col items-center gap-1 -mt-6"
      >
        <div class="w-14 h-14 bg-coffee-500 rounded-full flex items-center justify-center shadow-lg shadow-coffee-500/50 border-4 border-coffee-900">
          <i class="fas fa-motorcycle text-white text-lg"></i>
        </div>
        <span class="text-xs text-white mt-1">Order</span>
      </button>
      <RouterLink 
        to="/galeri" 
        class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition"
      >
        <i class="fas fa-images text-lg"></i>
        <span class="text-xs">Galeri</span>
      </RouterLink>
      <RouterLink 
        to="/reservasi" 
        class="flex flex-col items-center gap-1 text-white/80 hover:text-white transition"
      >
        <i class="fas fa-calendar text-lg"></i>
        <span class="text-xs">Reservasi</span>
      </RouterLink>
    </div>

    <!-- Order Menu Modal -->
    <Transition
      enter-active-class="transition ease-out duration-300"
      enter-from-class="opacity-0 translate-y-4"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-4"
    >
      <div 
        v-if="showOrderMenu"
        class="absolute bottom-full left-0 right-0 mb-2 mx-4"
      >
        <div class="bg-white rounded-2xl shadow-2xl shadow-coffee-900/50 border border-coffee-100 overflow-hidden">
          <div class="p-4">
            <div class="flex items-center justify-between mb-3">
              <p class="text-sm text-coffee-600 font-medium">Pesan via:</p>
              <button @click="toggleOrderMenu" class="w-6 h-6 text-coffee-400 hover:text-coffee-600">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="space-y-2">
              <a href="https://gofood.link/calthea" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-green-50 hover:bg-green-100 transition-colors">
                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-motorcycle text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="font-semibold text-coffee-800 text-sm">GoFood</p>
                  <p class="text-xs text-coffee-500">Pesan sekarang</p>
                </div>
                <i class="fas fa-arrow-right text-green-500"></i>
              </a>
              <a href="https://food.grab.com/id/en/restaurant/calthea" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 transition-colors">
                <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-utensils text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="font-semibold text-coffee-800 text-sm">GrabFood</p>
                  <p class="text-xs text-coffee-500">Pesan sekarang</p>
                </div>
                <i class="fas fa-arrow-right text-emerald-600"></i>
              </a>
              <a href="https://shopee.co.id/universal-link/food" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-orange-50 hover:bg-orange-100 transition-colors">
                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-shopping-bag text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="font-semibold text-coffee-800 text-sm">ShopeeFood</p>
                  <p class="text-xs text-coffee-500">Pesan sekarang</p>
                </div>
                <i class="fas fa-arrow-right text-orange-500"></i>
              </a>
            </div>
            <div class="mt-3 pt-3 border-t border-coffee-100">
              <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 bg-coffee-600 hover:bg-coffee-700 text-white text-sm font-semibold rounded-xl transition-colors">
                <i class="fab fa-whatsapp text-lg"></i>
                <span>Order via WhatsApp</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </nav>
</template>

<style scoped>
.glass-dark {
  background: rgba(93, 64, 55, 0.95);
  backdrop-filter: blur(20px);
}

.safe-area-bottom {
  padding-bottom: env(safe-area-inset-bottom);
}
</style>
