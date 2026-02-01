<script setup>
import { ref } from 'vue';
import Navbar from '@components/layout/Navbar.vue';
import Footer from '@components/layout/Footer.vue';
import MobileNav from '@components/layout/MobileNav.vue';
import WhatsAppFloat from '@components/shared/WhatsAppFloat.vue';

const selectedCategory = ref('all');
const selectedImage = ref(null);

const categories = [
  { id: 'all', name: 'Semua', icon: 'fa-th' },
  { id: 'cafe', name: 'Cafe', icon: 'fa-store' },
  { id: 'interior', name: 'Interior', icon: 'fa-chair' },
  { id: 'outdoor', name: 'Outdoor', icon: 'fa-tree' },
  { id: 'view', name: 'View', icon: 'fa-mountain' },
  { id: 'menu', name: 'Menu', icon: 'fa-utensils' },
];

const galleryFiles = [
  'BACKGROUND-BANUGNAN-UTAMA.jpg',
  'BANGUNAN-UTAMA-DEPAN.jpg',
  'GALERY-SUM.jpg',
  'INDOR-KASIR.jpg',
  'INTERIOR-2.jpg',
  'INTERIOR-3.jpg',
  'INTERIOR.jpg',
  'INTEROR-2.jpg',
  'JALAN-JALAN-KEBUN-JERUK.jpg',
  'LANTAI-2-GUNUNG-PANDERMAN.jpg',
  'MAKANAN-UTAMA.jpg',
  'OUTDOOR-LT1-KEBUNJERUK.jpg',
  'OUTDOOR-ROOFTOP.jpg',
  'PEMANDANGAN-DEPAN.jpg',
  'TEMPAT-DUDUK.jpg',
];

const formatTitle = (filename) =>
  filename
    .replace(/\.[^/.]+$/, '')
    .replace(/[-_]+/g, ' ')
    .toLowerCase()
    .replace(/\b\w/g, (char) => char.toUpperCase());

const detectCategory = (filename) => {
  const name = filename.toLowerCase();
  if (name.includes('makanan')) return 'menu';
  if (name.includes('outdoor') || name.includes('kebun') || name.includes('rooftop')) return 'outdoor';
  if (name.includes('pemandangan') || name.includes('gunung')) return 'view';
  if (name.includes('interior') || name.includes('indor') || name.includes('interor') || name.includes('kasir') || name.includes('tempat')) return 'interior';
  if (name.includes('bangunan') || name.includes('background')) return 'cafe';
  return 'cafe';
};

const images = galleryFiles.map((file, index) => ({
  id: index + 1,
  category: detectCategory(file),
  title: formatTitle(file),
  src: `/storage/galery/${file}`,
}));

const filteredImages = ref(images);

const filterImages = (category) => {
  selectedCategory.value = category;
  if (category === 'all') {
    filteredImages.value = images;
  } else {
    filteredImages.value = images.filter(img => img.category === category);
  }
};

const openLightbox = (image) => {
  selectedImage.value = image;
};

const closeLightbox = () => {
  selectedImage.value = null;
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
            Galeri Foto
          </span>
          <h1 class="font-serif text-4xl lg:text-5xl font-bold text-coffee-900 mb-4">
            Galeri Calthea
          </h1>
          <p class="text-coffee-600 text-lg max-w-2xl mx-auto">
            Lihat momen-momen indah di Calthea Cafe & Nature
          </p>
        </div>
      </section>

      <!-- Filter Categories -->
      <section class="py-8 sticky top-16 lg:top-20 z-40 bg-cream-50/95 backdrop-blur-md border-b border-coffee-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <div class="flex items-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
            <button
              v-for="cat in categories"
              :key="cat.id"
              @click="filterImages(cat.id)"
              :class="[
                'flex items-center gap-2 px-4 py-2.5 rounded-full font-medium transition-all duration-300 whitespace-nowrap',
                selectedCategory === cat.id
                  ? 'bg-coffee-600 text-white shadow-lg'
                  : 'bg-white text-coffee-700 hover:bg-coffee-100'
              ]"
            >
              <i :class="`fas ${cat.icon} text-sm`"></i>
              <span>{{ cat.name }}</span>
            </button>
          </div>
        </div>
      </section>

      <!-- Gallery Grid (Pinterest Style) -->
      <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-4 space-y-4">
            <div
              v-for="image in filteredImages"
              :key="image.id"
              @click="openLightbox(image)"
              class="break-inside-avoid group cursor-pointer"
            >
              <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-coffee-100 to-coffee-200 hover:shadow-2xl hover:shadow-coffee-300/40 transition-all duration-500 hover:-translate-y-1">
                <img :src="image.src" :alt="image.title" loading="lazy" class="w-full h-auto object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-coffee-900/70 via-coffee-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                  <div class="text-white">
                    <p class="font-serif text-lg font-bold mb-1">{{ image.title }}</p>
                    <p class="text-xs text-coffee-200">{{ categories.find(c => c.id === image.category)?.name }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="filteredImages.length === 0" class="text-center py-20">
            <i class="fas fa-images text-6xl text-coffee-300 mb-4"></i>
            <p class="text-coffee-600 text-lg">Tidak ada foto di kategori ini</p>
          </div>
        </div>
      </section>

      <!-- CTA Section -->
      <section class="py-16 bg-gradient-to-br from-coffee-100 to-cream-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
          <h2 class="font-serif text-3xl lg:text-4xl font-bold text-coffee-900 mb-4">
            Ikuti Kami di Instagram
          </h2>
          <p class="text-coffee-600 text-lg mb-8">
            Lihat foto-foto terbaru dan update dari Calthea Cafe
          </p>
          <a
            href="https://www.instagram.com/caltheabatu"
            target="_blank"
            class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-pink-500 to-orange-400 text-white font-semibold rounded-full hover:from-pink-600 hover:to-orange-500 hover:shadow-xl transition-all duration-300"
          >
            <i class="fab fa-instagram text-xl"></i>
            <span>@caltheabatu</span>
          </a>
        </div>
      </section>
    </main>

    <!-- Lightbox Modal -->
    <Transition
      enter-active-class="transition ease-out duration-300"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="selectedImage"
        @click="closeLightbox"
        class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center p-4"
      >
        <button
          @click="closeLightbox"
          class="absolute top-4 right-4 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors"
        >
          <i class="fas fa-times text-xl"></i>
        </button>
        
        <div @click.stop class="max-w-5xl w-full">
          <div class="bg-white rounded-3xl p-4 sm:p-6 lg:p-8">
            <div class="rounded-2xl overflow-hidden">
              <img :src="selectedImage.src" :alt="selectedImage.title" class="w-full h-auto object-cover">
            </div>
            <div class="mt-4 flex items-center justify-between">
              <div>
                <p class="font-serif text-2xl font-bold text-coffee-900">{{ selectedImage.title }}</p>
                <p class="text-coffee-600 text-sm">{{ categories.find(c => c.id === selectedImage.category)?.name }}</p>
              </div>
              <span class="px-3 py-1 rounded-full text-xs bg-coffee-100 text-coffee-700">Galeri Calthea</span>
            </div>
          </div>
        </div>
      </div>
    </Transition>

    <Footer />
    <MobileNav />
    <WhatsAppFloat />
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
