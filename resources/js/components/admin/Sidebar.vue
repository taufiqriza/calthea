<script setup>
import { RouterLink, useRoute } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const route = useRoute();
const authStore = useAuthStore();

const isActive = (path) => {
    return route.path === path;
};
</script>

<template>
  <aside class="w-64 flex-shrink-0 bg-admin-sidebar-light dark:bg-admin-sidebar-dark flex flex-col justify-between p-6 transition-colors duration-300 border-r border-transparent dark:border-white/5 font-display min-h-screen">
    <div>
      <div class="flex items-center gap-2 mb-10 px-2">
        <span class="text-3xl font-bold text-admin-text-main-light dark:text-admin-primary font-serif tracking-wide">Calthea</span>
      </div>
      <nav class="space-y-2">
        <RouterLink 
          to="/admin/dashboard" 
          class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 font-medium"
          :class="isActive('/admin/dashboard') ? 'bg-admin-primary text-white shadow-lg shadow-admin-primary/30' : 'text-admin-text-muted-light dark:text-gray-400 hover:text-admin-text-main-light dark:hover:text-white'"
        >
          <span class="material-icons-outlined text-[20px]">home</span>
          <span class="text-sm">Home</span>
        </RouterLink>

        <RouterLink 
          to="/admin/menu" 
          class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300 font-medium"
          :class="isActive('/admin/menu') ? 'bg-admin-primary text-white shadow-lg shadow-admin-primary/30' : 'text-admin-text-muted-light dark:text-gray-400 hover:text-admin-text-main-light dark:hover:text-white'"
        >
          <span class="material-icons-outlined text-[20px]">restaurant_menu</span>
          <span class="text-sm">Menu</span>
        </RouterLink>

        <!-- Disabled Items -->
        <div class="flex items-center gap-3 px-4 py-3 text-gray-400 dark:text-gray-500 hover:bg-white/20 dark:hover:bg-white/5 rounded-xl transition-all group cursor-not-allowed opacity-60">
          <span class="material-icons-outlined text-[20px]">storefront</span>
          <span class="font-medium text-sm">Shopping</span>
          <span class="ml-auto text-[10px] bg-gray-200 dark:bg-white/10 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full font-bold">N/A</span>
        </div>

        <div class="flex items-center gap-3 px-4 py-3 text-gray-400 dark:text-gray-500 hover:bg-white/20 dark:hover:bg-white/5 rounded-xl transition-all group cursor-not-allowed opacity-60">
          <span class="material-icons-outlined text-[20px]">assignment</span>
          <span class="font-medium text-sm">Order List</span>
          <span class="ml-auto text-[10px] bg-gray-200 dark:bg-white/10 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full font-bold">N/A</span>
        </div>

        <div class="flex items-center gap-3 px-4 py-3 text-gray-400 dark:text-gray-500 hover:bg-white/20 dark:hover:bg-white/5 rounded-xl transition-all group cursor-not-allowed opacity-60">
          <span class="material-icons-outlined text-[20px]">favorite_border</span>
          <span class="font-medium text-sm">Favorite</span>
          <span class="ml-auto text-[10px] bg-gray-200 dark:bg-white/10 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full font-bold">N/A</span>
        </div>

        <div class="flex items-center gap-3 px-4 py-3 text-gray-400 dark:text-gray-500 hover:bg-white/20 dark:hover:bg-white/5 rounded-xl transition-all group cursor-not-allowed opacity-60">
          <span class="material-icons-outlined text-[20px]">account_balance_wallet</span>
          <span class="font-medium text-sm">Payment</span>
          <span class="ml-auto text-[10px] bg-gray-200 dark:bg-white/10 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full font-bold">N/A</span>
        </div>

        <div class="flex items-center gap-3 px-4 py-3 text-gray-400 dark:text-gray-500 hover:bg-white/20 dark:hover:bg-white/5 rounded-xl transition-all group cursor-not-allowed opacity-60">
          <span class="material-icons-outlined text-[20px]">settings</span>
          <span class="font-medium text-sm">Settings</span>
          <span class="ml-auto text-[10px] bg-gray-200 dark:bg-white/10 text-gray-500 dark:text-gray-400 px-2 py-0.5 rounded-full font-bold">N/A</span>
        </div>
      </nav>
    </div>
    
    <div class="flex items-center justify-between px-2 py-2">
      <button 
        @click="authStore.logout()" 
        class="flex items-center gap-3 text-gray-600 dark:text-gray-400 hover:text-red-500 transition-colors cursor-pointer"
      >
        <span class="material-icons-outlined text-[20px]">logout</span>
        <span class="font-medium text-sm">Log Out</span>
      </button>
      
      <div class="flex items-center gap-2">
        <button class="flex items-center justify-center w-8 h-8 rounded-full bg-white/50 dark:bg-white/10 hover:bg-admin-primary hover:text-white transition-colors cursor-pointer">
          <span class="material-icons-outlined text-sm">dark_mode</span>
        </button>
      </div>
    </div>
  </aside>
</template>
