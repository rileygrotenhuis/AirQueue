<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  liveSessions: Array,
});
</script>

<template>
  <AuthenticatedLayout title="Home">
    <div>
      {{ JSON.stringify(liveSessions) }}
    </div>
  </AuthenticatedLayout>
</template>
