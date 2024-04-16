<script setup>
import InviteIcon from '@/Components/Icons/InviteIcon.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';

defineProps({
  title: String,
  invitationCount: Number,
});
</script>

<template>
  <div class="flex justify-between items-center">
    <div>
      <a :href="route('bands.index')">
        <h3 class="text-3xl text-orange-700 font-bold">
          {{ title }}
        </h3>
      </a>
      <p class="text-base font-light">Collaborate with other bandmates.</p>
    </div>
    <div class="flex gap-8">
      <a :href="route('bands.invitations')" class="flex items-center">
        <InviteIcon />
        <span
          v-if="invitationCount > 0"
          class="text-lg text-orange-700 font-bold"
        >
          {{ invitationCount }}
        </span>
      </a>
      <a :href="route('bands.create')">
        <AddIcon />
      </a>
    </div>
  </div>
</template>
