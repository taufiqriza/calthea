<script setup>
import { computed, watch, onBeforeUnmount } from 'vue';

const props = defineProps({
  open: { type: Boolean, default: false },
  type: { type: String, default: 'info' }, // success | error | info
  title: { type: String, default: '' },
  message: { type: String, default: '' },
  confirmText: { type: String, default: 'OK' },
  autoClose: { type: Boolean, default: false },
  autoCloseMs: { type: Number, default: 1400 },
});

const emit = defineEmits(['close']);
let timer = null;

const iconClass = computed(() => {
  if (props.type === 'success') return 'fas fa-check';
  if (props.type === 'error') return 'fas fa-exclamation-triangle';
  return 'fas fa-info-circle';
});

const iconWrapClass = computed(() => {
  if (props.type === 'success') return 'bg-green-500 text-white';
  if (props.type === 'error') return 'bg-red-500 text-white';
  return 'bg-coffee-500 text-white';
});

const titleClass = computed(() => {
  if (props.type === 'success') return 'text-green-800';
  if (props.type === 'error') return 'text-red-800';
  return 'text-coffee-800';
});

watch(
  () => props.open,
  (open) => {
    if (!open) return;
    if (props.autoClose) {
      clearTimeout(timer);
      timer = setTimeout(() => emit('close'), props.autoCloseMs);
    }
  }
);

onBeforeUnmount(() => {
  clearTimeout(timer);
});
</script>

<template>
  <Transition
    enter-active-class="transition ease-out duration-200"
    enter-from-class="opacity-0 scale-95"
    enter-to-class="opacity-100 scale-100"
    leave-active-class="transition ease-in duration-150"
    leave-from-class="opacity-100 scale-100"
    leave-to-class="opacity-0 scale-95"
  >
    <div v-if="open" class="fixed inset-0 z-[80] flex items-center justify-center">
      <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
      <div class="relative w-[92%] max-w-sm bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="px-6 py-6 text-center space-y-3">
          <div class="w-12 h-12 mx-auto rounded-full flex items-center justify-center" :class="iconWrapClass">
            <i :class="iconClass"></i>
          </div>
          <h3 class="font-serif text-xl font-bold" :class="titleClass">{{ title }}</h3>
          <p class="text-sm text-coffee-600">{{ message }}</p>
        </div>
        <div class="px-6 pb-6">
          <button
            v-if="!autoClose"
            class="w-full py-3 rounded-xl bg-coffee-600 hover:bg-coffee-700 text-white font-semibold"
            @click="$emit('close')"
          >
            {{ confirmText }}
          </button>
        </div>
      </div>
    </div>
  </Transition>
</template>
