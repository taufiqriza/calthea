<script setup>
import Sidebar from '@/components/admin/Sidebar.vue';
import { RouterView } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
</script>

<template>
  <div class="flex h-screen overflow-hidden bg-admin-bg-light dark:bg-admin-bg-dark font-display text-admin-text-main-light dark:text-admin-text-main-dark transition-colors duration-300">
    
    <!-- Sidebar -->
    <Sidebar />
    
    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-8">
      <!-- Header -->
      <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
        <div>
          <h1 class="text-2xl font-bold mb-1 font-serif">Welcome Back, Admin</h1>
          <p class="text-gray-500 dark:text-gray-400 text-sm">Manage your coffee shop easily</p>
        </div>
        
        <div class="flex items-center gap-6">
          <div class="relative hidden md:block">
            <span class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
            <input 
              class="pl-12 pr-4 py-3 bg-white dark:bg-admin-card-dark rounded-full text-sm border-none shadow-sm w-80 focus:ring-2 focus:ring-admin-primary/20 placeholder-gray-400 dark:placeholder-gray-500 dark:text-gray-200 outline-none" 
              placeholder="Search something..." 
              type="text"
            />
          </div>
          
          <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
              <p class="text-xs text-gray-500 dark:text-gray-400">Super Admin</p>
              <p class="font-semibold text-sm">{{ authStore.user?.name || 'Admin User' }}</p>
            </div>
            <img 
              alt="Admin Profile" 
              class="w-10 h-10 rounded-full object-cover border-2 border-white dark:border-gray-700 shadow-sm bg-gray-200" 
              src="https://ui-avatars.com/api/?name=Admin+User&background=A06B52&color=fff"
            />
            <button class="relative w-10 h-10 bg-white dark:bg-admin-card-dark rounded-full flex items-center justify-center shadow-sm">
              <span class="material-icons-outlined text-gray-600 dark:text-gray-300 text-[20px]">notifications_none</span>
              <span class="absolute top-2 right-3 w-2 h-2 bg-red-500 rounded-full border border-white dark:border-admin-card-dark"></span>
            </button>
          </div>
        </div>
      </header>
      
      <!-- Content View -->
      <RouterView v-slot="{ Component }">
        <Transition name="fade" mode="out-in">
          <component :is="Component" />
        </Transition>
      </RouterView>
    </main>
  </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
