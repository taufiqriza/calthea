<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const router = useRouter();

const form = ref({
    email: '',
    password: ''
});

const handleLogin = async () => {
    const success = await authStore.login(form.value);
    if (success) {
        router.push('/admin/dashboard');
    }
};
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-[#FDFBF9] dark:bg-[#1C1917] text-[#4A3B32] dark:text-[#E7E5E4] transition-colors duration-300 relative overflow-hidden font-display">
    
    <!-- Background Decor (Elegant Soft Blobs) -->
    <div class="absolute top-[-10%] left-[-5%] w-[50%] h-[50%] bg-[#A06B52]/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[40%] h-[40%] bg-orange-300/10 rounded-full blur-[100px]"></div>
    
    <!-- Glass Card -->
    <div class="w-full max-w-md p-10 bg-white/60 dark:bg-black/40 backdrop-blur-2xl rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white/60 dark:border-white/5 relative z-10">
      <div class="text-center mb-10">
        <h1 class="font-serif text-5xl font-bold text-[#A06B52] mb-3 tracking-tight">Calthea</h1>
        <p class="text-[#9C8E85] text-sm tracking-wide uppercase font-medium">Admin Portal Access</p>
      </div>

      <div v-if="authStore.error" class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-300 rounded-xl text-sm flex items-center gap-2">
        <span class="material-icons-outlined text-sm">error_outline</span>
        {{ authStore.error }}
      </div>

      <form @submit.prevent="handleLogin" class="space-y-6">
        <div>
          <label class="block text-sm font-medium mb-2 text-[#4A3B32] dark:text-gray-300 ml-1">Email Address</label>
          <div class="relative group">
            <span class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#A06B52] transition-colors">email</span>
            <input 
              v-model="form.email" 
              type="email" 
              required
              class="w-full pl-12 pr-4 py-3.5 bg-white/70 dark:bg-white/5 border border-gray-200/60 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-[#A06B52]/20 focus:border-[#A06B52] outline-none transition-all placeholder:text-gray-300"
              placeholder="admin@calthea.com"
            />
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium mb-2 text-[#4A3B32] dark:text-gray-300 ml-1">Password</label>
          <div class="relative group">
            <span class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#A06B52] transition-colors">lock</span>
            <input 
              v-model="form.password" 
              type="password" 
              required
              class="w-full pl-12 pr-4 py-3.5 bg-white/70 dark:bg-white/5 border border-gray-200/60 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-[#A06B52]/20 focus:border-[#A06B52] outline-none transition-all placeholder:text-gray-300"
              placeholder="••••••••"
            />
          </div>
        </div>

        <button 
          type="submit" 
          :disabled="authStore.loading"
          class="w-full py-3.5 bg-[#A06B52] hover:bg-[#8B5A2B] text-white font-medium rounded-xl shadow-[0_10px_20px_-10px_rgba(160,107,82,0.4)] transition-all transform active:scale-[0.98] disabled:opacity-70 disabled:cursor-not-allowed flex items-center justify-center gap-2 mt-2"
        >
          <span v-if="authStore.loading" class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
          <span v-else>Sign In</span>
        </button>
      </form>

      <div class="mt-8 text-center text-xs text-gray-400">
        &copy; 2026 Calthea Coffee & Nature
      </div>
    </div>
  </div>
</template>
