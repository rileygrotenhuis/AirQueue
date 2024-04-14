<script setup lang="ts">
import InviteIcon from '@/Components/Icons/InviteIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
</script>

<template>
  <div class="flex justify-between items-center">
    <h3 class="text-orange-600 text-4xl font-bold">Your Bands</h3>
    <div class="flex gap-8">
      <a href="#" class="flex items-center gap-4 text-3xl text-orange-600">
        <InviteIcon />
      </a>
      <a
        :href="route('bands.create')"
        class="flex items-center gap-4 text-3xl text-orange-600"
      >
        <AddIcon />
      </a>
    </div>
  </div>
</template>
