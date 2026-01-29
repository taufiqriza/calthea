<script setup>
import { computed } from 'vue';
import { RouterLink } from 'vue-router';

const props = defineProps({
  variant: {
    type: String,
    default: 'primary',
    validator: (value) => ['primary', 'secondary', 'outline'].includes(value),
  },
  size: {
    type: String,
    default: 'md',
    validator: (value) => ['sm', 'md', 'lg'].includes(value),
  },
  icon: {
    type: String,
    default: '',
  },
  href: {
    type: String,
    default: '',
  },
  to: {
    type: String,
    default: '',
  },
});

const classes = computed(() => {
  const base = 'inline-flex items-center justify-center gap-2 font-semibold rounded-full transition-all duration-300';
  
  const variants = {
    primary: 'bg-coffee-600 text-white hover:bg-coffee-700 hover:shadow-xl hover:shadow-coffee-600/30 hover:-translate-y-1',
    secondary: 'bg-gradient-to-r from-coffee-500 to-coffee-600 text-white hover:from-coffee-600 hover:to-coffee-700 hover:shadow-lg',
    outline: 'bg-white text-coffee-700 border-2 border-coffee-200 hover:border-coffee-400 hover:shadow-xl',
  };
  
  const sizes = {
    sm: 'px-6 py-2 text-sm',
    md: 'px-8 py-4',
    lg: 'px-10 py-5 text-lg',
  };
  
  return `${base} ${variants[props.variant]} ${sizes[props.size]}`;
});

const component = computed(() => {
  if (props.to) return RouterLink;
  if (props.href) return 'a';
  return 'button';
});

const linkProps = computed(() => {
  if (props.to) return { to: props.to };
  if (props.href) return { href: props.href };
  return {};
});
</script>

<template>
  <component :is="component" :class="classes" v-bind="linkProps">
    <i v-if="icon" :class="`fas ${icon}`"></i>
    <slot />
  </component>
</template>
