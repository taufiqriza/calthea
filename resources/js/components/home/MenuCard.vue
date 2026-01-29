<script setup>
defineProps({
  title: {
    type: String,
    required: true,
  },
  price: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    required: true,
  },
  icon: {
    type: String,
    required: true,
  },
  gradient: {
    type: String,
    required: true,
  },
  iconColor: {
    type: String,
    default: 'text-white',
  },
  badge: {
    type: String,
    default: '',
  },
});

const emit = defineEmits(['add-to-cart']);

const handleAddToCart = () => {
  emit('add-to-cart');
};
</script>

<template>
  <div class="group bg-cream-50 rounded-2xl lg:rounded-3xl p-3 sm:p-4 lg:p-6 hover:shadow-xl hover:shadow-coffee-200/50 transition-all duration-500 hover:-translate-y-2">
    <div class="relative">
      <div 
        :class="`w-full aspect-square bg-gradient-to-br ${gradient} rounded-xl lg:rounded-2xl mb-3 lg:mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500`"
      >
        <i :class="`fas ${icon} ${iconColor} text-3xl sm:text-4xl lg:text-5xl`"></i>
      </div>
      <span 
        v-if="badge === 'best-seller'" 
        class="absolute top-2 right-2 px-2 py-0.5 lg:px-3 lg:py-1 bg-red-500 text-white text-xs font-semibold rounded-full"
      >
        Best
      </span>
      <span 
        v-if="badge === 'favorit'" 
        class="absolute top-2 right-2 px-2 py-0.5 lg:px-3 lg:py-1 bg-green-500 text-white text-xs font-semibold rounded-full"
      >
        Favorit
      </span>
    </div>
    <div class="flex items-start justify-between mb-1 lg:mb-2">
      <h3 class="font-serif text-sm sm:text-base lg:text-xl font-semibold text-coffee-900 leading-tight">{{ title }}</h3>
      <span class="px-2 py-0.5 lg:px-3 lg:py-1 bg-coffee-600 text-white text-xs lg:text-sm font-semibold rounded-full whitespace-nowrap ml-1">{{ price }}</span>
    </div>
    <p class="text-coffee-500 text-xs lg:text-sm mb-3 lg:mb-4 line-clamp-2">{{ description }}</p>
    <button 
      @click="handleAddToCart"
      class="w-full py-2 lg:py-3 bg-coffee-100 text-coffee-700 font-medium text-sm lg:text-base rounded-lg lg:rounded-xl hover:bg-coffee-600 hover:text-white transition-all duration-300 flex items-center justify-center gap-2"
    >
      <i class="fas fa-cart-plus text-xs lg:text-sm"></i> 
      <span class="hidden sm:inline">Tambah</span>
      <span class="sm:hidden">+</span>
    </button>
  </div>
</template>
