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

const formatCurrency = (value) =>
  new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    maximumFractionDigits: 0,
  }).format(Number(value || 0));

const formatDateTime = (value) => {
  if (!value) return '-';
  return new Intl.DateTimeFormat('id-ID', {
    dateStyle: 'medium',
    timeStyle: 'short',
  }).format(new Date(value));
};

const buildQrPayload = (order) => {
  if (!order) return '';
  const items = (order.items || [])
    .map((item) => `${item.name} x${item.quantity}`)
    .join(', ');
  const payment = paymentLabel(order.payment_method);
  return `Order ${order.order_code} | Nama ${order.customer_name} | Meja ${order.table_number} | Bayar ${payment} | Total ${Number(order.total || 0)} | Items ${items}`;
};

const getQrUrl = (payload, size = 180) =>
  `https://api.qrserver.com/v1/create-qr-code/?size=${size}x${size}&data=${encodeURIComponent(payload)}`;

const printOrder = (order) => {
  if (!order) return;
  const qrPayload = buildQrPayload(order);
  const qrUrl = getQrUrl(qrPayload, 200);
  const itemsHtml = order.items
    .map(
      (item) =>
        `<tr>
          <td>${item.name}</td>
          <td style="text-align:center;">${item.quantity}</td>
          <td style="text-align:right;">${formatCurrency(item.price)}</td>
          <td style="text-align:right;">${formatCurrency(item.subtotal)}</td>
        </tr>`
    )
    .join('');

  const html = `
    <!doctype html>
    <html>
      <head>
        <title>Calthea Receipt</title>
        <style>
          body { font-family: Arial, sans-serif; margin: 24px; color: #3f2e25; }
          h2 { margin: 0 0 4px; }
          .meta { font-size: 12px; color: #7c6b5f; margin-bottom: 16px; }
          .receipt { border: 1px solid #eadfd6; border-radius: 12px; padding: 16px; }
          .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
          .label { font-size: 11px; color: #7c6b5f; text-transform: uppercase; letter-spacing: 0.08em; }
          .value { font-size: 13px; font-weight: 600; margin-top: 4px; }
          table { width: 100%; border-collapse: collapse; font-size: 12px; margin-top: 12px; }
          th, td { padding: 6px 0; border-bottom: 1px dashed #e4d7cc; }
          th { text-align: left; font-size: 11px; color: #7c6b5f; }
          .total { text-align: right; font-weight: bold; margin-top: 12px; font-size: 13px; }
          .qr { display: flex; justify-content: center; margin: 16px 0 6px; }
          .note { font-size: 12px; color: #5f4a3e; margin-top: 10px; }
        </style>
      </head>
      <body>
        <h2>Calthea Receipt</h2>
        <div class="meta">${formatDateTime(order.created_at)}</div>
        <div class="receipt">
          <div class="grid">
            <div>
              <div class="label">Order</div>
              <div class="value">${order.order_code}</div>
            </div>
            <div>
              <div class="label">Status</div>
              <div class="value">${statusLabel(order.status)}</div>
            </div>
            <div>
              <div class="label">Nama</div>
              <div class="value">${order.customer_name}</div>
            </div>
            <div>
              <div class="label">Meja</div>
              <div class="value">${order.table_number}</div>
            </div>
            <div>
              <div class="label">Pembayaran</div>
              <div class="value">${paymentLabel(order.payment_method)}</div>
            </div>
          </div>
          <table>
            <thead>
              <tr>
                <th>Item</th>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:right;">Harga</th>
                <th style="text-align:right;">Subtotal</th>
              </tr>
            </thead>
            <tbody>${itemsHtml}</tbody>
          </table>
          <div class="total">Total: ${formatCurrency(order.total)}</div>
          ${order.notes ? `<div class="note">Catatan: ${order.notes}</div>` : ''}
          <div class="qr"><img src="${qrUrl}" alt="QR Code" width="200" height="200"></div>
          <div class="meta" style="text-align:center;">Scan untuk detail pesanan</div>
        </div>
      </body>
    </html>
  `;

  const frame = document.createElement('iframe');
  frame.setAttribute('aria-hidden', 'true');
  frame.style.position = 'fixed';
  frame.style.right = '0';
  frame.style.bottom = '0';
  frame.style.width = '1px';
  frame.style.height = '1px';
  frame.style.border = '0';
  frame.style.opacity = '0';
  frame.srcdoc = html;
  document.body.appendChild(frame);

  const cleanup = () => {
    setTimeout(() => frame.remove(), 200);
  };

  const doPrint = () => {
    const win = frame.contentWindow;
    if (!win) {
      cleanup();
      return;
    }
    win.focus();
    win.print();
    cleanup();
  };

  frame.onload = () => {
    const doc = frame.contentDocument;
    if (!doc) {
      doPrint();
      return;
    }
    const images = Array.from(doc.images || []);
    if (images.length === 0) {
      doPrint();
      return;
    }
    let loaded = 0;
    const done = () => {
      loaded += 1;
      if (loaded >= images.length) {
        doPrint();
      }
    };
    images.forEach((img) => {
      if (img.complete) {
        done();
      } else {
        img.onload = done;
        img.onerror = done;
      }
    });
    setTimeout(doPrint, 1200);
  };
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

const paymentLabel = (method) => {
  const map = {
    qris: 'QRIS',
    cash: 'Cash',
  };
  return map[method] || 'Cash';
};

const statusClasses = (status) => {
  if (status === 'new') return 'bg-amber-100 text-amber-700';
  if (status === 'preparing') return 'bg-blue-100 text-blue-700';
  if (status === 'ready') return 'bg-emerald-100 text-emerald-700';
  if (status === 'completed') return 'bg-gray-200 text-gray-700';
  return 'bg-rose-100 text-rose-700';
};

const paymentClasses = (method) => {
  if (method === 'qris') {
    return 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-200';
  }
  return 'bg-slate-200 text-slate-700 dark:bg-white/10 dark:text-white';
};

const statusButtonClass = (status, current) => {
  if (status === current) {
    return 'bg-coffee-600 text-white border-transparent shadow-sm';
  }
  return 'bg-white/90 text-coffee-700 border border-coffee-200 hover:bg-coffee-50';
};
</script>

<template>
  <div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <div>
        <h2 class="text-xl font-bold font-serif text-admin-text-main-light dark:text-admin-text-main-dark">Pesanan</h2>
        <p class="text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark">Daftar pesanan masuk secara real-time.</p>
      </div>
      <div class="flex flex-wrap items-center gap-2">
        <div class="relative">
          <select
            v-model="statusFilter"
            @change="fetchOrders"
            class="appearance-none px-4 py-2 pr-10 rounded-2xl border border-white/50 dark:border-white/10 bg-admin-card-light/95 dark:bg-admin-card-dark/85 text-sm text-admin-text-main-light dark:text-admin-text-main-dark shadow-sm focus:outline-none focus:ring-2 focus:ring-admin-primary/20"
          >
            <option v-for="status in statusOptions" :key="status" :value="status">
              {{ status === 'all' ? 'All' : statusLabel(status) }}
            </option>
          </select>
          <span class="material-icons-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[18px] text-admin-text-muted-light">expand_more</span>
        </div>
        <button
          class="px-4 py-2 rounded-2xl bg-coffee-600 text-white text-sm font-semibold shadow-sm hover:bg-coffee-700"
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
        class="relative overflow-hidden rounded-3xl border border-white/50 dark:border-white/10 bg-admin-card-light/95 dark:bg-admin-card-dark/90 p-4 sm:p-5 shadow-[0_20px_50px_-35px_rgba(18,12,8,0.45)]"
      >
        <div class="absolute -top-20 right-0 h-44 w-44 rounded-full bg-amber-100/40 blur-[70px]"></div>
        <div class="relative flex items-start justify-between gap-4">
          <div class="space-y-2">
            <div class="flex items-center gap-2 text-[10px] uppercase tracking-[0.25em] text-slate-400">
              <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
              <span>Order</span>
              <span class="rounded-full bg-slate-200/80 px-2.5 py-1 text-[10px] font-semibold tracking-normal text-slate-700 dark:bg-white/10 dark:text-white">
                {{ order.order_code }}
              </span>
            </div>
            <p class="text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">{{ order.customer_name }}</p>
            <p class="text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark">
              Meja {{ order.table_number }} · {{ formatDateTime(order.created_at) }}
            </p>
          </div>

          <div class="flex flex-col sm:flex-row items-end gap-2">
            <span class="px-3 py-1 rounded-full text-xs font-semibold" :class="statusClasses(order.status)">
              {{ statusLabel(order.status) }}
            </span>
            <span class="px-3 py-1 rounded-full text-xs font-semibold" :class="paymentClasses(order.payment_method)">
              {{ paymentLabel(order.payment_method) }}
            </span>
          </div>
        </div>

        <div class="relative mt-4 grid grid-cols-2 gap-3">
          <div class="rounded-2xl bg-slate-50/90 dark:bg-white/5 p-3">
            <p class="text-[11px] text-slate-500">Total</p>
            <p class="mt-1 text-base font-semibold text-slate-900 dark:text-white">{{ formatCurrency(order.total) }}</p>
          </div>
          <div class="rounded-2xl bg-slate-50/90 dark:bg-white/5 p-3">
            <p class="text-[11px] text-slate-500">Item</p>
            <p class="mt-1 text-base font-semibold text-slate-900 dark:text-white">{{ order.items.length }}</p>
          </div>
        </div>

        <button
          class="relative mt-4 w-full rounded-2xl bg-coffee-600 text-white py-3 text-sm font-semibold shadow-sm hover:bg-coffee-700"
          @click="openOrder(order)"
        >
          Detail Pesanan
        </button>
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
      <div v-if="showModal" class="fixed inset-0 z-[70] flex items-end sm:items-center justify-center">
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
            <div class="flex items-center justify-between text-xs text-coffee-500">
              <span>{{ formatDateTime(selectedOrder?.created_at) }}</span>
              <span class="rounded-full bg-coffee-100 px-3 py-1 text-[11px] font-semibold text-coffee-700">
                Pembayaran: {{ paymentLabel(selectedOrder?.payment_method) }}
              </span>
            </div>
            <div class="rounded-2xl bg-cream-50 p-4 space-y-2">
              <div
                v-for="item in selectedOrder?.items || []"
                :key="item.menu_id"
                class="flex items-center justify-between text-sm text-coffee-800"
              >
                <span class="truncate">{{ item.name }}</span>
                <span class="text-xs text-coffee-500">{{ item.quantity }}x</span>
                <span class="font-semibold">{{ formatCurrency(item.subtotal) }}</span>
              </div>
            </div>
            <div class="rounded-2xl bg-white border border-coffee-100 p-4 text-center">
              <img
                v-if="selectedOrder"
                :src="getQrUrl(buildQrPayload(selectedOrder), 160)"
                alt="QR Code"
                class="mx-auto h-36 w-36 object-contain"
              />
              <p class="text-center text-xs text-coffee-500 mt-2">QR Code Pesanan</p>
            </div>
            <div class="rounded-2xl bg-cream-50 p-4">
              <p class="text-xs uppercase tracking-wide text-coffee-400">Ubah Status</p>
              <div class="mt-3 grid grid-cols-3 gap-2">
                <button
                  class="py-2 rounded-xl text-xs font-semibold transition"
                  :class="statusButtonClass('preparing', selectedOrder?.status)"
                  @click="updateStatus(selectedOrder, 'preparing')"
                >
                  Preparing
                </button>
                <button
                  class="py-2 rounded-xl text-xs font-semibold transition"
                  :class="statusButtonClass('ready', selectedOrder?.status)"
                  @click="updateStatus(selectedOrder, 'ready')"
                >
                  Ready
                </button>
                <button
                  class="py-2 rounded-xl text-xs font-semibold transition"
                  :class="statusButtonClass('completed', selectedOrder?.status)"
                  @click="updateStatus(selectedOrder, 'completed')"
                >
                  Done
                </button>
              </div>
            </div>
            <div v-if="selectedOrder?.notes" class="rounded-2xl bg-white border border-coffee-100 p-4">
              <p class="text-xs uppercase tracking-wide text-coffee-400">Catatan</p>
              <p class="text-sm text-coffee-700 mt-1">{{ selectedOrder.notes }}</p>
            </div>
            <div class="flex items-center justify-between text-sm font-semibold text-coffee-800">
              <span>Total</span>
              <span>{{ formatCurrency(selectedOrder?.total || 0) }}</span>
            </div>
          </div>
          <div class="px-6 py-4 border-t border-coffee-100">
            <button
              class="w-full py-3 bg-coffee-600 text-white font-semibold rounded-xl"
              @click="printOrder(selectedOrder)"
            >
              Print & QR
            </button>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>
