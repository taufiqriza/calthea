<script setup>
import { ref, onMounted } from 'vue';

const showGreeting = ref(false);
const hasShown = ref(false);

onMounted(() => {
  setTimeout(() => {
    if (!hasShown.value) {
      showGreeting.value = true;
      hasShown.value = true;
    }
  }, 3000);
});

const closeGreeting = () => {
  showGreeting.value = false;
};

const toggleGreeting = () => {
  showGreeting.value = !showGreeting.value;
};
</script>

<template>
  <div class="fixed z-50 lg:bottom-8 lg:right-8 bottom-24 right-4">
    <!-- Greeting Modal -->
    <Transition
      enter-active-class="transition ease-out duration-300"
      enter-from-class="opacity-0 translate-y-4 scale-95"
      enter-to-class="opacity-100 translate-y-0 scale-100"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="opacity-100 translate-y-0 scale-100"
      leave-to-class="opacity-0 translate-y-4 scale-95"
    >
      <div 
        v-if="showGreeting"
        class="absolute bottom-full right-0 mb-4 w-72 bg-white rounded-2xl shadow-2xl shadow-coffee-300/30 p-5 border border-coffee-100"
      >
        <button 
          @click="closeGreeting" 
          class="absolute top-3 right-3 w-6 h-6 text-coffee-400 hover:text-coffee-600 transition"
        >
          <i class="fas fa-times"></i>
        </button>
        <div class="flex items-center gap-3 mb-3">
          <img src="/images/logo-calthea.jpg" alt="Calthea" class="w-12 h-12 rounded-full object-cover border-2 border-coffee-200">
          <div>
            <p class="font-semibold text-coffee-800">Calthea Cafe</p>
            <p class="text-xs text-coffee-500">Biasanya membalas dalam 1 jam</p>
          </div>
        </div>
        <div class="bg-coffee-50 rounded-xl p-3 mb-4">
          <p class="text-sm text-coffee-700">Halo! 👋 Ada yang bisa kami bantu? Silakan chat untuk reservasi atau info menu.</p>
        </div>
        <a 
          href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1" 
          target="_blank" 
          class="flex items-center justify-center gap-2 w-full py-3 bg-coffee-600 hover:bg-coffee-700 text-white font-semibold rounded-xl transition-all duration-300"
        >
          <i class="fab fa-whatsapp text-lg"></i>
          Mulai Chat
        </a>
      </div>
    </Transition>
    
    <!-- Floating Button -->
    <button 
      @click="toggleGreeting"
      class="group w-16 h-16 bg-gradient-to-br from-coffee-500 to-coffee-700 hover:from-coffee-600 hover:to-coffee-800 rounded-full flex items-center justify-center shadow-xl shadow-coffee-500/40 hover:shadow-2xl hover:shadow-coffee-500/50 transition-all duration-300 hover:scale-110"
    >
      <i class="fab fa-whatsapp text-white text-3xl group-hover:scale-110 transition-transform"></i>
    </button>
    
    <!-- Pulse Animation -->
    <span class="absolute top-0 right-0 w-4 h-4">
      <span class="absolute inline-flex h-full w-full rounded-full bg-coffee-400 opacity-75 animate-ping"></span>
      <span class="relative inline-flex rounded-full h-4 w-4 bg-coffee-500"></span>
    </span>
  </div>
</template>
