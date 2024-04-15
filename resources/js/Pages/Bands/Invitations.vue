<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BandsHeader from '@/Pages/Bands/Partials/BandsHeader.vue';
import InvitationBanner from '@/Pages/Bands/Partials/InvitationBanner.vue';

defineProps({
  invitations: Array,
});
</script>

<template>
  <AuthenticatedLayout title="Bands">
    <div class="max-w-5xl mx-auto py-12 px-4">
      <BandsHeader title="Band Invitations" />
      <div
        class="max-h-[700px] flex flex-col gap-8 p-6 rounded-2xl bg-orange-400/50 mt-8 overflow-y-auto"
      >
        <InvitationBanner
          v-for="(invitation, index) in invitations"
          :key="index"
          :invitation="invitation"
        />
        <div
          v-if="invitations.length === 0"
          class="text-center text-orange-900 text-lg font-bold"
        >
          Waiting for Invitations!
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
