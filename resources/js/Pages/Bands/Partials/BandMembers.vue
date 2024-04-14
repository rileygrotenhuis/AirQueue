<script setup>
import BandMemberBanner from '@/Pages/Bands/Partials/BandMemberBanner.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';

defineProps({
  band: Object,
  members: Array,
  isOwner: Boolean,
});
</script>

<template>
  <div
    class="max-h-[450px] overflow-y-auto border-2 border-orange-700 rounded-2xl p-4"
  >
    <div class="flex justify-between items-center mb-4">
      <h5 class="text-xl font-bold">Members</h5>
      <button>
        <AddIcon class="w-[25px]" />
      </button>
    </div>
    <div class="flex flex-col gap-2">
      <BandMemberBanner
        v-for="(member, index) in members"
        :key="index"
        :band="band"
        :member="member"
        :isOwner="isOwner"
      />
    </div>
  </div>
</template>
