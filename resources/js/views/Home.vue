<script setup>
import { onMounted, onBeforeUnmount, computed, ref } from 'vue';
import { useMenuStore } from '@/stores/menu';
import Navbar from '@components/layout/Navbar.vue';
import Footer from '@components/layout/Footer.vue';
import MobileNav from '@components/layout/MobileNav.vue';
import WhatsAppFloat from '@components/shared/WhatsAppFloat.vue';
import SectionHeader from '@components/shared/SectionHeader.vue';
import MenuCard from '@components/home/MenuCard.vue';
import Button from '@components/ui/Button.vue';
import OrderModal from '@components/shared/OrderModal.vue';
import QuickAddModal from '@components/shared/QuickAddModal.vue';
import { useOrderStore } from '@/stores/order';

const menuStore = useMenuStore();
const orderStore = useOrderStore();
const showOrderModal = ref(false);
const showQuickAdd = ref(false);
const selectedMenu = ref(null);
const heroSlides = [
  {
    id: 1,
    title: 'Bangunan Utama',
    subtitle: 'Ikon Calthea Batu',
    image: '/storage/galery/BACKGROUND-BANUGNAN-UTAMA.jpg',
  },
  {
    id: 2,
    title: 'Outdoor Rooftop',
    subtitle: 'View alam terbuka',
    image: '/storage/galery/OUTDOOR-ROOFTOP.jpg',
  },
  {
    id: 3,
    title: 'Gunung Panderman',
    subtitle: 'Pemandangan lantai 2',
    image: '/storage/galery/LANTAI-2-GUNUNG-PANDERMAN.jpg',
  },
];
const activeHero = ref(0);
let heroTimer = null;
const ctaSlides = heroSlides;
const activeCta = ref(0);
let ctaTimer = null;
const galleryPreview = [
  '/storage/galery/INTERIOR.jpg',
  '/storage/galery/OUTDOOR-LT1-KEBUNJERUK.jpg',
  '/storage/galery/PEMANDANGAN-DEPAN.jpg',
  '/storage/galery/MAKANAN-UTAMA.jpg',
  '/storage/galery/TEMPAT-DUDUK.jpg',
  '/storage/galery/INDOR-KASIR.jpg',
];

const startHeroTimer = () => {
  if (heroSlides.length <= 1) return;
  clearInterval(heroTimer);
  heroTimer = setInterval(() => {
    activeHero.value = (activeHero.value + 1) % heroSlides.length;
  }, 6500);
};

const stopHeroTimer = () => {
  clearInterval(heroTimer);
};

const setHeroSlide = (index) => {
  activeHero.value = index;
  startHeroTimer();
};

const nextHero = () => {
  activeHero.value = (activeHero.value + 1) % heroSlides.length;
  startHeroTimer();
};

const prevHero = () => {
  activeHero.value = (activeHero.value - 1 + heroSlides.length) % heroSlides.length;
  startHeroTimer();
};


const startCtaTimer = () => {
  if (ctaSlides.length <= 1) return;
  clearInterval(ctaTimer);
  ctaTimer = setInterval(() => {
    activeCta.value = (activeCta.value + 1) % ctaSlides.length;
  }, 7000);
};

const stopCtaTimer = () => {
  clearInterval(ctaTimer);
};

const drinks = computed(() => menuStore.drinks);
const foods = computed(() => menuStore.foods);

const handleAddToCart = (item) => {
  selectedMenu.value = item;
  showQuickAdd.value = true;
};

// Scroll Animation Observer
onMounted(() => {
  if (!menuStore.items.length) {
    menuStore.fetch();
  }
  startHeroTimer();
  startCtaTimer();

  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-in');
      }
    });
  }, observerOptions);

  // Observe all sections with scroll-animate class
  document.querySelectorAll('.scroll-animate').forEach(el => {
    observer.observe(el);
  });
});

onBeforeUnmount(() => {
  stopHeroTimer();
  stopCtaTimer();
});
</script>

<template>
  <div>
    <Navbar />
    
    <main class="main-content">
      <!-- Hero Section -->
      <section id="beranda" class="relative min-h-screen pt-16 lg:pt-0 overflow-hidden">
        <!-- Background Slider -->
        <div class="absolute inset-0">
          <div
            v-for="(slide, index) in heroSlides"
            :key="slide.id"
            class="absolute inset-0 bg-cover bg-center transition-all duration-1000 ease-out"
            :class="index === activeHero ? 'opacity-100 scale-100' : 'opacity-0 scale-105'"
            :style="{ backgroundImage: `url(${slide.image})` }"
          ></div>
          <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80"></div>
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.15),transparent_55%)]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-16 lg:py-24">
          <div class="grid lg:grid-cols-[1.05fr_0.95fr] gap-8 lg:gap-12 items-center">
            <div class="space-y-6">
              <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/15 backdrop-blur rounded-full text-white text-xs sm:text-sm">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span>Open Daily from 10 AM</span>
              </div>

              <div class="rounded-3xl border border-white/15 bg-black/35 backdrop-blur-xl p-6 sm:p-8 text-white shadow-2xl shadow-black/30">
                <p class="text-[10px] uppercase tracking-[0.4em] text-white/60">Calthea Cafe & Nature</p>
                <h1 class="font-serif text-3xl sm:text-4xl lg:text-6xl font-bold leading-tight mt-4">
                  Cafe & Nature
                  <span class="block text-white/80">Experience</span>
                  <span class="block text-xl sm:text-2xl lg:text-4xl mt-2 font-normal text-white/70">di Kota Batu</span>
                </h1>
                <p class="text-white/80 text-sm sm:text-base lg:text-lg leading-relaxed mt-4">
                  Nikmati secangkir kopi premium dengan suasana alam yang menenangkan. Pengalaman cafe unik di lereng Arjuno, Kota Batu.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 mt-6">
                  <Button
                    variant="primary"
                    icon="fa-coffee"
                    href="#menu"
                    size="sm"
                    class="!bg-white/95 !text-coffee-900 hover:!bg-white"
                  >
                    Lihat Menu
                  </Button>
                  <Button
                    variant="secondary"
                    icon="fa-calendar-check"
                    to="/reservasi"
                    size="sm"
                    class="!from-amber-400 !to-coffee-600 !text-white hover:!from-amber-500 hover:!to-coffee-700"
                  >
                    Reservasi Meja
                  </Button>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3 text-center">
                  <div class="rounded-2xl bg-white/10 border border-white/15 px-3 py-2">
                    <p class="text-lg font-semibold">460+</p>
                    <p class="text-[11px] text-white/70">Followers</p>
                  </div>
                  <div class="rounded-2xl bg-white/10 border border-white/15 px-3 py-2">
                    <p class="text-lg font-semibold">4.9</p>
                    <p class="text-[11px] text-white/70">Rating</p>
                  </div>
                  <div class="rounded-2xl bg-white/10 border border-white/15 px-3 py-2">
                    <p class="text-lg font-semibold">10 AM</p>
                    <p class="text-[11px] text-white/70">Open</p>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between gap-4 text-white/70">
                <div class="flex items-center gap-2">
                  <button
                    v-for="(slide, index) in heroSlides"
                    :key="slide.id"
                    @click="setHeroSlide(index)"
                    class="h-2.5 rounded-full transition-all"
                    :class="index === activeHero ? 'w-8 bg-white' : 'w-2.5 bg-white/40 hover:bg-white/70'"
                    aria-label="Pindah slide"
                  ></button>
                </div>
                <div class="text-xs">
                  {{ heroSlides[activeHero].title }} · {{ heroSlides[activeHero].subtitle }}
                </div>
              </div>
            </div>

            <div class="hidden lg:block">
              <div class="rounded-3xl border border-white/15 bg-white/10 backdrop-blur-xl p-5 text-white shadow-2xl shadow-black/30">
                <div class="flex items-center justify-between">
                  <div>
                    <p class="text-[10px] uppercase tracking-[0.3em] text-white/60">Gallery Slides</p>
                    <p class="text-base font-semibold">Highlight View</p>
                  </div>
                  <div class="flex items-center gap-2">
                    <button
                      class="h-9 w-9 rounded-full bg-white/15 border border-white/20 hover:bg-white/30 transition"
                      @click="prevHero"
                      aria-label="Slide sebelumnya"
                    >
                      <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button
                      class="h-9 w-9 rounded-full bg-white/15 border border-white/20 hover:bg-white/30 transition"
                      @click="nextHero"
                      aria-label="Slide berikutnya"
                    >
                      <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                  </div>
                </div>
                <div class="mt-4 space-y-3">
                  <button
                    v-for="(slide, index) in heroSlides"
                    :key="slide.id"
                    @click="setHeroSlide(index)"
                    class="w-full flex items-center gap-4 rounded-2xl border border-white/10 bg-white/10 p-3 hover:bg-white/20 transition"
                    :class="index === activeHero ? 'ring-1 ring-white/60' : ''"
                  >
                    <div
                      class="h-14 w-14 rounded-xl bg-cover bg-center"
                      :style="{ backgroundImage: `url(${slide.image})` }"
                    ></div>
                    <div class="text-left">
                      <p class="text-sm font-semibold">{{ slide.title }}</p>
                      <p class="text-xs text-white/60">{{ slide.subtitle }}</p>
                    </div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden lg:flex flex-col items-center gap-2 text-white/60">
          <span class="text-sm">Scroll</span>
          <div class="w-6 h-10 border-2 border-white/40 rounded-full flex justify-center pt-2">
            <div class="w-1.5 h-3 bg-white/70 rounded-full animate-bounce"></div>
          </div>
        </div>
      </section>

      <!-- Featured Menu Section -->
      <section id="menu" class="scroll-animate py-20 lg:py-32 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-coffee-100/50 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-beige-200/50 rounded-full -ml-24 -mb-24"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative">
          <SectionHeader 
            badge="Menu Pilihan"
            title="Menu Favorit Kami"
            subtitle="Minuman & makanan lezat dengan nuansa alam Kota Batu"
          />
          
          <!-- Drinks -->
          <div class="mb-12 scroll-animate">
            <h3 class="font-serif text-2xl font-bold text-coffee-800 mb-6 flex items-center gap-3">
              <i class="fas fa-mug-hot text-coffee-500"></i>
              Minuman
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-8">
              <MenuCard
                v-for="drink in drinks"
                :key="drink.id"
                :title="drink.name"
                :price="Number(drink.price)"
                :description="drink.description"
                :image="drink.image"
                :category="drink.category"
                :badge="drink.is_featured ? 'best-seller' : ''"
                @add-to-cart="handleAddToCart(drink)"
              />
            </div>
          </div>

          <!-- Foods -->
          <div class="mb-12 scroll-animate">
            <h3 class="font-serif text-2xl font-bold text-coffee-800 mb-6 flex items-center gap-3">
              <i class="fas fa-utensils text-coffee-500"></i>
              Makanan
            </h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-8">
              <MenuCard
                v-for="food in foods"
                :key="food.id"
                :title="food.name"
                :price="Number(food.price)"
                :description="food.description"
                :image="food.image"
                :category="food.category"
                :badge="food.is_featured ? 'favorit' : ''"
                @add-to-cart="handleAddToCart(food)"
              />
            </div>
          </div>

          <!-- View All -->
          <div class="text-center mt-12">
            <a 
              href="https://www.instagram.com/caltheabatu" 
              target="_blank" 
              class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-pink-500 to-orange-400 text-white font-semibold rounded-full hover:from-pink-600 hover:to-orange-500 hover:shadow-xl transition-all duration-300"
            >
              <i class="fab fa-instagram"></i>
              Lihat Menu Lengkap di Instagram
            </a>
          </div>
        </div>
      </section>

      <!-- Gallery Preview Section -->
      <section id="galeri-preview" class="scroll-animate py-20 lg:py-28 bg-cream-50 relative overflow-hidden">
        <div class="absolute -top-20 right-0 h-40 w-40 rounded-full bg-amber-100/60 blur-[70px]"></div>
        <div class="absolute bottom-0 left-0 h-48 w-48 rounded-full bg-coffee-100/60 blur-[80px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative">
          <SectionHeader
            badge="Galeri"
            title="Sekilas Suasana Calthea"
            subtitle="Lihat beberapa sudut favorit sebelum menjelajahi galeri lengkap."
          />

          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
            <div
              v-for="(image, index) in galleryPreview"
              :key="`${image}-${index}`"
              class="group relative overflow-hidden rounded-2xl bg-white shadow-sm"
            >
              <img :src="image" alt="Galeri Calthea" loading="lazy" class="w-full h-32 sm:h-40 object-cover group-hover:scale-105 transition-transform duration-500">
              <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
          </div>

          <div class="text-center mt-8">
            <Button
              variant="outline"
              icon="fa-images"
              to="/galeri"
              size="sm"
              class="!border-coffee-300 !text-coffee-700 hover:!border-coffee-500"
            >
              Lihat Galeri Lengkap
            </Button>
          </div>
        </div>
      </section>

      <!-- Reviews Section -->
      <section id="ulasan" class="scroll-animate py-20 lg:py-32 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
          <SectionHeader 
            badge="Testimoni"
            title="Apa Kata Mereka?"
            subtitle="Kepuasan pelanggan adalah prioritas utama kami."
          />
          
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            <!-- Review 1 -->
            <div class="bg-cream-50 rounded-2xl lg:rounded-3xl p-4 sm:p-6 lg:p-8 relative">
              <div class="absolute top-4 right-4 lg:top-6 lg:right-6 text-coffee-200 text-4xl lg:text-6xl font-serif">"</div>
              <div class="flex items-center gap-1 mb-3 lg:mb-4">
                <i v-for="i in 5" :key="i" class="fas fa-star text-yellow-500 text-xs lg:text-sm"></i>
              </div>
              <p class="text-coffee-700 text-sm lg:text-base leading-relaxed mb-4 lg:mb-6 relative z-10">
                "Kopi terbaik yang pernah saya coba! Suasananya sangat nyaman untuk bekerja atau hangout bersama teman. Pasti akan kembali lagi!"
              </p>
              <div class="flex items-center gap-3 lg:gap-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-coffee-200 rounded-full flex items-center justify-center">
                  <i class="fas fa-user text-coffee-600 text-sm lg:text-base"></i>
                </div>
                <div>
                  <div class="font-semibold text-coffee-900 text-sm lg:text-base">Andi Pratama</div>
                  <div class="text-coffee-500 text-xs lg:text-sm">Jakarta</div>
                </div>
              </div>
            </div>
            
            <!-- Review 2 -->
            <div class="bg-cream-50 rounded-2xl lg:rounded-3xl p-4 sm:p-6 lg:p-8 relative">
              <div class="absolute top-4 right-4 lg:top-6 lg:right-6 text-coffee-200 text-4xl lg:text-6xl font-serif">"</div>
              <div class="flex items-center gap-1 mb-3 lg:mb-4">
                <i v-for="i in 5" :key="i" class="fas fa-star text-yellow-500 text-xs lg:text-sm"></i>
              </div>
              <p class="text-coffee-700 text-sm lg:text-base leading-relaxed mb-4 lg:mb-6 relative z-10">
                "Caramel Latte-nya juara banget! Staff-nya ramah dan pelayanannya cepat. Tempatnya juga cocok untuk foto-foto aesthetic."
              </p>
              <div class="flex items-center gap-3 lg:gap-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-pink-200 rounded-full flex items-center justify-center">
                  <i class="fas fa-user text-pink-600 text-sm lg:text-base"></i>
                </div>
                <div>
                  <div class="font-semibold text-coffee-900 text-sm lg:text-base">Sarah Dewi</div>
                  <div class="text-coffee-500 text-xs lg:text-sm">Bandung</div>
                </div>
              </div>
            </div>
            
            <!-- Review 3 -->
            <div class="bg-cream-50 rounded-2xl lg:rounded-3xl p-4 sm:p-6 lg:p-8 relative md:col-span-2 lg:col-span-1">
              <div class="absolute top-4 right-4 lg:top-6 lg:right-6 text-coffee-200 text-4xl lg:text-6xl font-serif">"</div>
              <div class="flex items-center gap-1 mb-3 lg:mb-4">
                <i v-for="i in 5" :key="i" class="fas fa-star text-yellow-500 text-xs lg:text-sm"></i>
              </div>
              <p class="text-coffee-700 text-sm lg:text-base leading-relaxed mb-4 lg:mb-6 relative z-10">
                "Sebagai pecinta kopi, saya sangat terkesan dengan kualitas biji kopi yang digunakan. Aroma dan rasanya luar biasa. Worth it!"
              </p>
              <div class="flex items-center gap-3 lg:gap-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-200 rounded-full flex items-center justify-center">
                  <i class="fas fa-user text-blue-600 text-sm lg:text-base"></i>
                </div>
                <div>
                  <div class="font-semibold text-coffee-900 text-sm lg:text-base">Budi Santoso</div>
                  <div class="text-coffee-500 text-xs lg:text-sm">Surabaya</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Reservation CTA Section -->
      <section id="reservasi" class="scroll-animate py-20 lg:py-32 relative overflow-hidden">
        <div class="absolute inset-0">
          <div
            v-for="(slide, index) in ctaSlides"
            :key="slide.id"
            class="absolute inset-0 bg-cover bg-center transition-all duration-1000 ease-out"
            :class="index === activeCta ? 'opacity-100 scale-100' : 'opacity-0 scale-105'"
            :style="{ backgroundImage: `url(${slide.image})` }"
          ></div>
          <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80"></div>
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(255,255,255,0.15),transparent_55%)]"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 text-center">
          <span class="inline-block px-4 py-2 bg-white/15 text-white text-sm font-medium rounded-full mb-4 backdrop-blur">Reservasi Meja</span>
          <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">
            Siap Untuk Pengalaman<br>
            <span class="text-white/80">Kopi Terbaik?</span>
          </h2>
          <p class="text-white/80 text-lg mb-10 max-w-2xl mx-auto">
            Reservasi meja Anda sekarang dan nikmati suasana café yang nyaman bersama kopi premium kami.
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Button
              variant="primary"
              size="sm"
              icon="fa-calendar-check"
              to="/reservasi"
              class="!bg-white !text-coffee-900 !px-7 !py-3 !text-sm hover:!bg-white/90"
            >
              Reservasi Sekarang
            </Button>
            <Button
              variant="outline"
              size="sm"
              icon="fa-map-marker-alt"
              href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6"
              class="!border-white/70 !text-white !bg-white/15 !px-7 !py-3 !text-sm hover:!border-white hover:!bg-white/25"
            >
              Lihat Lokasi
            </Button>
          </div>
          
          <!-- Trust Badges -->
          <div class="flex flex-wrap items-center justify-center gap-8 mt-12 pt-8 border-t border-white/20">
            <div class="flex items-center gap-2 text-white/70">
              <i class="fas fa-shield-alt text-white/80"></i>
              <span class="text-sm">Pembayaran Aman</span>
            </div>
            <div class="flex items-center gap-2 text-white/70">
              <i class="fas fa-clock text-white/80"></i>
              <span class="text-sm">Respon Cepat</span>
            </div>
            <div class="flex items-center gap-2 text-white/70">
              <i class="fas fa-heart text-white/80"></i>
              <span class="text-sm">50K+ Pelanggan Puas</span>
            </div>
          </div>
        </div>
      </section>
    </main>

    <Footer />
    <MobileNav />
    <WhatsAppFloat />

    <button
      v-if="orderStore.itemCount > 0"
      @click="showOrderModal = true"
      class="fixed z-50 left-1/2 -translate-x-1/2 bottom-32 px-6 py-3 bg-coffee-600 hover:bg-coffee-700 text-white font-semibold rounded-full shadow-xl shadow-coffee-500/30 flex items-center gap-2"
    >
      <i class="fas fa-receipt"></i>
      <span>Pesanan ({{ orderStore.itemCount }})</span>
    </button>

    <QuickAddModal :open="showQuickAdd" :menu="selectedMenu" @close="showQuickAdd = false" />
    <OrderModal :open="showOrderModal" @close="showOrderModal = false" />
  </div>
</template>

<style scoped>
.main-content {
  padding-bottom: 5rem;
}

@media (min-width: 1024px) {
  .main-content {
    padding-bottom: 0;
  }
}

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

/* Scroll Animations */
.scroll-animate {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.scroll-animate.animate-in {
  opacity: 1;
  transform: translateY(0);
}

/* Stagger animation for menu cards */
.scroll-animate .grid > * {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.5s ease-out, transform 0.5s ease-out;
}

.scroll-animate.animate-in .grid > * {
  opacity: 1;
  transform: translateY(0);
}

.scroll-animate.animate-in .grid > *:nth-child(1) { transition-delay: 0.1s; }
.scroll-animate.animate-in .grid > *:nth-child(2) { transition-delay: 0.2s; }
.scroll-animate.animate-in .grid > *:nth-child(3) { transition-delay: 0.3s; }
.scroll-animate.animate-in .grid > *:nth-child(4) { transition-delay: 0.4s; }
.scroll-animate.animate-in .grid > *:nth-child(5) { transition-delay: 0.5s; }
.scroll-animate.animate-in .grid > *:nth-child(6) { transition-delay: 0.6s; }
.scroll-animate.animate-in .grid > *:nth-child(7) { transition-delay: 0.7s; }
.scroll-animate.animate-in .grid > *:nth-child(8) { transition-delay: 0.8s; }

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
