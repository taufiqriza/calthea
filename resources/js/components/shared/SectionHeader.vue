<script setup>
defineProps({
  badge: {
    type: String,
    default: '',
  },
  title: {
    type: String,
    required: true,
  },
  subtitle: {
    type: String,
    default: '',
  },
});
</script>

<template>
  <div class="text-center max-w-2xl mx-auto mb-16">
    <span 
      v-if="badge" 
      class="inline-block px-4 py-2 bg-coffee-100 text-coffee-600 text-sm font-medium rounded-full mb-4"
    >
      {{ badge }}
    </span>
    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-coffee-900 mb-6" v-html="title"></h2>
    <p v-if="subtitle" class="text-coffee-600 text-lg">
      {{ subtitle }}
    </p>
  </div>
</template>
