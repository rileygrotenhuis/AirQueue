<script setup lang="ts">
import MemberIcon from '@/Components/Icons/MemberIcon.vue';
import { computed } from 'vue';

const props = defineProps({
  session: Object,
});

const authorText = computed(() => {
  if (props.session.band?.name) {
    return props.session.band.name + `(${props.session.host.initials})`;
  }

  return props.session.host.first_name + ' ' + props.session.host.last_name;
});
</script>

<template>
  <a :href="route('live-sessions.show', session.id)">
    <div
      class="border flex justify-between items-center p-6 bg-orange-50 hover:bg-orange-200 cursor-pointer rounded-2xl"
    >
      <div>
        <h4
          class="text-lg font-bold mb-1 truncate max-w-[100px] md:max-w-[300px]"
        >
          {{ session.title }}
        </h4>
        <p class="text-sm font-light max-w-[100px] md:max-w-[300px]">
          {{ authorText }}
        </p>
      </div>

      <div class="flex items-center gap-8">
        <div class="flex items-center">
          <MemberIcon />
          <span class="font-bold">
            {{ session.members.length }}
          </span>
        </div>
      </div>
    </div>
  </a>
</template>
