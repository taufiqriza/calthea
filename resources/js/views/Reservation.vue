<script setup>
import { ref } from 'vue';
import Navbar from '@components/layout/Navbar.vue';
import Footer from '@components/layout/Footer.vue';
import MobileNav from '@components/layout/MobileNav.vue';
import WhatsAppFloat from '@components/shared/WhatsAppFloat.vue';

const form = ref({
  name: '',
  phone: '',
  email: '',
  date: '',
  time: '',
  guests: 2,
  notes: ''
});

const isSubmitting = ref(false);
const showSuccess = ref(false);

const submitReservation = async () => {
  isSubmitting.value = true;
  
  // Simulate API call
  setTimeout(() => {
    isSubmitting.value = false;
    showSuccess.value = true;
    
    // Reset form
    form.value = {
      name: '',
      phone: '',
      email: '',
      date: '',
      time: '',
      guests: 2,
      notes: ''
    };
    
    // Hide success message after 5s
    setTimeout(() => {
      showSuccess.value = false;
    }, 5000);
  }, 1500);
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
            Reservasi Meja
          </span>
          <h1 class="font-serif text-4xl lg:text-5xl font-bold text-coffee-900 mb-4">
            Reservasi Meja Anda
          </h1>
          <p class="text-coffee-600 text-lg max-w-2xl mx-auto">
            Pastikan tempat Anda dengan reservasi online. Kami akan konfirmasi via WhatsApp.
          </p>
        </div>
      </section>

      <!-- Success Message -->
      <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-4"
      >
        <div v-if="showSuccess" class="max-w-2xl mx-auto px-4 sm:px-6 -mt-6 mb-6">
          <div class="bg-green-50 border-2 border-green-200 rounded-2xl p-6 flex items-start gap-4">
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
              <i class="fas fa-check text-white text-xl"></i>
            </div>
            <div class="flex-1">
              <h3 class="font-semibold text-green-900 mb-1">Reservasi Berhasil!</h3>
              <p class="text-green-700 text-sm">
                Kami akan menghubungi Anda via WhatsApp untuk konfirmasi. Terima kasih!
              </p>
            </div>
          </div>
        </div>
      </Transition>

      <!-- Reservation Form -->
      <section class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">
          <form @submit.prevent="submitReservation" class="bg-white rounded-3xl p-6 lg:p-10 shadow-xl">
            <!-- Name -->
            <div class="mb-6">
              <label class="block text-coffee-900 font-semibold mb-2">
                Nama Lengkap <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.name"
                type="text"
                required
                placeholder="Masukkan nama Anda"
                class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none"
              >
            </div>

            <!-- Phone -->
            <div class="mb-6">
              <label class="block text-coffee-900 font-semibold mb-2">
                Nomor WhatsApp <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.phone"
                type="tel"
                required
                placeholder="08xxxxxxxxxx"
                class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none"
              >
            </div>

            <!-- Email -->
            <div class="mb-6">
              <label class="block text-coffee-900 font-semibold mb-2">
                Email (Opsional)
              </label>
              <input
                v-model="form.email"
                type="email"
                placeholder="email@example.com"
                class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none"
              >
            </div>

            <!-- Date & Time -->
            <div class="grid sm:grid-cols-2 gap-6 mb-6">
              <div>
                <label class="block text-coffee-900 font-semibold mb-2">
                  Tanggal <span class="text-red-500">*</span>
                </label>
                <input
                  v-model="form.date"
                  type="date"
                  required
                  :min="new Date().toISOString().split('T')[0]"
                  class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none"
                >
              </div>
              <div>
                <label class="block text-coffee-900 font-semibold mb-2">
                  Waktu <span class="text-red-500">*</span>
                </label>
                <input
                  v-model="form.time"
                  type="time"
                  required
                  class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none"
                >
              </div>
            </div>

            <!-- Number of Guests -->
            <div class="mb-6">
              <label class="block text-coffee-900 font-semibold mb-2">
                Jumlah Tamu <span class="text-red-500">*</span>
              </label>
              <div class="flex items-center gap-4">
                <button
                  type="button"
                  @click="form.guests = Math.max(1, form.guests - 1)"
                  class="w-12 h-12 bg-coffee-100 hover:bg-coffee-200 rounded-xl flex items-center justify-center text-coffee-700 font-bold transition"
                >
                  <i class="fas fa-minus"></i>
                </button>
                <input
                  v-model.number="form.guests"
                  type="number"
                  min="1"
                  max="50"
                  required
                  class="flex-1 px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none text-center font-semibold text-xl"
                >
                <button
                  type="button"
                  @click="form.guests = Math.min(50, form.guests + 1)"
                  class="w-12 h-12 bg-coffee-100 hover:bg-coffee-200 rounded-xl flex items-center justify-center text-coffee-700 font-bold transition"
                >
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>

            <!-- Notes -->
            <div class="mb-8">
              <label class="block text-coffee-900 font-semibold mb-2">
                Catatan Khusus (Opsional)
              </label>
              <textarea
                v-model="form.notes"
                rows="4"
                placeholder="Contoh: Meja dekat jendela, ada yang alergi, dll"
                class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none resize-none"
              ></textarea>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              :disabled="isSubmitting"
              class="w-full py-4 bg-coffee-600 hover:bg-coffee-700 disabled:bg-coffee-300 text-white font-bold text-lg rounded-xl transition-all duration-300 flex items-center justify-center gap-2"
            >
              <i v-if="!isSubmitting" class="fas fa-calendar-check"></i>
              <i v-else class="fas fa-spinner fa-spin"></i>
              <span>{{ isSubmitting ? 'Mengirim...' : 'Reservasi Sekarang' }}</span>
            </button>

            <p class="text-center text-coffee-500 text-sm mt-4">
              <i class="fas fa-info-circle mr-1"></i>
              Kami akan konfirmasi reservasi Anda via WhatsApp
            </p>
          </form>
        </div>
      </section>

      <!-- Info Section -->
      <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
          <h2 class="font-serif text-2xl lg:text-3xl font-bold text-coffee-900 text-center mb-8">
            Informasi Penting
          </h2>
          <div class="grid md:grid-cols-2 gap-6">
            <div class="flex gap-4">
              <div class="w-12 h-12 bg-coffee-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-clock text-coffee-600"></i>
              </div>
              <div>
                <h3 class="font-semibold text-coffee-900 mb-1">Jam Operasional</h3>
                <p class="text-coffee-600 text-sm">Setiap hari, 10:00 - 22:00 WIB</p>
              </div>
            </div>

            <div class="flex gap-4">
              <div class="w-12 h-12 bg-coffee-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-coffee-600"></i>
              </div>
              <div>
                <h3 class="font-semibold text-coffee-900 mb-1">Kapasitas</h3>
                <p class="text-coffee-600 text-sm">Maksimal 50 orang per reservasi</p>
              </div>
            </div>

            <div class="flex gap-4">
              <div class="w-12 h-12 bg-coffee-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-ban-smoking text-coffee-600"></i>
              </div>
              <div>
                <h3 class="font-semibold text-coffee-900 mb-1">Area Bebas Rokok</h3>
                <p class="text-coffee-600 text-sm">Seluruh area indoor bebas asap rokok</p>
              </div>
            </div>

            <div class="flex gap-4">
              <div class="w-12 h-12 bg-coffee-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-wifi text-coffee-600"></i>
              </div>
              <div>
                <h3 class="font-semibold text-coffee-900 mb-1">WiFi Gratis</h3>
                <p class="text-coffee-600 text-sm">Internet cepat untuk bekerja & browsing</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <Footer />
    <MobileNav />
    <WhatsAppFloat />
  </div>
</template>
