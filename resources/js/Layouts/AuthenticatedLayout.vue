<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import SessionIcon from '@/Components/Icons/SessionIcon.vue';

defineProps({
  title: String,
});

const user = usePage().props.auth.user;
</script>

<template>
  <Head :title="title" />
  <div>
    <nav class="w-full px-4 py-4 bg-orange-700">
      <div class="max-w-4xl mx-auto flex justify-between items-center">
        <a :href="route('home')" class="hover:cursor-pointer">
          <ApplicationLogo />
        </a>

        <div class="flex items-center gap-16">
          <span class="cursor-pointer">
            <SessionIcon />
          </span>
          <span
            class="text-white text-base font-bold border border-white p-2 rounded-full cursor-pointer"
            >{{ user.initials }}</span
          >
        </div>
      </div>
    </nav>

    <main>
      <slot />
    </main>
  </div>
</template>
