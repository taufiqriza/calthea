<script setup>
import { RouterView } from 'vue-router';
</script>

<template>
  <RouterView v-slot="{ Component, route }">
    <div class="relative min-h-[60vh]">
      <Transition
        :name="route.meta.transition || 'page'"
        mode="in-out"
      >
        <component :is="Component" :key="route.fullPath" />
      </Transition>
    </div>
  </RouterView>
</template>

<style>
/* Default page transition (smooth SPA load) */
.page-enter-active,
.page-leave-active {
  transition: opacity 0.35s cubic-bezier(0.22, 1, 0.36, 1), transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
  will-change: opacity, transform;
}

.page-enter-from {
  opacity: 0;
  transform: translateY(10px) scale(0.995);
}

.page-leave-to {
  opacity: 0;
  transform: translateY(-6px) scale(0.995);
}

.page-leave-active {
  position: absolute;
  inset: 0;
}

/* Fallback transitions (optional) */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
  transition: opacity 0.35s ease, transform 0.35s ease;
}

.slide-enter-from {
  opacity: 0;
  transform: translateX(16px);
}

.slide-leave-to {
  opacity: 0;
  transform: translateX(-16px);
}
</style>
