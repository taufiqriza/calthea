<script setup>
import { ref, computed, onMounted } from 'vue';
import { useMenuStore } from '@/stores/menu';
import Navbar from '@components/layout/Navbar.vue';
import Footer from '@components/layout/Footer.vue';
import MobileNav from '@components/layout/MobileNav.vue';
import WhatsAppFloat from '@components/shared/WhatsAppFloat.vue';
import MenuCard from '@components/home/MenuCard.vue';
import OrderModal from '@components/shared/OrderModal.vue';
import { useOrderStore } from '@/stores/order';

const menuStore = useMenuStore();
const orderStore = useOrderStore();
const selectedCategory = ref('all');
const searchQuery = ref('');
const showOrderModal = ref(false);

const categories = [
  { id: 'all', name: 'Semua', icon: 'fa-th-large' },
  { id: 'drink', name: 'Minuman', icon: 'fa-mug-hot' },
  { id: 'food', name: 'Makanan', icon: 'fa-utensils' },
  { id: 'snack', name: 'Snacks', icon: 'fa-cookie-bite' },
];

const allItems = computed(() => menuStore.items);

const filteredMenu = computed(() => {
  let items = allItems.value;
  if (selectedCategory.value !== 'all') {
    items = items.filter(item => item.category === selectedCategory.value);
  }
  if (searchQuery.value) {
    items = items.filter(item =>
      (item.name || '').toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  }
  return items;
});

const filterMenu = (category) => {
  selectedCategory.value = category;
};

const categoryCount = (id) => {
  if (id === 'all') return allItems.value.length;
  return allItems.value.filter(item => item.category === id).length;
};

onMounted(() => {
  if (!menuStore.items.length) {
    menuStore.fetch();
  }
});

const handleAddToCart = (item) => {
  orderStore.addItem(item);
  showOrderModal.value = true;
};
</script>

<template>
  <div>
    <Navbar />
    
    <main class="pt-24 pb-32 lg:pb-16 min-h-screen bg-cream-50">
      <!-- Hero Section -->
      <section class="py-12 lg:py-16 bg-gradient-to-br from-coffee-50 to-cream-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
          <span class="inline-block px-4 py-2 bg-coffee-100 text-coffee-600 text-sm font-medium rounded-full mb-4">
            Menu Lengkap
          </span>
          <h1 class="font-serif text-4xl lg:text-5xl font-bold text-coffee-900 mb-4">
            Menu Calthea
          </h1>
          <p class="text-coffee-600 text-lg max-w-2xl mx-auto mb-8">
            Jelajahi berbagai pilihan minuman dan makanan lezat kami
          </p>
          
          <!-- Search Bar -->
          <div class="max-w-xl mx-auto">
            <div class="relative">
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Cari menu..."
                class="w-full px-6 py-4 pr-12 rounded-full border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none text-coffee-900 placeholder-coffee-400"
              >
              <button class="absolute right-4 top-1/2 -translate-y-1/2 text-coffee-500 hover:text-coffee-700" type="button">
                <i class="fas fa-search text-xl"></i>
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- Filter Categories -->
      <section class="py-8 sticky top-16 lg:top-20 z-40 bg-cream-50/95 backdrop-blur-md border-b border-coffee-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
            <button
              v-for="cat in categories"
              :key="cat.id"
              @click="filterMenu(cat.id)"
              :class="[
                'flex items-center gap-2 px-5 py-3 rounded-full font-medium transition-all duration-300 whitespace-nowrap',
                selectedCategory === cat.id
                  ? 'bg-coffee-600 text-white shadow-lg'
                  : 'bg-white text-coffee-700 hover:bg-coffee-100'
              ]"
            >
              <i :class="`fas ${cat.icon}`"></i>
              <span>{{ cat.name }}</span>
              <span class="px-2 py-0.5 bg-white/20 rounded-full text-xs">
                {{ categoryCount(cat.id) }}
              </span>
            </button>
          </div>
        </div>
      </section>

      <!-- Menu Grid -->
      <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            <MenuCard
              v-for="item in filteredMenu"
              :key="item.id"
              :title="item.name"
              :price="Number(item.price)"
              :description="item.description"
              :image="item.image"
              :category="item.category"
              :badge="item.is_featured ? 'best-seller' : ''"
              @add-to-cart="handleAddToCart(item)"
            />
          </div>

          <!-- Empty State -->
          <div v-if="!menuStore.loading && filteredMenu.length === 0" class="text-center py-20">
            <i class="fas fa-search text-6xl text-coffee-300 mb-4"></i>
            <p class="text-coffee-600 text-lg">Tidak ada menu yang ditemukan</p>
            <button @click="searchQuery = ''; filterMenu('all')" class="mt-4 px-6 py-3 bg-coffee-600 text-white rounded-full hover:bg-coffee-700 transition">
              Reset Pencarian
            </button>
          </div>

          <div v-if="menuStore.loading" class="text-center py-16 text-coffee-400">
            Memuat menu...
          </div>
        </div>
      </section>

      <!-- Promo Banner -->
      <section class="py-16 bg-gradient-to-br from-coffee-600 to-coffee-800 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
          <span class="inline-block px-4 py-2 bg-white/20 text-white text-sm font-medium rounded-full mb-4">
            Promo Spesial
          </span>
          <h2 class="font-serif text-3xl lg:text-4xl font-bold mb-4">
            Diskon 20% untuk Semua Snacks!
          </h2>
          <p class="text-coffee-100 text-lg mb-8">
            Berlaku setiap hari. Pesan sekarang dan nikmati promo menarik kami.
          </p>
          <a
            href="https://api.whatsapp.com/message/LO4AQRWQTDBCO1"
            target="_blank"
            class="inline-flex items-center gap-2 px-8 py-4 bg-white text-coffee-700 font-semibold rounded-full hover:bg-coffee-50 transition-all duration-300"
          >
            <i class="fab fa-whatsapp text-xl"></i>
            <span>Pesan Sekarang</span>
          </a>
        </div>
      </section>
    </main>

    <Footer />
    <MobileNav />
    <WhatsAppFloat />

    <button
      v-if="orderStore.itemCount > 0"
      @click="showOrderModal = true"
      class="fixed z-50 right-4 lg:right-8 bottom-28 lg:bottom-8 px-5 py-3 bg-coffee-600 hover:bg-coffee-700 text-white font-semibold rounded-full shadow-xl shadow-coffee-500/30 flex items-center gap-2"
    >
      <i class="fas fa-receipt"></i>
      <span>Pesan ({{ orderStore.itemCount }})</span>
    </button>

    <OrderModal :open="showOrderModal" @close="showOrderModal = false" />
  </div>
</template>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
