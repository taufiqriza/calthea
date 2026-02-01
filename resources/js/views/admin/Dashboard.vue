<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { RouterLink } from 'vue-router';

const orders = ref([]);
const menus = ref([]);
const loadingOrders = ref(true);
const loadingMenus = ref(true);

const fetchOrders = async () => {
  loadingOrders.value = true;
  try {
    const response = await axios.get('/api/orders');
    orders.value = response.data?.data || [];
  } catch (error) {
    console.error('Failed to fetch orders', error);
  } finally {
    loadingOrders.value = false;
  }
};

const fetchMenus = async () => {
  loadingMenus.value = true;
  try {
    const response = await axios.get('/api/menu?all=true');
    menus.value = response.data?.data || [];
  } catch (error) {
    console.error('Failed to fetch menus', error);
  } finally {
    loadingMenus.value = false;
  }
};

onMounted(() => {
  fetchOrders();
  fetchMenus();
});

const handleRefresh = () => {
  fetchOrders();
  fetchMenus();
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

const statusLabel = (status) => {
  const map = {
    new: 'Baru',
    preparing: 'Preparing',
    ready: 'Ready',
    completed: 'Selesai',
    cancelled: 'Batal',
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

const orderCount = computed(() => orders.value.length);
const totalRevenue = computed(() => orders.value.reduce((sum, order) => sum + Number(order.total || 0), 0));
const avgTicket = computed(() => (orderCount.value ? totalRevenue.value / orderCount.value : 0));

const newOrders = computed(() => orders.value.filter((order) => order.status === 'new').length);
const preparingOrders = computed(() => orders.value.filter((order) => order.status === 'preparing').length);
const readyOrders = computed(() => orders.value.filter((order) => order.status === 'ready').length);
const completedOrders = computed(() => orders.value.filter((order) => order.status === 'completed').length);

const menuCount = computed(() => menus.value.length);
const activeMenuCount = computed(() =>
  menus.value.filter((menu) => menu.is_available === true || menu.is_available === 1 || menu.is_available === '1').length
);

const recentOrders = computed(() => orders.value.slice(0, 6));

const menuActiveRatio = computed(() =>
  menuCount.value ? Math.round((activeMenuCount.value / menuCount.value) * 100) : 0
);

const summaryCards = computed(() => [
  {
    key: 'orders',
    label: 'Total Pesanan',
    value: orderCount.value,
    meta: `${newOrders.value} pesanan baru`,
    icon: 'receipt_long',
    tone: 'amber',
    loading: loadingOrders.value,
  },
  {
    key: 'revenue',
    label: 'Total Pendapatan',
    value: formatCurrency(totalRevenue.value),
    meta: 'Semua pesanan masuk',
    icon: 'payments',
    tone: 'emerald',
    loading: loadingOrders.value,
  },
  {
    key: 'avg',
    label: 'Rata-rata Transaksi',
    value: formatCurrency(avgTicket.value),
    meta: 'Per pesanan',
    icon: 'insights',
    tone: 'blue',
    loading: loadingOrders.value,
  },
  {
    key: 'menu',
    label: 'Menu Aktif',
    value: activeMenuCount.value,
    meta: `Dari ${menuCount.value} menu`,
    icon: 'restaurant_menu',
    tone: 'coffee',
    loading: loadingMenus.value,
  },
]);

const statusSummary = computed(() => [
  { label: 'Baru', value: newOrders.value, tone: 'amber' },
  { label: 'Preparing', value: preparingOrders.value, tone: 'blue' },
  { label: 'Ready', value: readyOrders.value, tone: 'emerald' },
  { label: 'Selesai', value: completedOrders.value, tone: 'gray' },
]);

const statusPercent = (value) => (orderCount.value ? Math.round((value / orderCount.value) * 100) : 0);

const toneDotClass = (tone) => {
  const map = {
    amber: 'bg-amber-500',
    emerald: 'bg-emerald-500',
    blue: 'bg-blue-500',
    coffee: 'bg-coffee-500',
    gray: 'bg-gray-400',
  };
  return map[tone] || 'bg-coffee-500';
};

const toneIconClass = (tone) => {
  const map = {
    amber: 'bg-amber-100 text-amber-700',
    emerald: 'bg-emerald-100 text-emerald-700',
    blue: 'bg-blue-100 text-blue-700',
    coffee: 'bg-coffee-100 text-coffee-700',
    gray: 'bg-gray-100 text-gray-600',
  };
  return map[tone] || 'bg-coffee-100 text-coffee-700';
};

const toneBarClass = (tone) => {
  const map = {
    amber: 'bg-amber-500',
    emerald: 'bg-emerald-500',
    blue: 'bg-blue-500',
    coffee: 'bg-coffee-500',
    gray: 'bg-gray-400',
  };
  return map[tone] || 'bg-coffee-500';
};
</script>

<template>
  <div class="space-y-6">
    <section class="space-y-3">
      <div class="flex items-center justify-between px-1">
        <div>
          <p class="text-[11px] uppercase tracking-[0.3em] text-admin-text-muted-light dark:text-admin-text-muted-dark">Ringkasan</p>
          <h2 class="text-lg sm:text-xl font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Overview Hari Ini</h2>
        </div>
        <button
          class="rounded-full border border-coffee-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-admin-text-main-light hover:bg-white"
          @click="handleRefresh"
        >
          Refresh
        </button>
      </div>

      <div class="flex gap-3 overflow-x-auto snap-x snap-mandatory pb-2 -mx-4 px-4 sm:mx-0 sm:px-0 sm:grid sm:grid-cols-2 xl:grid-cols-4 sm:overflow-visible scrollbar-hide">
        <div
          v-for="card in summaryCards"
          :key="card.key"
          class="min-w-[70%] sm:min-w-0 snap-center rounded-2xl border border-coffee-100/80 bg-white/95 dark:bg-admin-card-dark/90 p-4 shadow-[0_12px_30px_-24px_rgba(26,16,10,0.35)]"
        >
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
              <span class="h-2 w-2 rounded-full" :class="toneDotClass(card.tone)"></span>
              <p class="text-xs font-semibold text-admin-text-muted-light dark:text-admin-text-muted-dark">
                {{ card.label }}
              </p>
            </div>
            <span class="h-9 w-9 rounded-xl inline-flex items-center justify-center" :class="toneIconClass(card.tone)">
              <span class="material-icons-outlined text-[18px]">{{ card.icon }}</span>
            </span>
          </div>
          <p
            class="mt-3 text-2xl font-semibold text-admin-text-main-light dark:text-admin-text-main-dark"
            :class="card.loading ? 'animate-pulse text-admin-text-muted-light' : ''"
          >
            {{ card.loading ? '...' : card.value }}
          </p>
          <p class="mt-1 text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark">{{ card.meta }}</p>
        </div>
      </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-3">
      <div class="lg:col-span-2 rounded-3xl border border-coffee-100/80 bg-white/95 dark:bg-admin-card-dark/90 p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <div>
            <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Pesanan Terbaru</h3>
            <p class="text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark">Update otomatis dari pesanan masuk</p>
          </div>
          <RouterLink
            to="/admin/orders"
            class="rounded-full border border-coffee-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-admin-text-main-light hover:bg-white"
          >
            Lihat semua
          </RouterLink>
        </div>

        <div class="mt-4">
          <div v-if="loadingOrders" class="text-center text-sm text-admin-text-muted-light py-8">Memuat data pesanan...</div>
          <div v-else-if="recentOrders.length === 0" class="text-center text-sm text-admin-text-muted-light py-8">Belum ada pesanan.</div>

          <div v-else>
            <div class="space-y-3 md:hidden">
              <div
                v-for="order in recentOrders"
                :key="order.id"
                class="rounded-2xl border border-coffee-100/70 bg-white/95 p-4 shadow-sm"
              >
                <div class="flex items-start justify-between gap-3">
                  <div>
                    <p class="font-semibold text-admin-text-main-light">{{ order.customer_name }}</p>
                    <p class="text-xs text-admin-text-muted-light">{{ order.order_code }} · Meja {{ order.table_number }}</p>
                    <p class="text-xs text-admin-text-muted-light mt-1">{{ formatDateTime(order.created_at) }}</p>
                  </div>
                  <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold" :class="statusClasses(order.status)">
                    {{ statusLabel(order.status) }}
                  </span>
                </div>
                <div class="mt-3 flex items-center justify-between text-sm">
                  <span class="text-admin-text-muted-light">Total</span>
                  <span class="font-semibold text-admin-text-main-light">{{ formatCurrency(order.total) }}</span>
                </div>
              </div>
            </div>

            <div class="hidden md:block overflow-x-auto">
              <table class="min-w-[620px] w-full text-left text-sm">
                <thead class="text-[11px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark">
                  <tr class="border-b border-coffee-100/70 dark:border-white/10">
                    <th class="py-3">Order</th>
                    <th class="py-3">Waktu</th>
                    <th class="py-3">Total</th>
                    <th class="py-3 text-right">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-coffee-100/70 dark:divide-white/10">
                  <tr v-for="order in recentOrders" :key="order.id" class="hover:bg-coffee-50/70 dark:hover:bg-white/5">
                    <td class="py-4">
                      <div class="font-semibold text-admin-text-main-light dark:text-admin-text-main-dark truncate max-w-[220px]">
                        {{ order.customer_name }}
                      </div>
                      <div class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">
                        {{ order.order_code }} · Meja {{ order.table_number }}
                      </div>
                    </td>
                    <td class="py-4 text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">
                      {{ formatDateTime(order.created_at) }}
                    </td>
                    <td class="py-4 font-semibold text-admin-text-main-light dark:text-admin-text-main-dark whitespace-nowrap">
                      {{ formatCurrency(order.total) }}
                    </td>
                    <td class="py-4 text-right">
                      <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold" :class="statusClasses(order.status)">
                        {{ statusLabel(order.status) }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="space-y-6">
        <div class="rounded-3xl border border-coffee-100/80 bg-white/95 dark:bg-admin-card-dark/90 p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Status Pesanan</h3>
              <p class="text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1">Ringkasan status hari ini</p>
            </div>
            <span class="text-xs text-admin-text-muted-light">{{ orderCount }} pesanan</span>
          </div>

          <div class="mt-4 space-y-3">
            <div
              v-for="item in statusSummary"
              :key="item.label"
              class="rounded-2xl border border-coffee-100/70 bg-white/90 p-3"
            >
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <span class="h-2 w-2 rounded-full" :class="toneDotClass(item.tone)"></span>
                  <span class="text-sm text-admin-text-muted-light">{{ item.label }}</span>
                </div>
                <span class="text-sm font-semibold text-admin-text-main-light">{{ item.value }}</span>
              </div>
              <div class="mt-2 h-1.5 rounded-full bg-cream-100 overflow-hidden">
                <div class="h-full" :class="toneBarClass(item.tone)" :style="{ width: statusPercent(item.value) + '%' }"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="rounded-3xl border border-coffee-100/80 bg-white/95 dark:bg-admin-card-dark/90 p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
          <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Menu Ringkas</h3>
          <p class="text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1">Ketersediaan menu terbaru</p>

          <div class="mt-4">
            <div v-if="loadingMenus" class="text-sm text-admin-text-muted-light">Memuat data menu...</div>
            <div v-else class="space-y-4">
              <div class="flex items-center justify-between text-sm">
                <span class="text-admin-text-muted-light">Total Menu</span>
                <span class="font-semibold text-admin-text-main-light">{{ menuCount }}</span>
              </div>
              <div class="flex items-center justify-between text-sm">
                <span class="text-admin-text-muted-light">Menu Aktif</span>
                <span class="font-semibold text-admin-text-main-light">{{ activeMenuCount }}</span>
              </div>
              <div>
                <div class="flex items-center justify-between text-xs text-admin-text-muted-light">
                  <span>Aktif</span>
                  <span>{{ menuActiveRatio }}%</span>
                </div>
                <div class="mt-2 h-2 rounded-full bg-cream-100 overflow-hidden">
                  <div
                    class="h-full bg-gradient-to-r from-coffee-500 to-amber-400"
                    :style="{ width: menuActiveRatio + '%' }"
                  ></div>
                </div>
              </div>
              <RouterLink
                to="/admin/menu"
                class="inline-flex items-center justify-center rounded-2xl border border-coffee-200/70 bg-white/80 px-4 py-2 text-xs font-semibold text-admin-text-main-light hover:bg-white"
              >
                Kelola Menu
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </section>
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
