<script setup>
import { RouterLink, useRoute, useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();

const isActive = (path) => route.path === path;

const handleLogout = async () => {
  await authStore.logout();
  router.push({ name: 'admin.login' });
};
</script>

<template>
  <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 safe-area-bottom">
    <div class="mx-4 mb-3">
      <div class="relative admin-nav-shell">
        <div class="absolute inset-0 admin-nav-glow"></div>
        <div class="relative flex items-center justify-between px-4 py-3">
          <RouterLink
            to="/admin/dashboard"
            class="admin-nav-item"
            :class="isActive('/admin/dashboard') ? 'admin-nav-item-active' : ''"
          >
            <span class="admin-nav-icon"><span class="material-icons-outlined">home</span></span>
            <span class="admin-nav-label">Dashboard</span>
          </RouterLink>

          <RouterLink
            to="/admin/menu"
            class="admin-nav-item"
            :class="isActive('/admin/menu') ? 'admin-nav-item-active' : ''"
          >
            <span class="admin-nav-icon"><span class="material-icons-outlined">restaurant_menu</span></span>
            <span class="admin-nav-label">Menu</span>
          </RouterLink>

          <RouterLink
            to="/admin/orders"
            class="admin-nav-item admin-nav-cta"
            :class="isActive('/admin/orders') ? 'admin-nav-item-active' : ''"
          >
            <span class="admin-nav-icon admin-nav-icon-cta"><span class="material-icons-outlined">receipt_long</span></span>
            <span class="admin-nav-label">Pesanan</span>
          </RouterLink>

          <button class="admin-nav-item" @click="handleLogout">
            <span class="admin-nav-icon"><span class="material-icons-outlined">logout</span></span>
            <span class="admin-nav-label">Logout</span>
          </button>
        </div>
      </div>
    </div>
  </nav>
</template>

<style scoped>
.safe-area-bottom {
  padding-bottom: env(safe-area-inset-bottom);
}

.admin-nav-shell {
  background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(255,255,255,0.75));
  border: 1px solid rgba(255,255,255,0.7);
  border-radius: 26px;
  backdrop-filter: blur(16px);
  box-shadow: 0 16px 36px -26px rgba(60, 40, 24, 0.5);
}

.admin-nav-glow {
  border-radius: 26px;
  background: radial-gradient(circle at 50% -60%, rgba(196, 154, 118, 0.5), transparent 60%);
}

.admin-nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  color: rgba(88, 65, 45, 0.7);
  font-weight: 600;
  font-size: 10px;
  letter-spacing: 0.03em;
  background: transparent;
  border: none;
  transition: all 0.25s ease;
}

.admin-nav-item-active,
.admin-nav-item:hover {
  color: #6f4a25;
}

.admin-nav-icon {
  width: 40px;
  height: 40px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.7);
  border: 1px solid rgba(177, 127, 86, 0.18);
  font-size: 16px;
  color: #6f4a25;
}

.admin-nav-icon-cta {
  background: linear-gradient(135deg, #b17f56, #8b5a2b);
  color: white;
  box-shadow: 0 14px 30px -18px rgba(79, 54, 30, 0.9);
}

.admin-nav-item-active .admin-nav-icon:not(.admin-nav-icon-cta) {
  background: rgba(245, 233, 216, 0.95);
  color: #8b5a2b;
}

.admin-nav-label {
  line-height: 1;
}
</style>
