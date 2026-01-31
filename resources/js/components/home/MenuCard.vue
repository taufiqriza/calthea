<script setup>
import { computed } from 'vue';

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  price: {
    type: [String, Number],
    required: true,
  },
  description: {
    type: String,
    default: '',
  },
  icon: {
    type: String,
    default: '',
  },
  image: {
    type: String,
    default: '',
  },
  category: {
    type: String,
    default: '',
  },
  gradient: {
    type: String,
    default: '',
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

const categoryGradient = {
  drink: 'from-coffee-200 to-coffee-400',
  food: 'from-amber-100 to-amber-300',
  snack: 'from-yellow-100 to-yellow-200',
};

const categoryIcon = {
  drink: 'fa-mug-hot',
  food: 'fa-utensils',
  snack: 'fa-cookie-bite',
};

const displayGradient = computed(() => props.gradient || categoryGradient[props.category] || 'from-coffee-100 to-coffee-200');
const displayIcon = computed(() => props.icon || categoryIcon[props.category] || 'fa-mug-hot');
const formattedPrice = computed(() => {
  if (typeof props.price === 'number') {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      maximumFractionDigits: 0,
    }).format(props.price);
  }
  return props.price;
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
        :class="`w-full aspect-square bg-gradient-to-br ${displayGradient} rounded-xl lg:rounded-2xl mb-3 lg:mb-6 flex items-center justify-center overflow-hidden group-hover:scale-105 transition-transform duration-500`"
      >
        <img
          v-if="image"
          :src="image"
          :alt="title"
          class="w-full h-full object-cover"
        />
        <i v-else :class="`fas ${displayIcon} ${iconColor} text-3xl sm:text-4xl lg:text-5xl`"></i>
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
      <span class="px-2 py-0.5 lg:px-3 lg:py-1 bg-coffee-600 text-white text-xs lg:text-sm font-semibold rounded-full whitespace-nowrap ml-1">
        {{ formattedPrice }}
      </span>
    </div>
    <p class="text-coffee-500 text-xs lg:text-sm mb-3 lg:mb-4 line-clamp-2">{{ description || 'Deskripsi belum tersedia' }}</p>
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
