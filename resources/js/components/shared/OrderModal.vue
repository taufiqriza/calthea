<script setup>
import { ref, computed, watch } from 'vue';
import { useOrderStore } from '@/stores/order';

const props = defineProps({
  open: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['close']);
const orderStore = useOrderStore();

const form = ref({
  customer_name: '',
  table_number: '',
  notes: '',
});

const formattedTotal = computed(() =>
  new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(orderStore.total)
);

const closeModal = () => {
  emit('close');
};

const submitOrder = async () => {
  await orderStore.submit(form.value);
  form.value = {
    customer_name: '',
    table_number: '',
    notes: '',
  };
  closeModal();
};

watch(
  () => props.open,
  (open) => {
    if (open) {
      orderStore.error = null;
    }
  }
);
</script>

<template>
  <Teleport to="body">
    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 translate-y-4"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-4"
    >
      <div v-if="open" class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="closeModal"></div>

        <div class="relative w-full sm:max-w-xl max-h-[90vh] overflow-hidden bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl shadow-black/25">
          <div class="flex items-center justify-between px-6 py-4 border-b border-coffee-100">
            <div>
              <p class="text-xs uppercase tracking-widest text-coffee-500 font-semibold">Pesanan</p>
              <h3 class="font-serif text-xl font-bold text-coffee-900">Detail Pesanan</h3>
            </div>
            <button
              @click="closeModal"
              class="w-9 h-9 rounded-full bg-coffee-100 text-coffee-600 hover:bg-coffee-200 transition"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>

          <div class="px-6 py-5 space-y-5 overflow-y-auto max-h-[70vh]">
            <div v-if="orderStore.items.length === 0" class="text-center text-coffee-500">
              <i class="fas fa-cart-plus text-3xl mb-3"></i>
              <p>Belum ada menu yang dipilih.</p>
            </div>

            <div v-else class="space-y-3">
              <div
                v-for="item in orderStore.items"
                :key="item.menu_id"
                class="flex items-center justify-between bg-cream-50 rounded-2xl p-3"
              >
                <div class="min-w-0">
                  <p class="font-semibold text-coffee-900 truncate">{{ item.name }}</p>
                  <p class="text-xs text-coffee-500">
                    {{ new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(item.price) }}
                  </p>
                </div>
                <div class="flex items-center gap-2">
                  <button
                    class="w-8 h-8 rounded-full bg-white text-coffee-600 border border-coffee-200"
                    @click="orderStore.updateQty(item.menu_id, item.quantity - 1)"
                  >
                    <i class="fas fa-minus text-xs"></i>
                  </button>
                  <input
                    type="number"
                    min="1"
                    class="w-12 text-center text-sm font-semibold bg-white border border-coffee-200 rounded-lg"
                    v-model.number="item.quantity"
                    @change="orderStore.updateQty(item.menu_id, item.quantity)"
                  />
                  <button
                    class="w-8 h-8 rounded-full bg-white text-coffee-600 border border-coffee-200"
                    @click="orderStore.updateQty(item.menu_id, item.quantity + 1)"
                  >
                    <i class="fas fa-plus text-xs"></i>
                  </button>
                  <button
                    class="w-8 h-8 rounded-full bg-red-50 text-red-500"
                    @click="orderStore.removeItem(item.menu_id)"
                  >
                    <i class="fas fa-trash text-xs"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-semibold text-coffee-800 mb-2">Nama</label>
                <input
                  v-model="form.customer_name"
                  type="text"
                  required
                  placeholder="Nama pelanggan"
                  class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none"
                />
              </div>
              <div>
                <label class="block text-sm font-semibold text-coffee-800 mb-2">Nomor Meja</label>
                <input
                  v-model="form.table_number"
                  type="text"
                  required
                  placeholder="Contoh: A1"
                  class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none"
                />
              </div>
            </div>

            <div>
              <label class="block text-sm font-semibold text-coffee-800 mb-2">Catatan (Opsional)</label>
              <textarea
                v-model="form.notes"
                rows="3"
                class="w-full px-4 py-3 rounded-xl border-2 border-coffee-200 focus:border-coffee-500 focus:outline-none resize-none"
                placeholder="Tambahan request..."
              ></textarea>
            </div>

            <div class="flex items-center justify-between bg-coffee-50 rounded-2xl px-4 py-3">
              <span class="text-sm font-semibold text-coffee-700">Total</span>
              <span class="text-lg font-bold text-coffee-800">{{ formattedTotal }}</span>
            </div>

            <p v-if="orderStore.error" class="text-sm text-red-500">{{ orderStore.error }}</p>
          </div>

          <div class="px-6 py-4 border-t border-coffee-100">
            <button
              class="w-full py-3 bg-coffee-600 hover:bg-coffee-700 text-white font-semibold rounded-xl transition disabled:bg-coffee-300"
              :disabled="orderStore.items.length === 0 || orderStore.submitting"
              @click="submitOrder"
            >
              <span v-if="!orderStore.submitting">Kirim Pesanan</span>
              <span v-else>Mengirim...</span>
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>
