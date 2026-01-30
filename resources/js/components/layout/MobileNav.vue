<script setup>
import { ref } from 'vue';
import { RouterLink, useRoute } from 'vue-router';

const showOrderMenu = ref(false);
const route = useRoute();

const toggleOrderMenu = () => {
  showOrderMenu.value = !showOrderMenu.value;
};

const isActive = (path) => route.path === path;
</script>

<template>
  <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 safe-area-bottom">
    <div class="mx-4 mb-3">
      <div class="relative nav-shell">
        <div class="absolute inset-0 nav-glow"></div>
        <div class="relative flex items-center justify-between px-4 py-3">
          <RouterLink 
            to="/" 
            class="nav-item"
            :class="isActive('/') ? 'nav-item-active' : ''"
          >
            <span class="nav-icon"><i class="fas fa-home"></i></span>
            <span class="nav-label">Beranda</span>
          </RouterLink>

          <RouterLink 
            to="/menu" 
            class="nav-item"
            :class="isActive('/menu') ? 'nav-item-active' : ''"
          >
            <span class="nav-icon"><i class="fas fa-coffee"></i></span>
            <span class="nav-label">Menu</span>
          </RouterLink>

          <button
            @click="toggleOrderMenu"
            class="nav-cta"
            aria-label="Order"
          >
            <span class="nav-cta-ring"></span>
            <span class="nav-cta-core">
              <i class="fas fa-motorcycle"></i>
            </span>
            <span class="nav-label">Order</span>
          </button>

          <RouterLink 
            to="/galeri" 
            class="nav-item"
            :class="isActive('/galeri') ? 'nav-item-active' : ''"
          >
            <span class="nav-icon"><i class="fas fa-images"></i></span>
            <span class="nav-label">Galeri</span>
          </RouterLink>

          <RouterLink 
            to="/reservasi" 
            class="nav-item"
            :class="isActive('/reservasi') ? 'nav-item-active' : ''"
          >
            <span class="nav-icon"><i class="fas fa-calendar"></i></span>
            <span class="nav-label">Reservasi</span>
          </RouterLink>
        </div>
      </div>
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
        class="absolute bottom-full left-0 right-0 mb-3 mx-4"
      >
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl shadow-coffee-900/40 border border-white/70 overflow-hidden">
          <div class="p-4">
            <div class="flex items-center justify-between mb-3">
              <p class="text-xs uppercase tracking-widest text-coffee-500 font-semibold">Pesan via</p>
              <button @click="toggleOrderMenu" class="w-7 h-7 rounded-full bg-coffee-100 text-coffee-500 hover:text-coffee-700">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="space-y-2">
              <a href="https://gofood.link/calthea" target="_blank" class="flex items-center gap-3 p-3 rounded-2xl bg-green-50 hover:bg-green-100 transition-colors">
                <div class="w-11 h-11 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-motorcycle text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="font-semibold text-coffee-800 text-sm">GoFood</p>
                  <p class="text-xs text-coffee-500">Pesan sekarang</p>
                </div>
                <i class="fas fa-arrow-right text-green-500"></i>
              </a>
              <a href="https://food.grab.com/id/en/restaurant/calthea" target="_blank" class="flex items-center gap-3 p-3 rounded-2xl bg-emerald-50 hover:bg-emerald-100 transition-colors">
                <div class="w-11 h-11 bg-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                  <i class="fas fa-utensils text-white"></i>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="font-semibold text-coffee-800 text-sm">GrabFood</p>
                  <p class="text-xs text-coffee-500">Pesan sekarang</p>
                </div>
                <i class="fas fa-arrow-right text-emerald-600"></i>
              </a>
              <a href="https://shopee.co.id/universal-link/food" target="_blank" class="flex items-center gap-3 p-3 rounded-2xl bg-orange-50 hover:bg-orange-100 transition-colors">
                <div class="w-11 h-11 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
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
              <a href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 bg-coffee-600 hover:bg-coffee-700 text-white text-sm font-semibold rounded-2xl transition-colors">
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
.safe-area-bottom {
  padding-bottom: env(safe-area-inset-bottom);
}

.nav-shell {
  background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(255,255,255,0.75));
  border: 1px solid rgba(255,255,255,0.7);
  border-radius: 28px;
  backdrop-filter: blur(18px);
  box-shadow: 0 18px 40px -28px rgba(60, 40, 24, 0.6);
}

.nav-glow {
  border-radius: 28px;
  background: radial-gradient(circle at 50% -60%, rgba(196, 154, 118, 0.6), transparent 60%);
}

.nav-item {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  color: rgba(88, 65, 45, 0.7);
  font-weight: 600;
  font-size: 11px;
  letter-spacing: 0.02em;
  transition: all 0.25s ease;
  background: transparent;
  border: none;
}

.nav-item-active,
.nav-item:hover {
  color: #6f4a25;
  background: transparent;
}

.nav-icon {
  width: 40px;
  height: 40px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.7);
  border: 1px solid rgba(177, 127, 86, 0.18);
  font-size: 16px;
  color: #6f4a25;
  transition: all 0.25s ease;
}

.nav-item:hover .nav-icon {
  background: rgba(245, 233, 216, 0.9);
}

.nav-item-active .nav-icon {
  background: rgba(245, 233, 216, 0.95);
  color: #8b5a2b;
  box-shadow: 0 10px 26px -18px rgba(110, 74, 37, 0.6);
  transform: translateY(-2px);
}

.nav-cta {
  position: relative;
  margin-top: -32px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  color: #6f4a25;
  font-weight: 700;
  font-size: 11px;
}

.nav-cta-ring {
  position: absolute;
  width: 58px;
  height: 58px;
  top: 0;
  left: 0;
  border-radius: 18px;
  background: radial-gradient(circle at 30% 30%, rgba(248, 236, 220, 0.9), rgba(177, 127, 86, 0.6));
  filter: blur(0.2px);
  z-index: 0;
}

.nav-cta-core {
  position: relative;
  width: 58px;
  height: 58px;
  border-radius: 18px;
  background: linear-gradient(135deg, #b17f56, #8b5a2b);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: white;
  box-shadow: 0 18px 32px -18px rgba(79, 54, 30, 0.9);
  z-index: 1;
}

.nav-label {
  line-height: 1;
}
</style>
