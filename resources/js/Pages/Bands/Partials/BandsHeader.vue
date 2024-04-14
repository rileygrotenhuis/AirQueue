<script setup lang="ts">
import InviteIcon from '@/Components/Icons/InviteIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
</script>

<template>
  <div class="flex justify-between items-center">
    <div>
      <a :href="route('bands.index')">
        <h3 class="text-3xl text-orange-700 font-bold">Bands</h3>
      </a>
      <p class="text-base font-light">Collaborate with other bandmates.</p>
    </div>
    <div class="flex gap-8">
      <a :href="route('bands.invitations')">
        <InviteIcon />
      </a>
      <a :href="route('bands.create')">
        <AddIcon />
      </a>
    </div>
  </div>
</template>
