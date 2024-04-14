<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  session: Object,
  member: Object,
  isOwner: Boolean,
});

const isSelf = computed(() => {
  return props.member.id === usePage().props.auth.user.id;
});

const removeMember = () => {
  alert('Removing');
};
</script>

<template>
  <div
    class="flex justify-between items-center py-1 px-2 rounded-xl cursor-pointer hover:bg-orange-400/50"
  >
    <div class="flex gap-2 items-center">
      <span
        class="bg-orange-300 text-orange-700 font-bold hover:text-orange-300 hover:bg-orange-700 cursor-pointer rounded-full text-sm p-2"
        >{{ member.initials }}</span
      >
      <div class="text-sm">
        <p>{{ member.first_name }} {{ member.last_name }}</p>
      </div>
    </div>

    <div v-if="isOwner && !isSelf">
      <button @click.prevent="removeMember">X</button>
    </div>
  </div>
</template>
