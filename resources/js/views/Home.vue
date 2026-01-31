<script setup>
import { onMounted, computed, ref } from 'vue';
import { useMenuStore } from '@/stores/menu';
import Navbar from '@components/layout/Navbar.vue';
import Footer from '@components/layout/Footer.vue';
import MobileNav from '@components/layout/MobileNav.vue';
import WhatsAppFloat from '@components/shared/WhatsAppFloat.vue';
import SectionHeader from '@components/shared/SectionHeader.vue';
import MenuCard from '@components/home/MenuCard.vue';
import Button from '@components/ui/Button.vue';
import OrderModal from '@components/shared/OrderModal.vue';
import { useOrderStore } from '@/stores/order';

const menuStore = useMenuStore();
const orderStore = useOrderStore();
const showOrderModal = ref(false);

const drinks = computed(() => menuStore.drinks);
const foods = computed(() => menuStore.foods);

const handleAddToCart = (item) => {
  orderStore.addItem(item);
  showOrderModal.value = true;
};

// Scroll Animation Observer
onMounted(() => {
  if (!menuStore.items.length) {
    menuStore.fetch();
  }

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
</script>

<template>
  <div>
    <Navbar />
    
    <main class="main-content">
      <!-- Hero Section -->
      <section id="beranda" class="relative min-h-screen flex items-center pt-16 lg:pt-0 overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-cream-100 via-cream-50 to-beige-100"></div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-coffee-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-beige-300/30 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 py-8 sm:py-12 lg:py-0">
          <div class="grid lg:grid-cols-2 gap-8 lg:gap-20 items-center">
            <!-- Content -->
            <div class="text-center lg:text-left order-2 lg:order-1">
              <div class="inline-flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-green-100 rounded-full mb-4 sm:mb-6">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-green-700 text-xs sm:text-sm font-medium">Open Daily from 10 AM 🌿</span>
              </div>
              
              <h1 class="font-serif text-3xl sm:text-4xl lg:text-6xl xl:text-7xl font-bold text-coffee-900 leading-tight mb-4 sm:mb-6">
                Cafe & Nature
                <span class="block text-coffee-600">Experience</span>
                <span class="block text-2xl sm:text-3xl lg:text-5xl mt-2 font-normal text-coffee-500">di Kota Batu</span>
              </h1>
              
              <p class="text-coffee-600 text-sm sm:text-base lg:text-xl leading-relaxed mb-6 sm:mb-8 max-w-lg mx-auto lg:mx-0">
                Nikmati secangkir kopi premium dengan suasana alam yang menenangkan. Pengalaman cafe unik di lereng Arjuno, Kota Batu.
              </p>
              
              <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                <Button variant="primary" icon="fa-coffee" href="#menu" size="sm" class="sm:!px-8 sm:!py-4 sm:!text-base">
                  Lihat Menu
                </Button>
                <Button variant="secondary" icon="fa-calendar-check" to="/reservasi" size="sm" class="sm:!px-8 sm:!py-4 sm:!text-base">
                  Reservasi Meja
                </Button>
              </div>
              
              <!-- Stats -->
              <div class="flex items-center justify-center lg:justify-start gap-4 sm:gap-8 mt-8 sm:mt-12 pt-6 sm:pt-8 border-t border-coffee-200">
                <div class="text-center">
                  <div class="font-serif text-2xl sm:text-3xl font-bold text-coffee-800">460+</div>
                  <div class="text-coffee-500 text-xs sm:text-sm">Followers</div>
                </div>
                <div class="w-px h-10 sm:h-12 bg-coffee-200"></div>
                <div class="text-center">
                  <a href="https://www.instagram.com/caltheabatu" target="_blank" class="flex items-center gap-1 text-pink-600 hover:text-pink-700">
                    <i class="fab fa-instagram text-xl sm:text-2xl"></i>
                  </a>
                  <div class="text-coffee-500 text-xs sm:text-sm">@caltheabatu</div>
                </div>
                <div class="w-px h-10 sm:h-12 bg-coffee-200"></div>
                <div class="text-center">
                  <a href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6" target="_blank" class="text-coffee-600 hover:text-coffee-800">
                    <i class="fas fa-map-marker-alt text-xl sm:text-2xl"></i>
                  </a>
                  <div class="text-coffee-500 text-xs sm:text-sm">Kota Batu</div>
                </div>
              </div>
            </div>
            
            <!-- Image -->
            <div class="order-1 lg:order-2 relative">
              <div class="relative">
                <div class="relative w-64 h-64 sm:w-80 sm:h-80 lg:w-[500px] lg:h-[500px] mx-auto">
                  <div class="absolute inset-0 bg-gradient-to-br from-coffee-200 to-coffee-300 rounded-full animate-float"></div>
                  <div class="absolute inset-4 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-inner p-3 sm:p-4 lg:p-6">
                    <img 
                      src="/images/logo-calthea.jpg" 
                      alt="Calthea" 
                      class="w-full h-full object-contain"
                    >
                  </div>
                  
                  <!-- Floating Badge 1 -->
                  <div class="absolute -left-2 sm:-left-4 top-1/4 bg-white rounded-xl sm:rounded-2xl p-2 sm:p-4 shadow-xl shadow-coffee-200/50 animate-float" style="animation-delay: 1s;">
                    <div class="flex items-center gap-2 sm:gap-3">
                      <div class="w-8 h-8 sm:w-12 sm:h-12 bg-coffee-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                        <i class="fas fa-leaf text-coffee-600 text-sm sm:text-xl"></i>
                      </div>
                      <div>
                        <div class="font-semibold text-coffee-800 text-sm sm:text-base">100%</div>
                        <div class="text-coffee-500 text-xs">Organik</div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Floating Badge 2 -->
                  <div class="absolute -right-2 sm:-right-4 bottom-1/4 bg-white rounded-xl sm:rounded-2xl p-2 sm:p-4 shadow-xl shadow-coffee-200/50 animate-float" style="animation-delay: 2s;">
                    <div class="flex items-center gap-2 sm:gap-3">
                      <div class="w-8 h-8 sm:w-12 sm:h-12 bg-yellow-100 rounded-lg sm:rounded-xl flex items-center justify-center">
                        <i class="fas fa-award text-yellow-600 text-sm sm:text-xl"></i>
                      </div>
                      <div>
                        <div class="font-semibold text-coffee-800 text-sm sm:text-base">Best</div>
                        <div class="text-coffee-500 text-xs">Quality</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden lg:flex flex-col items-center gap-2 text-coffee-400">
          <span class="text-sm">Scroll</span>
          <div class="w-6 h-10 border-2 border-coffee-300 rounded-full flex justify-center pt-2">
            <div class="w-1.5 h-3 bg-coffee-400 rounded-full animate-bounce"></div>
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
      <section id="reservasi" class="scroll-animate py-20 lg:py-32 bg-gradient-to-br from-coffee-100 via-cream-100 to-beige-100 relative overflow-hidden">
        <div class="absolute top-10 left-10 w-32 h-32 bg-coffee-200/50 rounded-full blur-2xl"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 bg-beige-300/50 rounded-full blur-3xl"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center relative">
          <span class="inline-block px-4 py-2 bg-coffee-600 text-white text-sm font-medium rounded-full mb-4">Reservasi Meja</span>
          <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-coffee-900 mb-6">
            Siap Untuk Pengalaman<br>
            <span class="text-coffee-600">Kopi Terbaik?</span>
          </h2>
          <p class="text-coffee-600 text-lg mb-10 max-w-2xl mx-auto">
            Reservasi meja Anda sekarang dan nikmati suasana café yang nyaman bersama kopi premium kami.
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Button variant="primary" size="lg" icon="fa-calendar-check" to="/reservasi">
              Reservasi Sekarang
            </Button>
            <Button variant="outline" size="lg" icon="fa-map-marker-alt" href="https://maps.app.goo.gl/4hWQprUNQM48X8rG6">
              Lihat Lokasi
            </Button>
          </div>
          
          <!-- Trust Badges -->
          <div class="flex flex-wrap items-center justify-center gap-8 mt-12 pt-8 border-t border-coffee-200">
            <div class="flex items-center gap-2 text-coffee-500">
              <i class="fas fa-shield-alt text-coffee-600"></i>
              <span class="text-sm">Pembayaran Aman</span>
            </div>
            <div class="flex items-center gap-2 text-coffee-500">
              <i class="fas fa-clock text-coffee-600"></i>
              <span class="text-sm">Respon Cepat</span>
            </div>
            <div class="flex items-center gap-2 text-coffee-500">
              <i class="fas fa-heart text-coffee-600"></i>
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
      class="fixed z-50 right-4 lg:right-8 bottom-28 lg:bottom-8 px-5 py-3 bg-coffee-600 hover:bg-coffee-700 text-white font-semibold rounded-full shadow-xl shadow-coffee-500/30 flex items-center gap-2"
    >
      <i class="fas fa-receipt"></i>
      <span>Pesan ({{ orderStore.itemCount }})</span>
    </button>

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
</style>
