import { defineStore } from 'pinia';
import axios from 'axios';

export const useMenuStore = defineStore('menu', {
  state: () => ({
    items: [],
    loading: false,
    error: null,
  }),
  getters: {
    drinks: (state) => state.items.filter((item) => item.category === 'drink'),
    foods: (state) => state.items.filter((item) => item.category === 'food'),
    snacks: (state) => state.items.filter((item) => item.category === 'snack'),
    featured: (state) => state.items.filter((item) => item.is_featured),
  },
  actions: {
    async fetch(params = {}) {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('/api/menu', { params });
        const payload = response?.data?.data;
        if (Array.isArray(payload)) {
          this.items = payload;
        } else if (payload && Array.isArray(payload.all)) {
          this.items = payload.all;
        } else {
          this.items = [];
        }
      } catch (error) {
        this.error = error?.response?.data?.message || 'Failed to load menu';
        this.items = [];
      } finally {
        this.loading = false;
      }
    },
  },
});
