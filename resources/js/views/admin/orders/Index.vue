<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const orders = ref([]);
const loading = ref(true);
const statusFilter = ref('all');
const selectedOrder = ref(null);
const showModal = ref(false);

const statusOptions = ['all', 'new', 'preparing', 'ready', 'completed', 'cancelled'];

const fetchOrders = async () => {
  loading.value = true;
  try {
    const params = statusFilter.value === 'all' ? {} : { status: statusFilter.value };
    const response = await axios.get('/api/orders', { params });
    orders.value = response.data?.data || [];
  } catch (error) {
    console.error('Failed to fetch orders', error);
  } finally {
    loading.value = false;
  }
};

onMounted(fetchOrders);

const openOrder = (order) => {
  selectedOrder.value = order;
  showModal.value = true;
};

const closeOrder = () => {
  showModal.value = false;
  selectedOrder.value = null;
};

const updateStatus = async (order, status) => {
  try {
    await axios.patch(`/api/orders/${order.id}`, { status });
    order.status = status;
  } catch (error) {
    console.error('Failed to update status', error);
  }
};

const printOrder = (order) => {
  const printWindow = window.open('', '_blank', 'width=480,height=720');
  if (!printWindow) return;

  const itemsHtml = order.items
    .map(
      (item) =>
        `<tr><td>${item.name}</td><td style="text-align:center;">${item.quantity}</td><td style="text-align:right;">${item.subtotal.toLocaleString('id-ID')}</td></tr>`
    )
    .join('');

  printWindow.document.write(`
    <html>
      <head>
        <title>Kitchen Order</title>
        <style>
          body { font-family: Arial, sans-serif; margin: 24px; color: #3f2e25; }
          h2 { margin: 0 0 8px; }
          .meta { font-size: 12px; color: #7c6b5f; margin-bottom: 16px; }
          table { width: 100%; border-collapse: collapse; font-size: 12px; }
          th, td { padding: 6px 0; border-bottom: 1px dashed #e4d7cc; }
          .barcode { margin: 20px 0; height: 56px; background: repeating-linear-gradient(90deg, #3f2e25, #3f2e25 2px, transparent 2px, transparent 4px); border-radius: 6px; }
          .total { text-align: right; font-weight: bold; margin-top: 12px; }
        </style>
      </head>
      <body>
        <h2>Calthea Kitchen</h2>
        <div class="meta">Order: ${order.order_code} · Meja ${order.table_number} · ${order.customer_name}</div>
        <div class="barcode"></div>
        <table>
          <thead>
            <tr><th align="left">Item</th><th align="center">Qty</th><th align="right">Subtotal</th></tr>
          </thead>
          <tbody>${itemsHtml}</tbody>
        </table>
        <div class="total">Total: Rp ${Number(order.total).toLocaleString('id-ID')}</div>
      </body>
    </html>
  `);

  printWindow.document.close();
  printWindow.focus();
  printWindow.print();
};

const statusLabel = (status) => {
  const map = {
    new: 'New',
    preparing: 'Preparing',
    ready: 'Ready',
    completed: 'Completed',
    cancelled: 'Cancelled',
  };
  return map[status] || status;
};

const statusClasses = (status) => {
  if (status === 'new') return 'bg-amber-100 text-amber-700';
  if (status === 'preparing') return 'bg-blue-100 text-blue-700';
  if (status === 'ready') return 'bg-emerald-100 text-emerald-700';
  if (status === 'completed') return 'bg-gray-200 text-gray-700';
  return 'bg-rose-100 text-rose-700';
};
</script>

<template>
  <div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h2 class="text-xl font-bold font-serif text-admin-text-main-light dark:text-admin-text-main-dark">Pesanan</h2>
        <p class="text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark">Sample - Pengembangan Paket Lanjutan</p>
      </div>
      <div class="flex items-center gap-2">
        <select
          v-model="statusFilter"
          @change="fetchOrders"
          class="px-3 py-2 rounded-xl border border-coffee-200 bg-white text-sm"
        >
          <option v-for="status in statusOptions" :key="status" :value="status">
            {{ status === 'all' ? 'All' : statusLabel(status) }}
          </option>
        </select>
        <button
          class="px-4 py-2 rounded-xl bg-admin-primary text-white text-sm font-semibold"
          @click="fetchOrders"
        >
          Refresh
        </button>
      </div>
    </div>

    <div class="grid gap-4">
      <div v-if="loading" class="text-center text-sm text-gray-400 py-8">Loading orders...</div>
      <div v-else-if="orders.length === 0" class="text-center text-sm text-gray-400 py-8">Belum ada pesanan.</div>

      <div
        v-for="order in orders"
        :key="order.id"
        class="rounded-3xl border border-white/60 bg-white/80 p-4 shadow-soft"
      >
        <div class="flex items-start justify-between gap-3">
          <div>
            <p class="text-sm font-semibold text-coffee-900">{{ order.customer_name }}</p>
            <p class="text-xs text-coffee-500">Meja {{ order.table_number }} · {{ order.order_code }}</p>
          </div>
          <span class="px-3 py-1 rounded-full text-xs font-semibold" :class="statusClasses(order.status)">
            {{ statusLabel(order.status) }}
          </span>
        </div>

        <div class="mt-3 flex flex-wrap items-center gap-3 text-xs text-coffee-600">
          <span>{{ order.items.length }} item</span>
          <span>Total: Rp {{ Number(order.total).toLocaleString('id-ID') }}</span>
        </div>

        <div class="mt-4 flex flex-wrap items-center gap-2">
          <button
            class="px-3 py-2 rounded-xl bg-coffee-100 text-coffee-700 text-xs font-semibold"
            @click="openOrder(order)"
          >
            Detail
          </button>
          <button
            class="px-3 py-2 rounded-xl bg-coffee-600 text-white text-xs font-semibold"
            @click="printOrder(order)"
          >
            Print & Barcode
          </button>
          <div class="flex items-center gap-2">
            <button class="px-3 py-2 rounded-xl border border-coffee-200 text-xs" @click="updateStatus(order, 'preparing')">Preparing</button>
            <button class="px-3 py-2 rounded-xl border border-coffee-200 text-xs" @click="updateStatus(order, 'ready')">Ready</button>
            <button class="px-3 py-2 rounded-xl border border-coffee-200 text-xs" @click="updateStatus(order, 'completed')">Done</button>
          </div>
        </div>
      </div>
    </div>

    <Transition
      enter-active-class="transition ease-out duration-200"
      enter-from-class="opacity-0 translate-y-4"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition ease-in duration-150"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 translate-y-4"
    >
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-end sm:items-center justify-center">
        <div class="absolute inset-0 bg-black/40" @click="closeOrder"></div>
        <div class="relative w-full sm:max-w-xl max-h-[90vh] overflow-hidden bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl">
          <div class="flex items-center justify-between px-6 py-4 border-b border-coffee-100">
            <div>
              <p class="text-xs uppercase tracking-widest text-coffee-500 font-semibold">Detail Pesanan</p>
              <h3 class="font-serif text-xl font-bold text-coffee-900">{{ selectedOrder?.order_code }}</h3>
            </div>
            <button @click="closeOrder" class="w-9 h-9 rounded-full bg-coffee-100 text-coffee-600">
              <i class="fas fa-times"></i>
            </button>
          </div>

          <div class="p-6 space-y-4 overflow-y-auto max-h-[70vh]">
            <div class="flex items-center justify-between text-sm text-coffee-700">
              <span>{{ selectedOrder?.customer_name }}</span>
              <span>Meja {{ selectedOrder?.table_number }}</span>
            </div>
            <div class="rounded-2xl bg-cream-50 p-4">
              <div
                v-for="item in selectedOrder?.items || []"
                :key="item.menu_id"
                class="flex items-center justify-between text-sm text-coffee-800 py-1"
              >
                <span>{{ item.name }}</span>
                <span>{{ item.quantity }}x</span>
              </div>
            </div>
            <div class="rounded-2xl bg-white border border-coffee-100 p-4">
              <div class="h-14 rounded-lg" style="background: repeating-linear-gradient(90deg, #3f2e25, #3f2e25 2px, transparent 2px, transparent 4px);"></div>
              <p class="text-center text-xs text-coffee-500 mt-2">Barcode Kitchen</p>
            </div>
            <div class="flex items-center justify-between text-sm font-semibold text-coffee-800">
              <span>Total</span>
              <span>Rp {{ Number(selectedOrder?.total || 0).toLocaleString('id-ID') }}</span>
            </div>
          </div>
          <div class="px-6 py-4 border-t border-coffee-100">
            <button
              class="w-full py-3 bg-coffee-600 text-white font-semibold rounded-xl"
              @click="printOrder(selectedOrder)"
            >
              Print & Barcode
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>
