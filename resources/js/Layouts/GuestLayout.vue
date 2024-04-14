<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

defineProps({
  title: String,
});
</script>

<template>
  <Head :title="title" />
  <div>
    <nav class="w-full px-4 py-4 bg-orange-700 text-center">
      <a :href="route('home')">
        <h1 class="text-4xl text-white font-bold w-full">AirQueue</h1>
      </a>
    </nav>

    <main class="bg-container">
      <slot />
    </main>
  </div>
</template>

<style scoped>
.bg-container {
  background-image: url('/images/auth_background.jpg');
  background-size: cover;
  background-position: center;
  min-height: calc(100vh - 4rem);
  display: flex;
  justify-content: center;
}
</style>
