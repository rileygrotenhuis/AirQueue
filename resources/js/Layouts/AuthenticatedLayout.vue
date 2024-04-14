<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import LogoIcon from '@/Components/Icons/LogoIcon.vue';
import SessionIcon from '@/Components/Icons/SessionIcon.vue';
import UserDropdownMenu from '@/Layouts/Partials/UserDropdownMenu.vue';

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
          <LogoIcon />
        </a>

        <div class="flex items-center gap-16">
          <span class="cursor-pointer">
            <SessionIcon />
          </span>
          <UserDropdownMenu />
        </div>
      </div>
    </nav>

    <main>
      <slot />
    </main>
  </div>
</template>
