<script setup>
import SessionMemberBanner from '@/Pages/LiveSessions/Partials/SessionMemberBanner.vue';

defineProps({
  session: Object,
  members: Array,
  isOwner: Boolean,
});
</script>

<template>
  <div
    class="max-h-[450px] overflow-y-auto border-2 border-orange-700 rounded-2xl p-4"
  >
    <div class="flex justify-between items-center mb-4">
      <h5 class="text-xl font-bold">
        Members
        <span class="font-normal">({{ members.length }})</span>
      </h5>
    </div>
    <div class="flex flex-col gap-2">
      <SessionMemberBanner
        v-for="(member, index) in members"
        :key="index"
        :session="session"
        :member="member"
        :isOwner="isOwner"
      />
    </div>
  </div>
</template>
