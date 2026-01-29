<script setup>
import { ref } from 'vue';

// Mock Data for Dashboard (sesuai template)
const stats = ref([
    { 
        title: 'Total Order', 
        value: '21,375', 
        change: '-2.33%', 
        trend: 'down',
        progress: 35,
        icon: 'shopping_bag',
        color: 'orange' 
    },
    { 
        title: 'New Customer', 
        value: '1,012', 
        change: '+32.40%', 
        trend: 'up',
        progress: 65,
        icon: 'person_outline',
        color: 'pink' 
    },
    { 
        title: 'Total Sales', 
        value: '$24,254', 
        change: '+25%', 
        trend: 'up',
        progress: 50,
        icon: 'shopping_cart',
        color: 'green' 
    }
]);

const trendingItems = ref([
    { name: 'Cappuccino', price: '$85.00', count: 240, image: 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Latte', price: '$70.50', count: 220, image: 'https://images.unsplash.com/photo-1570968992194-79569335af33?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' },
    { name: 'Frappuccino', price: '$82.50', count: 200, image: 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }, // Placeholder image
    { name: 'Mocha', price: '$40.50', count: 100, image: 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60' }
]);

const recentOrders = ref([
    { id: '254215', item: 'Cappuccino', date: '27 Oct 2023, 01:05 PM', table: '2B', price: '$200', payment: 'Cash', status: 'Completed' },
    { id: '1244215', item: 'Americano', date: '28 Oct 2023, 10:25 PM', table: '8B', price: '$80', payment: 'Card', status: 'Completed' },
    { id: '995642', item: 'Latte Vanilla', date: '29 Oct 2023, 08:15 AM', table: '1A', price: '$120', payment: 'E-Wallet', status: 'Pending' }
]);
</script>

<template>
  <div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div v-for="(stat, index) in stats" :key="index" class="bg-admin-card-light dark:bg-admin-card-dark p-6 rounded-xl shadow-soft flex flex-col justify-between">
        <div class="flex items-start justify-between mb-4">
          <div :class="`w-10 h-10 rounded-full flex items-center justify-center text-${stat.color}-500 bg-${stat.color}-50 dark:bg-${stat.color}-900/20`">
            <span class="material-icons-outlined text-[20px]">{{ stat.icon }}</span>
          </div>
          <div class="text-right">
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">{{ stat.title }}</span>
            <div :class="`flex items-center justify-end gap-1 text-xs font-semibold ${stat.trend === 'up' ? 'text-green-500' : 'text-red-500'}`">
              <span>{{ stat.change }}</span>
            </div>
          </div>
        </div>
        <div>
          <h3 class="text-2xl font-bold mb-3">{{ stat.value }}</h3>
          <div class="w-full bg-gray-100 dark:bg-gray-700 h-1.5 rounded-full overflow-hidden">
            <div class="bg-admin-primary h-full rounded-full" :style="`width: ${stat.progress}%`"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts & Trending -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Sales Analytics Placeholder -->
      <div class="lg:col-span-2 bg-admin-card-light dark:bg-admin-card-dark p-6 rounded-xl shadow-soft">
        <div class="flex items-center justify-between mb-6">
          <h3 class="font-bold text-lg">Sales Analytics [Demo]</h3>
          <a href="#" class="text-xs text-admin-primary font-medium hover:underline">See all</a>
        </div>
        <div class="relative w-full h-64 flex items-center justify-center bg-gray-50 dark:bg-gray-800 rounded-lg">
          <p class="text-gray-400 text-sm">Chart Visualization Component Coming Soon</p>
        </div>
      </div>

      <!-- Trending Coffee -->
      <div class="bg-admin-card-light dark:bg-admin-card-dark p-6 rounded-xl shadow-soft">
        <div class="flex items-center justify-between mb-6">
          <h3 class="font-bold text-lg">Trending Coffee</h3>
          <a href="#" class="text-xs text-admin-primary font-medium hover:underline">See all</a>
        </div>
        <div class="space-y-6">
          <div v-for="(item, index) in trendingItems" :key="index" class="flex items-center justify-between group cursor-pointer">
            <div class="flex items-center gap-3">
              <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-2">
                <img :src="item.image" :alt="item.name" class="w-8 h-8 object-cover rounded-full">
              </div>
              <div>
                <h4 class="font-semibold text-sm">{{ item.name }}</h4>
                <p class="text-xs text-gray-400">{{ item.price }}</p>
              </div>
            </div>
            <span class="font-bold text-sm text-gray-800 dark:text-gray-200 group-hover:text-admin-primary transition-colors">{{ item.count }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-admin-card-light dark:bg-admin-card-dark p-6 rounded-xl shadow-soft">
      <div class="flex items-center justify-between mb-6">
        <h3 class="font-bold text-lg">Recent Order</h3>
        <a href="#" class="text-xs text-admin-primary font-medium hover:underline">See all</a>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="text-xs text-gray-400 font-medium border-b border-gray-100 dark:border-gray-700/50">
              <th class="py-4 pl-4 w-10">
                <input type="checkbox" class="rounded border-gray-300 text-admin-primary focus:ring-admin-primary/20 bg-transparent">
              </th>
              <th class="py-4 text-xs font-semibold">#</th>
              <th class="py-4 text-xs font-semibold">Items</th>
              <th class="py-4 text-xs font-semibold">Date & Time</th>
              <th class="py-4 text-xs font-semibold">Table</th>
              <th class="py-4 text-xs font-semibold">Price</th>
              <th class="py-4 text-xs font-semibold">Payment</th>
              <th class="py-4 text-right pr-4 text-xs font-semibold">Action</th>
            </tr>
          </thead>
          <tbody class="text-sm">
            <tr v-for="(order, index) in recentOrders" :key="index" class="group hover:bg-gray-50 dark:hover:bg-white/5 transition-colors border-b border-gray-50 dark:border-gray-800 last:border-0">
              <td class="py-4 pl-4">
                <input type="checkbox" class="rounded border-gray-300 text-admin-primary focus:ring-admin-primary/20 bg-transparent">
              </td>
              <td class="py-4 text-gray-500">0{{ index + 1 }}</td>
              <td class="py-4">
                <div class="flex items-center gap-3">
                 <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                    {{ order.item.charAt(0) }}
                  </div>
                  <div>
                    <p class="font-bold text-gray-800 dark:text-gray-200">{{ order.item }}</p>
                    <p class="text-xs text-gray-400">#{{ order.id }}</p>
                  </div>
                </div>
              </td>
              <td class="py-4 text-gray-500 text-xs">{{ order.date }}</td>
              <td class="py-4 text-gray-500 text-xs">{{ order.table }}</td>
              <td class="py-4 font-bold">{{ order.price }}</td>
              <td class="py-4 text-gray-500 text-xs">{{ order.payment }}</td>
              <td class="py-4 text-right pr-4">
                <button class="text-gray-400 hover:text-admin-primary transition-colors">
                  <span class="material-icons-outlined text-lg">more_vert</span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
