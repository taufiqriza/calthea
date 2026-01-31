<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import SweetAlert from '@components/shared/SweetAlert.vue';

const menus = ref([]);
const loading = ref(true);
const searchTerm = ref('');
const showModal = ref(false);
const editingMenu = ref(null);
const submitting = ref(false);
const alertOpen = ref(false);
const alertKey = ref(0);
const alertType = ref('error');
const alertTitle = ref('Gagal menyimpan');
const alertMessage = ref('Terjadi kesalahan. Coba lagi.');

const form = ref({
    name: '',
    category: 'drink',
    price: '',
    description: '',
    image: null,
    is_available: true,
    is_featured: false
});

// File upload
const fileInput = ref(null);
const previewImage = ref(null);

const fetchMenus = async () => {
    loading.value = true;
    try {
        const response = await axios.get('/api/menu?all=true');
        menus.value = response.data.data;
    } catch (error) {
        console.error('Error loading menus', error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchMenus();
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(price);
};

// CRUD Logic
const resetForm = () => {
    form.value = {
        name: '',
        category: 'drink',
        price: '',
        description: '',
        image: null,
        is_available: true,
        is_featured: false
    };
    editingMenu.value = null;
    previewImage.value = null;
    if (fileInput.value) fileInput.value.value = '';
};

const handleAdd = () => {
    resetForm();
    showModal.value = true;
};

const handleEdit = (menu) => {
    editingMenu.value = menu;
    form.value = {
        name: menu.name,
        category: menu.category,
        price: menu.price,
        description: menu.description,
        is_available: Boolean(menu.is_available),
        is_featured: Boolean(menu.is_featured),
        image: null // New image only
    };
    previewImage.value = menu.image;
    showModal.value = true;
};

const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.value.image = file;
        previewImage.value = URL.createObjectURL(file);
    }
};

const handleSubmit = async () => {
    submitting.value = true;
    try {
        const formData = new FormData();
        formData.append('name', form.value.name);
        formData.append('category', form.value.category);
        formData.append('price', form.value.price);
        formData.append('description', form.value.description || '');
        formData.append('is_available', form.value.is_available ? '1' : '0');
        formData.append('is_featured', form.value.is_featured ? '1' : '0');
        
        if (form.value.image) {
            formData.append('image_file', form.value.image);
        }

        if (editingMenu.value) {
            // Update mode
            // Laravel needs _method=PUT to handle multipart/form-data with PUT
            formData.append('_method', 'PUT'); 
            await axios.post(`/api/menu/${editingMenu.value.id}`, formData);
        } else {
            // Create mode
            await axios.post('/api/menu', formData);
        }
        
        showModal.value = false;
        fetchMenus(); // Refresh list
    } catch (error) {
        console.error('Failed to save menu', error.response?.data || error);
        alertTitle.value = 'Gagal menyimpan menu';
        alertMessage.value = error?.response?.data?.message || 'Periksa data dan coba lagi.';
        alertKey.value += 1;
        alertOpen.value = true;
    } finally {
        submitting.value = false;
    }
};

const handleDelete = async (menu) => {
    if (confirm(`Are you sure you want to delete ${menu.name}?`)) {
        try {
            await axios.delete(`/api/menu/${menu.id}`);
            fetchMenus();
        } catch (error) {
            console.error('Failed to delete menu', error);
        }
    }
};
</script>

<template>
  <div>
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
      <div>
        <h2 class="text-xl font-bold font-serif text-admin-text-main-light dark:text-admin-text-main-dark">Menu Management</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your coffee shop menu items</p>
      </div>
      <button 
        class="px-4 py-2 bg-admin-primary text-white rounded-xl shadow-lg shadow-admin-primary/20 hover:bg-admin-primary/90 transition-all flex items-center gap-2"
        @click="handleAdd"
      >
        <span class="material-icons-outlined text-sm">add</span>
        <span>Add New Menu</span>
      </button>
    </div>

    <!-- Content Card -->
    <div class="bg-admin-card-light dark:bg-admin-card-dark rounded-2xl shadow-soft border border-white/40 dark:border-white/5 overflow-hidden backdrop-blur-md">
      <!-- Toolbar -->
      <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center gap-4">
        <div class="relative flex-1 max-w-md">
          <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
          <input 
            v-model="searchTerm"
            type="text" 
            placeholder="Search menu..." 
            class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-black/20 border border-gray-200 dark:border-white/10 rounded-lg focus:ring-2 focus:ring-admin-primary/20 focus:border-admin-primary outline-none transition-all text-sm"
          >
        </div>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto min-h-[300px]">
        <table class="w-full text-left text-sm">
          <thead class="bg-gray-50/50 dark:bg-white/5 text-gray-500 dark:text-gray-400 font-medium">
            <tr>
              <th class="px-6 py-3">Image</th>
              <th class="px-6 py-3">Name & Description</th>
              <th class="px-6 py-3">Category</th>
              <th class="px-6 py-3">Price</th>
              <th class="px-6 py-3">Status</th>
              <th class="px-6 py-3 text-right">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            <tr v-if="loading" class="animate-pulse">
                <td colspan="6" class="px-6 py-8 text-center text-gray-400">Loading menus...</td>
            </tr>
            <tr v-else-if="menus.length === 0">
                <td colspan="6" class="px-6 py-8 text-center text-gray-400">No menu items found. Add your first menu!</td>
            </tr>
            <tr 
              v-for="menu in menus" 
              :key="menu.id" 
              class="group hover:bg-admin-primary/5 transition-colors"
            >
              <td class="px-6 py-3">
                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-800 overflow-hidden relative shadow-sm border border-gray-200 dark:border-white/10">
                  <img v-if="menu.image" :src="menu.image" class="w-full h-full object-cover">
                  <div v-else class="w-full h-full flex items-center justify-center text-gray-400">
                    <span class="material-icons-outlined text-lg">image</span>
                  </div>
                </div>
              </td>
              <td class="px-6 py-3">
                <p class="font-bold text-admin-text-main-light dark:text-admin-text-main-dark">{{ menu.name }}</p>
                <p class="text-xs text-gray-400 line-clamp-1 max-w-[200px]">{{ menu.description || 'No description' }}</p>
                <span v-if="menu.is_featured" class="inline-block mt-1 text-[10px] bg-yellow-100 text-yellow-700 px-1.5 rounded font-medium">Featured</span>
              </td>
              <td class="px-6 py-3">
                <span :class="{
                    'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300': menu.category === 'drink',
                    'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300': menu.category === 'food',
                    'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300': menu.category === 'snack',
                }" class="px-2.5 py-1 rounded-full text-xs font-medium capitalize">
                    {{ menu.category }}
                </span>
              </td>
              <td class="px-6 py-3 font-medium text-admin-text-main-light dark:text-admin-text-main-dark">
                {{ formatPrice(menu.price) }}
              </td>
              <td class="px-6 py-3">
                <div class="flex items-center gap-2">
                    <div :class="`w-2 h-2 rounded-full ${menu.is_available ? 'bg-green-500' : 'bg-red-500'}`"></div>
                    <span class="text-xs text-gray-500">{{ menu.is_available ? 'Available' : 'Out of Stock' }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-right">
                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button @click="handleEdit(menu)" class="w-8 h-8 rounded-lg bg-white dark:bg-white/10 flex items-center justify-center text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 shadow-sm border border-gray-100 dark:border-white/5 transition-colors cursor-pointer">
                        <span class="material-icons-outlined text-sm">edit</span>
                    </button>
                    <button @click="handleDelete(menu)" class="w-8 h-8 rounded-lg bg-white dark:bg-white/10 flex items-center justify-center text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 shadow-sm border border-gray-100 dark:border-white/5 transition-colors cursor-pointer">
                        <span class="material-icons-outlined text-sm">delete</span>
                    </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Form -->
    <Transition name="fade">
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" @click="showModal = false"></div>
            
            <div class="bg-[#FDFBF9] dark:bg-[#1C1917] w-full max-w-2xl rounded-2xl shadow-2xl relative z-10 overflow-hidden flex flex-col max-h-[90vh] border border-white/40 dark:border-white/10">
                <div class="p-6 border-b border-gray-100 dark:border-white/5 bg-white/50 backdrop-blur-md">
                    <h3 class="text-xl font-bold font-serif text-admin-primary">{{ editingMenu ? 'Edit Menu' : 'Add New Menu' }}</h3>
                </div>
                
                <div class="p-6 overflow-y-auto custom-scrollbar">
                    <form @submit.prevent="handleSubmit" class="space-y-6">
                        <div class="flex gap-6 flex-col md:flex-row">
                            <!-- Image Upload -->
                            <div class="w-full md:w-1/3 space-y-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                                <div 
                                    class="aspect-square rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-700 flex flex-col items-center justify-center text-gray-400 hover:border-admin-primary hover:text-admin-primary transition-colors cursor-pointer relative overflow-hidden bg-gray-50 dark:bg-black/20"
                                    @click="$refs.fileInput.click()"
                                >
                                    <img v-if="previewImage" :src="previewImage" class="absolute inset-0 w-full h-full object-cover">
                                    <div v-else class="text-center p-4">
                                        <span class="material-icons-outlined text-3xl mb-1">add_photo_alternate</span>
                                        <p class="text-xs">Click to upload</p>
                                    </div>
                                    <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleFileChange">
                                </div>
                            </div>

                            <!-- Input Fields -->
                            <div class="w-full md:w-2/3 space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Name</label>
                                    <input v-model="form.name" type="text" required class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-admin-primary/20 focus:border-admin-primary outline-none text-sm placeholder:text-gray-300">
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Category</label>
                                        <select v-model="form.category" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-admin-primary/20 focus:border-admin-primary outline-none text-sm appearance-none">
                                            <option value="drink">Drink</option>
                                            <option value="food">Food</option>
                                            <option value="snack">Snack</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Price</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs">Rp</span>
                                            <input v-model="form.price" type="number" required class="w-full pl-8 pr-4 py-2 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-admin-primary/20 focus:border-admin-primary outline-none text-sm placeholder:text-gray-300">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea v-model="form.description" rows="3" class="w-full px-4 py-2 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-admin-primary/20 focus:border-admin-primary outline-none text-sm placeholder:text-gray-300"></textarea>
                                </div>
                                
                                <div class="flex gap-6">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input v-model="form.is_available" type="checkbox" class="rounded border-gray-300 text-admin-primary focus:ring-admin-primary">
                                        <span class="text-sm">Available</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input v-model="form.is_featured" type="checkbox" class="rounded border-gray-300 text-admin-primary focus:ring-admin-primary">
                                        <span class="text-sm">Featured</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-800">
                            <button type="button" @click="showModal = false" class="px-5 py-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5 rounded-xl transition-colors">Cancel</button>
                            <button type="submit" :disabled="submitting" class="px-5 py-2 bg-admin-primary text-white rounded-xl shadow-lg shadow-admin-primary/20 hover:bg-admin-primary/90 transition-all flex items-center gap-2">
                                <span v-if="submitting" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
                                <span>{{ editingMenu ? 'Update Menu' : 'Save Menu' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Transition>

    <SweetAlert
      :key="alertKey"
      :open="alertOpen"
      :type="alertType"
      :title="alertTitle"
      :message="alertMessage"
      @close="alertOpen = false"
    />
  </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background-color: rgba(160, 107, 82, 0.2);
  border-radius: 20px;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
