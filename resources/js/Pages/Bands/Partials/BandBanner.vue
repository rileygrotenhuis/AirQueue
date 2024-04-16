<script setup>
import MemberIcon from '@/Components/Icons/MemberIcon.vue';

defineProps({
  band: Object,
});
</script>

<template>
  <a :href="route('bands.show', band.id)">
    <div
      class="border flex justify-between items-center p-6 bg-orange-50 hover:bg-orange-200 cursor-pointer rounded-2xl"
    >
      <div>
        <h4 class="text-lg font-bold mb-1">
          {{ band.name }}
        </h4>
        <p class="text-sm font-light">
          {{ band.description }}
        </p>
      </div>

      <div class="flex items-center gap-8">
        <div class="flex items-center">
          <MemberIcon />
          <span class="font-bold">
            {{ band.members_count }}
          </span>
        </div>
      </div>
    </div>
  </a>
</template>
