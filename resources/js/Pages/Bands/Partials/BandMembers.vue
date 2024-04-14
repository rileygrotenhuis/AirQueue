<script setup>
import BandMemberBanner from '@/Pages/Bands/Partials/BandMemberBanner.vue';
import AddIcon from '@/Components/Icons/AddIcon.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import InviteMember from '@/Pages/Bands/Partials/InviteMember.vue';

defineProps({
  band: Object,
  members: Array,
  isOwner: Boolean,
});

const showModal = ref(false);
</script>

<template>
  <Modal :show="showModal" @close="showModal = false">
    <InviteMember :band="band" @close="showModal = false" />
  </Modal>
  <div
    class="max-h-[450px] overflow-y-auto border-2 border-orange-700 rounded-2xl p-4"
  >
    <div class="flex justify-between items-center mb-4">
      <h5 class="text-xl font-bold">
        Members
        <span class="font-normal">({{ members.length }})</span>
      </h5>
      <button @click="showModal = true">
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
