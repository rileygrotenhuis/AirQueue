<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SongRequestBanner from '@/Components/SongRequests/SongRequestBanner.vue';
import SessionMembers from '@/Pages/LiveSessions/Partials/SessionMembers.vue';
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const props = defineProps({
  playbackStatus: Boolean,
  liveSession: Object,
  songRequests: Array,
  members: Array,
});

const isOwner = computed(() => {
  return props.liveSession.host_id === usePage().props.auth.user.id;
});

const endSession = () => {
  if (window.confirm('Are you sure you want to end this session?')) {
    router.delete(route('live-sessions.destroy', props.liveSession.id));
  }
};
</script>

<template>
  <AuthenticatedLayout title="Sessions">
    <div class="max-w-5xl mx-auto flex justify-between items-center px-4 mt-12">
      <h3 class="text-2xl text-orange-800 font-bold">Song Requests</h3>
      <button
        v-if="isOwner"
        class="w-fit sm:w-[150px] bg-orange-800 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer"
        @click.prevent="endSession"
      >
        END
      </button>
    </div>
    <div
      class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto py-4 px-4"
    >
      <div class="col-span-2">
        <div
          class="max-h-[700px] flex flex-col gap-8 p-6 rounded-2xl bg-orange-400/50 overflow-y-auto"
        >
          <p
            v-if="!playbackStatus"
            class="w-full bg-orange-900 p-2 rounded-xl text-white text-base md:text-lg text-center"
          >
            You must be playing music on a device to approve or reject song
            requests.
          </p>

          <SongRequestBanner
            v-for="(songRequest, index) in songRequests"
            :key="index"
            :songRequest="songRequest"
            :playbackStatus="playbackStatus"
          />
          <div
            v-if="songRequests.length === 0"
            class="text-center text-orange-900 text-lg font-bold"
          >
            Waiting for requests...
          </div>
        </div>
      </div>
      <div class="col-span-1">
        <SessionMembers
          :session="liveSession"
          :members="members"
          :isOwner="isOwner"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
