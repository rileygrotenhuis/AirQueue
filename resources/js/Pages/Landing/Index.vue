<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SessionBanner from '@/Pages/Landing/Partials/SessionBanner.vue';

defineProps({
  liveSessions: Array,
});
</script>

<template>
  <AuthenticatedLayout title="Home">
    <div class="max-w-5xl mx-auto py-12 px-4">
      <div
        class="max-h-[700px] flex flex-col gap-8 p-6 rounded-2xl bg-orange-400/50 mt-8 overflow-y-auto"
      >
        <SessionBanner
          v-for="(session, index) in liveSessions"
          :key="index"
          :session="session"
        />
        <div
          v-if="liveSessions.length === 0"
          class="text-center text-orange-900 text-lg font-bold"
        >
          Start a Live Session!
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
