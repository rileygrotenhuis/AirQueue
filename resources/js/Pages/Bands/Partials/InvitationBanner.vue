<script setup lang="ts">
import MemberIcon from '@/Components/Icons/MemberIcon.vue';
import ApproveIcon from '@/Components/Icons/ApproveIcon.vue';
import RejectIcon from '@/Components/Icons/RejectIcon.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  invitation: Object,
});

const acceptInvitation = () => {
  router.post(route('bands.invitations.accept', props.invitation.pivot.id));
};

const declineInvitation = () => {
  router.post(route('bands.invitations.reject', props.invitation.pivot.id));
};
</script>

<template>
  <a href="#">
    <div
      class="border flex justify-between items-center p-6 bg-orange-50 hover:bg-orange-200 cursor-pointer rounded-2xl"
    >
      <div>
        <h4 class="text-lg font-bold mb-1">
          {{ invitation.name }}
        </h4>
        <p class="text-sm font-light">
          {{ invitation.description }}
        </p>
      </div>

      <div class="flex items-center gap-8">
        <div class="hidden sm:flex items-center">
          <MemberIcon />
          <span class="font-bold">
            {{ invitation.members_count }}
          </span>
        </div>

        <div class="flex items-center gap-4 md:gap-8">
          <button @click.prevent="declineInvitation">
            <RejectIcon />
          </button>
          <button @click.prevent="acceptInvitation">
            <ApproveIcon />
          </button>
        </div>
      </div>
    </div>
  </a>
</template>
