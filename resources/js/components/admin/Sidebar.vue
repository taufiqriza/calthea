<script setup>
import { RouterLink, useRoute, useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

defineProps({
    mobile: {
        type: Boolean,
        default: false,
    },
    collapsed: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['close']);
const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();

const isActive = (path) => {
    return route.path === path;
};

const handleLogout = async () => {
    await authStore.logout();
    emit('close');
    router.push({ name: 'admin.login' });
};
</script>

<template>
  <aside
    class="flex flex-col justify-between gap-6 bg-admin-sidebar-light/90 dark:bg-admin-sidebar-dark/90 backdrop-blur-xl p-6 transition-all duration-300 border-r border-white/50 dark:border-white/5 font-display"
    :class="mobile ? 'rounded-r-3xl shadow-2xl shadow-black/20 w-72 h-full' : (collapsed ? 'w-20 min-h-screen' : 'w-64 min-h-screen')"
  >
    <div>
      <div class="flex items-center justify-between gap-2 mb-8 px-1">
        <span v-if="!collapsed" class="text-3xl font-bold text-admin-text-main-light dark:text-admin-primary font-serif tracking-wide">Calthea</span>
        <span v-else class="text-3xl font-bold text-admin-text-main-light dark:text-admin-primary font-serif tracking-wide">C</span>
        <button
          v-if="mobile"
          class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/70 bg-white/80 text-admin-text-main-light"
          @click="emit('close')"
        >
          <span class="material-icons-outlined text-[18px]">close</span>
        </button>
      </div>

      <nav class="space-y-2">
        <RouterLink 
          to="/admin/dashboard" 
          class="flex items-center rounded-2xl transition-all duration-300 font-medium"
          :class="[
            collapsed ? 'justify-center px-3 py-3' : 'gap-3 px-4 py-3',
            isActive('/admin/dashboard') ? 'bg-admin-primary text-white shadow-lg shadow-admin-primary/30' : 'text-admin-text-muted-light dark:text-gray-400 hover:text-admin-text-main-light dark:hover:text-white'
          ]"
          @click="mobile && emit('close')"
          :title="collapsed ? 'Dashboard' : null"
        >
          <span class="material-icons-outlined text-[20px]">home</span>
          <span v-if="!collapsed" class="text-sm">Dashboard</span>
        </RouterLink>

        <RouterLink 
          to="/admin/menu" 
          class="flex items-center rounded-2xl transition-all duration-300 font-medium"
          :class="[
            collapsed ? 'justify-center px-3 py-3' : 'gap-3 px-4 py-3',
            isActive('/admin/menu') ? 'bg-admin-primary text-white shadow-lg shadow-admin-primary/30' : 'text-admin-text-muted-light dark:text-gray-400 hover:text-admin-text-main-light dark:hover:text-white'
          ]"
          @click="mobile && emit('close')"
          :title="collapsed ? 'Menu' : null"
        >
          <span class="material-icons-outlined text-[20px]">restaurant_menu</span>
          <span v-if="!collapsed" class="text-sm">Menu</span>
        </RouterLink>

        <RouterLink 
          to="/admin/orders" 
          class="flex items-center rounded-2xl transition-all duration-300 font-medium"
          :class="[
            collapsed ? 'justify-center px-3 py-3' : 'gap-3 px-4 py-3',
            isActive('/admin/orders') ? 'bg-admin-primary text-white shadow-lg shadow-admin-primary/30' : 'text-admin-text-muted-light dark:text-gray-400 hover:text-admin-text-main-light dark:hover:text-white'
          ]"
          @click="mobile && emit('close')"
          :title="collapsed ? 'Pesanan' : null"
        >
          <span class="material-icons-outlined text-[20px]">receipt_long</span>
          <span v-if="!collapsed" class="text-sm">Pesanan</span>
        </RouterLink>

      </nav>
    </div>
    
    <div class="flex items-center justify-between px-2 py-2">
      <button 
        @click="handleLogout" 
        class="flex items-center text-gray-600 dark:text-gray-400 hover:text-red-500 transition-colors cursor-pointer"
        :class="collapsed ? 'justify-center w-full' : 'gap-3'"
      >
        <span class="material-icons-outlined text-[20px]">logout</span>
        <span v-if="!collapsed" class="font-medium text-sm">Log Out</span>
      </button>
      
      <div v-if="!collapsed" class="flex items-center gap-2">
        <button class="flex items-center justify-center w-8 h-8 rounded-full bg-white/60 dark:bg-white/10 hover:bg-admin-primary hover:text-white transition-colors cursor-pointer">
          <span class="material-icons-outlined text-sm">dark_mode</span>
        </button>
      </div>
    </div>
  </aside>
</template>
