<script setup>
import { ref } from 'vue';
import Sidebar from '@/components/admin/Sidebar.vue';
import { RouterView } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
const sidebarOpen = ref(false);
const sidebarCollapsed = ref(false);
</script>

<template>
  <div class="relative flex h-screen overflow-hidden bg-admin-bg-light dark:bg-admin-bg-dark font-display text-admin-text-main-light dark:text-admin-text-main-dark transition-colors duration-300">
    <!-- Ambient Background -->
    <div class="pointer-events-none absolute inset-0">
      <div class="absolute -top-40 right-0 h-80 w-80 rounded-full bg-coffee-200/40 blur-[120px]"></div>
      <div class="absolute -bottom-32 left-0 h-72 w-72 rounded-full bg-amber-100/40 blur-[110px]"></div>
    </div>

    <!-- Sidebar (Desktop) -->
    <Sidebar class="hidden lg:flex" :collapsed="sidebarCollapsed" />

    <!-- Sidebar (Mobile) -->
    <Transition name="fade" mode="out-in">
      <div v-if="sidebarOpen" class="fixed inset-0 z-40 lg:hidden">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="sidebarOpen = false"></div>
        <Sidebar class="absolute left-0 top-0 h-full w-72" mobile @close="sidebarOpen = false" />
      </div>
    </Transition>
    
    <!-- Main Content -->
    <main class="relative flex-1 overflow-y-auto">
      <!-- Header -->
      <header class="border-b border-white/60 dark:border-white/10 bg-admin-bg-light/80 dark:bg-admin-bg-dark/80 px-4 sm:px-6 lg:px-8 py-4 backdrop-blur-xl sticky top-0 z-30">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <div class="flex items-center gap-3">
            <button
              class="lg:hidden inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/60 bg-white/80 text-admin-text-main-light shadow-sm"
              @click="sidebarOpen = true"
            >
              <span class="material-icons-outlined text-[20px]">menu</span>
            </button>
            <button
              class="hidden lg:inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/60 bg-white/80 text-admin-text-main-light shadow-sm"
              @click="sidebarCollapsed = !sidebarCollapsed"
            >
              <span class="material-icons-outlined text-[20px]">
                {{ sidebarCollapsed ? 'chevron_right' : 'chevron_left' }}
              </span>
            </button>
            <div>
              <p class="text-[10px] uppercase tracking-[0.3em] text-admin-text-muted-light dark:text-admin-text-muted-dark">Workspace</p>
              <h1 class="font-serif text-xl sm:text-2xl font-semibold">Admin Dashboard</h1>
            </div>
          </div>
          
          <div class="flex items-center gap-3 sm:gap-4">
            <div class="relative hidden md:block">
              <span class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
              <input 
                class="pl-12 pr-4 py-2.5 bg-white/90 dark:bg-admin-card-dark/80 rounded-full text-sm border border-white/70 shadow-sm w-64 focus:ring-2 focus:ring-admin-primary/20 placeholder-gray-400 dark:placeholder-gray-500 dark:text-gray-200 outline-none" 
                placeholder="Search dashboard..." 
                type="text"
              />
            </div>
            
            <div class="flex items-center gap-3">
              <div class="hidden sm:block text-right">
                <p class="text-xs text-admin-text-muted-light dark:text-admin-text-muted-dark">Super Admin</p>
                <p class="font-semibold text-sm">{{ authStore.user?.name || 'Admin User' }}</p>
              </div>
              <img 
                alt="Admin Profile" 
                class="w-10 h-10 rounded-full object-cover border-2 border-white/70 shadow-sm bg-gray-200" 
                src="https://ui-avatars.com/api/?name=Admin+User&background=A06B52&color=fff"
              />
              <button class="relative w-10 h-10 bg-white/90 dark:bg-admin-card-dark/80 rounded-full flex items-center justify-center shadow-sm border border-white/60">
                <span class="material-icons-outlined text-gray-600 dark:text-gray-300 text-[20px]">notifications_none</span>
                <span class="absolute top-2 right-3 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
              </button>
            </div>
          </div>
        </div>
      </header>
      
      <!-- Content View -->
      <div class="relative px-4 sm:px-6 lg:px-8 py-6">
        <RouterView v-slot="{ Component }">
          <Transition name="fade" mode="in-out">
            <component :is="Component" />
          </Transition>
        </RouterView>
      </div>
    </main>
  </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}

.fade-leave-active {
  position: absolute;
  inset: 0;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
