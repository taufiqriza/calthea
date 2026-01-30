<script setup>
import { ref } from 'vue';

const spotlightStats = ref([
    { label: 'Revenue (MTD)', value: 'Rp 28,4 jt', change: '+12.4%', trend: 'up' },
    { label: 'Orders (MTD)', value: '1.248', change: '+4.1%', trend: 'up' },
    { label: 'Avg. Ticket', value: 'Rp 42.000', change: '-1.2%', trend: 'down' },
    { label: 'Guest Rating', value: '4.9/5', change: '+0.2', trend: 'up' },
]);

const kpis = ref([
    { title: 'Walk-in', value: '62%', change: '+6%', trend: 'up', icon: 'storefront' },
    { title: 'Delivery', value: '28%', change: '-2%', trend: 'down', icon: 'delivery_dining' },
    { title: 'Reservations', value: '10%', change: '+4%', trend: 'up', icon: 'event' },
]);

const topItems = ref([
    { name: 'Kopi Susu Calthea', price: 'Rp 18.000', count: 342, tag: 'Best Seller' },
    { name: 'Matcha Latte', price: 'Rp 22.000', count: 278, tag: 'Trending' },
    { name: 'Nasgor Calthea', price: 'Rp 20.000', count: 241, tag: 'Top Meal' },
    { name: 'Roti Maryam', price: 'Rp 12.000', count: 198, tag: 'Fan Favorite' },
]);

const recentOrders = ref([
    { id: 'OR-2542', item: 'Kopi Susu Calthea', time: 'Today, 10:24', table: '2B', total: 'Rp 54.000', channel: 'Dine-in', status: 'Paid' },
    { id: 'OR-2543', item: 'Matcha Latte', time: 'Today, 11:05', table: 'Takeaway', total: 'Rp 22.000', channel: 'Pickup', status: 'In Progress' },
    { id: 'OR-2544', item: 'Nasgor Calthea', time: 'Today, 11:42', table: '4A', total: 'Rp 40.000', channel: 'Dine-in', status: 'Paid' },
    { id: 'OR-2545', item: 'Roti Maryam', time: 'Today, 12:10', table: 'Delivery', total: 'Rp 36.000', channel: 'Online', status: 'Pending' },
]);

const reservations = ref([
    { name: 'Aisyah Putri', time: '13:00', guests: 4, note: 'Window seat' },
    { name: 'Rafi Ramadhan', time: '15:30', guests: 2, note: 'Anniversary' },
    { name: 'Dimas Aulia', time: '17:00', guests: 6, note: 'Family' },
]);

const highlights = ref([
    { title: 'Peak Hour', value: '18:00 - 20:00', desc: 'Average 42 orders/hr', icon: 'schedule' },
    { title: 'Best Channel', value: 'Dine-in', desc: 'Highest repeat rate', icon: 'insights' },
    { title: 'Next Event', value: 'Acoustic Friday', desc: 'Feb 7, 2026', icon: 'celebration' },
]);
</script>

<template>
  <div class="space-y-8">
    <!-- Hero / Performance -->
    <section class="relative overflow-hidden rounded-3xl border border-white/60 dark:border-white/10 bg-white/70 dark:bg-admin-card-dark/70 backdrop-blur-xl p-6 sm:p-8 shadow-[0_25px_60px_-35px_rgba(18,12,8,0.45)]">
      <div class="absolute -top-20 right-0 h-64 w-64 rounded-full bg-coffee-200/40 blur-[90px]"></div>
      <div class="absolute -bottom-24 left-0 h-64 w-64 rounded-full bg-amber-100/40 blur-[100px]"></div>

      <div class="relative flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-xl space-y-3">
          <div class="inline-flex items-center gap-2 rounded-full bg-amber-100/80 px-3 py-1 text-[10px] font-semibold uppercase tracking-wide text-amber-700 whitespace-nowrap">
            <span>Sample</span>
            <span class="h-1 w-1 rounded-full bg-amber-500"></span>
            <span>Pengembangan Paket Lanjutan</span>
          </div>
          <p class="text-[11px] uppercase tracking-[0.3em] text-admin-text-muted-light dark:text-admin-text-muted-dark">Monthly Snapshot</p>
          <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-admin-text-main-light dark:text-admin-text-main-dark leading-tight">
            Calthea Dashboard Performance
          </h2>
          <p class="text-sm sm:text-base text-admin-text-muted-light dark:text-admin-text-muted-dark leading-relaxed">
            Track revenue, guest satisfaction, and daily operations with real-time insight.
          </p>
        </div>

        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:gap-4">
          <div
            v-for="(stat, index) in spotlightStats"
            :key="stat.label"
            class="rounded-2xl border border-white/70 dark:border-white/5 bg-white/80 dark:bg-black/30 p-3 sm:p-4 shadow-[0_12px_30px_-24px_rgba(18,12,8,0.6)] animate-fade-in-up"
            :style="`animation-delay: ${index * 0.08}s`"
          >
            <p class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark truncate">
              {{ stat.label }}
            </p>
            <p class="mt-2 text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark whitespace-nowrap">
              {{ stat.value }}
            </p>
            <div class="mt-2 flex items-center gap-1 text-[11px] font-medium whitespace-nowrap">
              <span
                :class="stat.trend === 'up' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-500 dark:text-rose-400'"
              >
                {{ stat.change }}
              </span>
              <span class="text-admin-text-muted-light dark:text-admin-text-muted-dark">vs last month</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Analytics + Highlights -->
    <section class="grid gap-6 lg:grid-cols-3">
      <div class="lg:col-span-2 rounded-3xl border border-white/60 dark:border-white/10 bg-admin-card-light/90 dark:bg-admin-card-dark/90 backdrop-blur-xl p-6 sm:p-7 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <div>
            <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Revenue & Orders</h3>
            <p class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">Last 30 days overview</p>
            <p class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1 whitespace-nowrap">Sample - Pengembangan Paket Lanjutan</p>
          </div>
          <div class="flex items-center gap-2">
            <button class="rounded-full border border-coffee-200/80 bg-white/90 px-3 py-1.5 text-xs font-medium text-admin-text-main-light shadow-sm hover:bg-white">
              30D
            </button>
            <button class="rounded-full border border-coffee-200/80 bg-white/70 px-3 py-1.5 text-xs font-medium text-admin-text-muted-light hover:bg-white/90">
              90D
            </button>
            <button class="rounded-full border border-coffee-200/80 bg-white/70 px-3 py-1.5 text-xs font-medium text-admin-text-muted-light hover:bg-white/90">
              12M
            </button>
          </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-3">
          <div
            v-for="item in kpis"
            :key="item.title"
            class="rounded-2xl border border-white/70 dark:border-white/10 bg-white/80 dark:bg-black/20 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_-30px_rgba(18,12,8,0.6)]"
          >
            <div class="flex items-center justify-between">
              <span class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark truncate">{{ item.title }}</span>
              <span class="material-icons-outlined text-admin-primary text-lg">{{ item.icon }}</span>
            </div>
            <div class="mt-3 text-xl font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">{{ item.value }}</div>
            <div class="mt-2 text-[11px] font-medium whitespace-nowrap" :class="item.trend === 'up' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-500 dark:text-rose-400'">
              {{ item.change }} from last week
            </div>
          </div>
        </div>

        <div class="mt-6 h-48 rounded-2xl border border-dashed border-coffee-200/80 bg-gradient-to-br from-cream-50 to-white/90 dark:from-black/20 dark:to-black/10 flex items-center justify-center text-[11px] text-admin-text-muted-light">
          Chart visualization placeholder (integrate later)
        </div>
      </div>

      <div class="rounded-3xl border border-white/60 dark:border-white/10 bg-admin-card-light/90 dark:bg-admin-card-dark/90 backdrop-blur-xl p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Today Highlights</h3>
            <p class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1 whitespace-nowrap">Sample - Pengembangan Paket Lanjutan</p>
          </div>
          <span class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark">Live</span>
        </div>
        <div class="mt-5 space-y-4">
          <div
            v-for="item in highlights"
            :key="item.title"
            class="rounded-2xl border border-white/70 dark:border-white/10 bg-white/80 dark:bg-black/20 p-4"
          >
            <div class="flex items-start gap-3">
              <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-coffee-100 text-coffee-700">
                <span class="material-icons-outlined text-base">{{ item.icon }}</span>
              </div>
              <div>
                <p class="text-sm font-semibold text-admin-text-main-light dark:text-admin-text-main-dark truncate">{{ item.title }}</p>
                <p class="text-sm text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">{{ item.value }}</p>
                <p class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1">{{ item.desc }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Orders + Reservations -->
    <section class="grid gap-6 lg:grid-cols-3">
      <div class="lg:col-span-2 rounded-3xl border border-white/60 dark:border-white/10 bg-admin-card-light/90 dark:bg-admin-card-dark/90 backdrop-blur-xl p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Recent Orders</h3>
            <p class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">Latest transactions today</p>
            <p class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1 whitespace-nowrap">Sample - Pengembangan Paket Lanjutan</p>
          </div>
          <button class="rounded-full border border-coffee-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-admin-text-main-light hover:bg-white">
            Export
          </button>
        </div>

        <div class="mt-5 overflow-x-auto">
          <table class="min-w-[620px] w-full text-left text-sm">
            <thead class="text-[11px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark">
              <tr class="border-b border-coffee-100/70 dark:border-white/10">
                <th class="py-3">Order</th>
                <th class="py-3">Channel</th>
                <th class="py-3">Table</th>
                <th class="py-3">Total</th>
                <th class="py-3 text-right">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-coffee-100/70 dark:divide-white/10">
              <tr v-for="order in recentOrders" :key="order.id" class="hover:bg-coffee-50/70 dark:hover:bg-white/5">
                <td class="py-4">
                  <div class="font-semibold text-admin-text-main-light dark:text-admin-text-main-dark truncate max-w-[220px]">{{ order.item }}</div>
                  <div class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">{{ order.id }} - {{ order.time }}</div>
                </td>
                <td class="py-4 text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">{{ order.channel }}</td>
                <td class="py-4 text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">{{ order.table }}</td>
                <td class="py-4 font-semibold text-admin-text-main-light dark:text-admin-text-main-dark whitespace-nowrap">{{ order.total }}</td>
                <td class="py-4 text-right">
                  <span
                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold"
                    :class="order.status === 'Paid'
                      ? 'bg-emerald-100 text-emerald-700'
                      : order.status === 'In Progress'
                        ? 'bg-amber-100 text-amber-700'
                        : 'bg-rose-100 text-rose-700'"
                  >
                    {{ order.status }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="rounded-3xl border border-white/60 dark:border-white/10 bg-admin-card-light/90 dark:bg-admin-card-dark/90 backdrop-blur-xl p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Upcoming Reservations</h3>
            <p class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1 whitespace-nowrap">Sample - Pengembangan Paket Lanjutan</p>
          </div>
          <span class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark">Today</span>
        </div>
        <div class="mt-5 space-y-4">
          <div v-for="item in reservations" :key="item.name" class="rounded-2xl border border-white/70 dark:border-white/10 bg-white/80 dark:bg-black/20 p-4">
            <div class="flex items-start justify-between">
              <div>
                <p class="font-semibold text-admin-text-main-light dark:text-admin-text-main-dark truncate max-w-[160px]">{{ item.name }}</p>
                <p class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">{{ item.guests }} guests - {{ item.note }}</p>
              </div>
              <span class="rounded-full bg-coffee-100 px-3 py-1 text-[11px] font-semibold text-coffee-700 whitespace-nowrap">{{ item.time }}</span>
            </div>
          </div>
          <button class="w-full rounded-2xl border border-coffee-200/70 bg-white/80 py-2 text-sm font-semibold text-admin-text-main-light hover:bg-white">
            View full schedule
          </button>
        </div>
      </div>
    </section>

    <!-- Top Items -->
    <section class="grid gap-6 lg:grid-cols-3">
      <div class="lg:col-span-2 rounded-3xl border border-white/60 dark:border-white/10 bg-admin-card-light/90 dark:bg-admin-card-dark/90 backdrop-blur-xl p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Top Performing Items</h3>
            <p class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1 whitespace-nowrap">Sample - Pengembangan Paket Lanjutan</p>
          </div>
          <button class="rounded-full border border-coffee-200/80 bg-white/80 px-3 py-1.5 text-xs font-medium text-admin-text-main-light hover:bg-white">
            Manage Menu
          </button>
        </div>
        <div class="mt-5 grid gap-4 sm:grid-cols-2">
          <div
            v-for="item in topItems"
            :key="item.name"
            class="rounded-2xl border border-white/70 dark:border-white/10 bg-white/80 dark:bg-black/20 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_-30px_rgba(18,12,8,0.6)]"
          >
            <div class="flex items-center justify-between">
              <div>
                <p class="font-semibold text-admin-text-main-light dark:text-admin-text-main-dark truncate max-w-[180px]">{{ item.name }}</p>
                <p class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark whitespace-nowrap">{{ item.price }}</p>
              </div>
              <span class="rounded-full bg-coffee-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-coffee-700 whitespace-nowrap">
                {{ item.tag }}
              </span>
            </div>
            <div class="mt-3 flex items-center justify-between text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark">
              <span class="whitespace-nowrap">{{ item.count }} orders</span>
              <span class="whitespace-nowrap">Conversion 18%</span>
            </div>
          </div>
        </div>
      </div>

      <div class="rounded-3xl border border-white/60 dark:border-white/10 bg-admin-card-light/90 dark:bg-admin-card-dark/90 backdrop-blur-xl p-6 shadow-[0_20px_50px_-30px_rgba(18,12,8,0.5)]">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-base sm:text-lg font-semibold text-admin-text-main-light dark:text-admin-text-main-dark">Guest Sentiment</h3>
            <p class="text-[10px] uppercase tracking-wide text-admin-text-muted-light dark:text-admin-text-muted-dark mt-1 whitespace-nowrap">Sample - Pengembangan Paket Lanjutan</p>
          </div>
          <span class="text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark">Last 7 days</span>
        </div>
        <div class="mt-5 space-y-4">
          <div class="rounded-2xl border border-white/70 dark:border-white/10 bg-white/80 dark:bg-black/20 p-4">
            <p class="text-sm text-admin-text-main-light dark:text-admin-text-main-dark leading-snug">
              "Staff ramah, kopi konsisten, ambience-nya premium."
            </p>
            <div class="mt-3 flex items-center justify-between text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark">
              <span class="whitespace-nowrap">Sarah - Batu</span>
              <span class="whitespace-nowrap">★★★★★</span>
            </div>
          </div>
          <div class="rounded-2xl border border-white/70 dark:border-white/10 bg-white/80 dark:bg-black/20 p-4">
            <p class="text-sm text-admin-text-main-light dark:text-admin-text-main-dark leading-snug">
              "Reservasi cepat, view-nya bagus banget."
            </p>
            <div class="mt-3 flex items-center justify-between text-[11px] text-admin-text-muted-light dark:text-admin-text-muted-dark">
              <span class="whitespace-nowrap">Randy - Malang</span>
              <span class="whitespace-nowrap">★★★★★</span>
            </div>
          </div>
          <button class="w-full rounded-2xl border border-coffee-200/70 bg-white/80 py-2 text-sm font-semibold text-admin-text-main-light hover:bg-white">
            Review Center
          </button>
        </div>
      </div>
    </section>
  </div>
</template>
