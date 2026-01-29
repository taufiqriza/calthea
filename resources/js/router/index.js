import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('@views/Home.vue'),
    meta: {
      title: 'Beranda - Calthea Cafe & Nature',
      description: 'Cafe & Nature Experience di Kota Batu. Nikmati kopi premium dengan suasana alam yang menenangkan.',
    },
  },
  {
    path: '/menu',
    name: 'menu',
    component: () => import('@views/Menu.vue'),
    meta: {
      title: 'Menu - Calthea Cafe & Nature',
      description: 'Lihat menu lengkap minuman dan makanan di Calthea Cafe.',
    },
  },
  {
    path: '/tentang',
    name: 'about',
    component: () => import('@views/About.vue'),
    meta: {
      title: 'Tentang Kami - Calthea Cafe & Nature',
      description: 'Cerita Calthea Cafe, visi misi, dan tim kami.',
    },
  },
  {
    path: '/reservasi',
    name: 'reservation',
    component: () => import('@views/Reservation.vue'),
    meta: {
      title: 'Reservasi - Calthea Cafe & Nature',
      description: 'Reservasi meja Anda di Calthea Cafe.',
    },
  },
  {
    path: '/kontak',
    name: 'contact',
    component: () => import('@views/Contact.vue'),
    meta: {
      title: 'Kontak - Calthea Cafe & Nature',
      description: 'Hubungi kami dan kunjungi lokasi Calthea Cafe di Kota Batu.',
    },
  },
  {
    path: '/galeri',
    name: 'gallery',
    component: () => import('@views/Gallery.vue'),
    meta: {
      title: 'Galeri - Calthea Cafe & Nature',
      description: 'Lihat foto-foto suasana cafe dan menu kami.',
    },
  },
  {
    path: '/promo',
    name: 'events',
    component: () => import('@views/Events.vue'),
    meta: {
      title: 'Promo & Event - Calthea Cafe & Nature',
      description: 'Promo terkini dan event mendatang di Calthea Cafe.',
    },
  },
  // Admin Routes
  {
    path: '/admin/login',
    name: 'admin.login',
    component: () => import('@views/admin/Login.vue'),
    meta: {
      title: 'Admin Login - Calthea Cafe',
      layout: 'blank'
    }
  },
  {
    path: '/admin',
    component: () => import('@/layouts/AdminLayout.vue'),
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        redirect: '/admin/dashboard'
      },
      {
        path: 'dashboard',
        name: 'admin.dashboard',
        component: () => import('@views/admin/Dashboard.vue'),
        meta: { title: 'Dashboard - Calthea Admin' }
      },
      {
        path: 'menu',
        name: 'admin.menu',
        component: () => import('@views/admin/menu/Index.vue'),
        meta: { title: 'Menu Management - Calthea Admin' }
      }
    ]
  }
];

import { useAuthStore } from '@/stores/auth';

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    // If there's a saved position (browser back/forward), use it
    if (savedPosition) {
      return savedPosition;
    }

    // If there's a hash (anchor link), scroll to it
    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth',
        top: 80, // Offset for fixed navbar
      };
    }

    // For homepage, always scroll to top
    if (to.path === '/' || to.name === 'home') {
      return { top: 0, behavior: 'instant' };
    }

    // For other pages, scroll to top
    return { top: 0 };
  },
});

// Update document title
// Update document title & Auth Check
router.beforeEach(async (to, from, next) => {
  document.title = to.meta.title || 'Calthea Cafe & Nature';

  // Update meta description
  const metaDescription = document.querySelector('meta[name="description"]');
  if (metaDescription) {
    metaDescription.setAttribute('content', to.meta.description || '');
  }

  // Auth Check
  const authStore = useAuthStore();

  if (to.meta.requiresAuth) {
    if (!authStore.isAuthenticated) {
      // Try to restore session
      await authStore.initializeAuth();
      if (!authStore.isAuthenticated) {
        next({ name: 'admin.login' });
        return;
      }
    }
  }

  if (to.name === 'admin.login') {
    if (!authStore.isAuthenticated) await authStore.initializeAuth();
    if (authStore.isAuthenticated) {
      next({ name: 'admin.dashboard' });
      return;
    }
  }

  next();
});

export default router;
