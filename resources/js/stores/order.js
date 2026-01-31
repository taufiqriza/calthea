import { defineStore } from 'pinia';
import axios from 'axios';

export const useOrderStore = defineStore('order', {
  state: () => ({
    items: [],
    submitting: false,
    error: null,
    success: false,
  }),
  getters: {
    itemCount: (state) => state.items.reduce((sum, item) => sum + item.quantity, 0),
    total: (state) =>
      state.items.reduce((sum, item) => sum + item.price * item.quantity, 0),
  },
  actions: {
    addItem(menu, quantity = 1) {
      if (this.success) this.success = false;
      const existing = this.items.find((item) => item.menu_id === menu.id);
      if (existing) {
        existing.quantity += quantity;
        return;
      }
      this.items.push({
        menu_id: menu.id,
        name: menu.name,
        price: Number(menu.price),
        quantity,
      });
    },
    removeItem(menuId) {
      this.items = this.items.filter((item) => item.menu_id !== menuId);
    },
    updateQty(menuId, qty) {
      const item = this.items.find((i) => i.menu_id === menuId);
      if (!item) return;
      item.quantity = Math.max(1, qty);
    },
    clear() {
      this.items = [];
      this.error = null;
      this.success = false;
    },
    async submit(payload) {
      this.submitting = true;
      this.error = null;
      this.success = false;
      try {
        const response = await axios.post('/api/orders', {
          customer_name: payload.customer_name,
          table_number: payload.table_number,
          notes: payload.notes || null,
          items: this.items.map((item) => ({
            menu_id: item.menu_id,
            quantity: item.quantity,
          })),
        });
        this.items = [];
        this.error = null;
        this.success = true;
        return response.data;
      } catch (error) {
        this.error = error?.response?.data?.message || 'Failed to submit order';
        throw error;
      } finally {
        this.submitting = false;
      }
    },
  },
});
