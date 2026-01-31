<script setup>
import { ref, computed, watch } from 'vue';
import { useOrderStore } from '@/stores/order';
import SweetAlert from '@components/shared/SweetAlert.vue';

const props = defineProps({
  open: { type: Boolean, default: false },
  menu: { type: Object, default: null },
});

const emit = defineEmits(['close']);
const orderStore = useOrderStore();
const qty = ref(1);
const alertOpen = ref(false);
const alertKey = ref(0);
const alertTitle = ref('Berhasil ditambahkan');
const alertMessage = ref('Silakan pilih menu lain dari daftar.');

const priceLabel = computed(() => {
  const price = Number(props.menu?.price || 0);
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(price);
});

const closeModal = () => {
  alertOpen.value = false;
  qty.value = 1;
  emit('close');
};

const addToOrder = () => {
  if (!props.menu) return;
  orderStore.addItem(props.menu, qty.value);
  alertKey.value += 1;
  alertOpen.value = true;
  emit('close');
};

watch(
  () => props.open,
  (open) => {
    if (open) {
      qty.value = 1;
      alertOpen.value = false;
    }
  }
);
</script>

<template>
  <Teleport to="body">
    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div v-if="open" class="fixed inset-0 z-[70] flex items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="closeModal"></div>
        <div class="relative w-[92%] max-w-sm bg-white rounded-3xl shadow-2xl overflow-hidden">
          <div class="px-6 py-5 border-b border-coffee-100">
            <p class="text-xs uppercase tracking-widest text-coffee-500 font-semibold">Tambah Menu</p>
            <h3 class="font-serif text-xl font-bold text-coffee-900 truncate">{{ menu?.name }}</h3>
            <p class="text-sm text-coffee-500">{{ priceLabel }}</p>
          </div>

          <div class="px-6 py-5 space-y-4">
            <div class="flex items-center justify-between bg-cream-50 rounded-2xl p-3">
              <span class="text-sm font-semibold text-coffee-700">Jumlah</span>
              <div class="flex items-center gap-2">
                <button class="w-9 h-9 rounded-full bg-white border border-coffee-200" @click="qty = Math.max(1, qty - 1)">
                  <i class="fas fa-minus text-xs text-coffee-600"></i>
                </button>
                <input
                  v-model.number="qty"
                  type="number"
                  min="1"
                  class="w-12 text-center text-sm font-semibold bg-white border border-coffee-200 rounded-lg"
                />
                <button class="w-9 h-9 rounded-full bg-white border border-coffee-200" @click="qty = qty + 1">
                  <i class="fas fa-plus text-xs text-coffee-600"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="px-6 py-4 border-t border-coffee-100 flex gap-3">
            <button
              class="flex-1 py-3 bg-coffee-600 hover:bg-coffee-700 text-white font-semibold rounded-xl transition"
              @click="addToOrder"
            >
              Tambah
            </button>
            <button
              class="flex-1 py-3 border-2 border-coffee-200 text-coffee-700 font-semibold rounded-xl"
              @click="closeModal"
            >
              Tutup
            </button>
          </div>
        </div>
      </div>
    </Transition>

    <SweetAlert
      :key="alertKey"
      :open="alertOpen"
      type="success"
      :title="alertTitle"
      :message="alertMessage"
      :auto-close="true"
      @close="alertOpen = false"
    />
  </Teleport>
</template>
