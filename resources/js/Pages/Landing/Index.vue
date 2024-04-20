<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SessionBanner from '@/Pages/Landing/Partials/SessionBanner.vue';
import LandingTabs from '@/Pages/Landing/Partials/LandingTabs.vue';
import SongRequestBanner from '@/Components/SongRequests/SongRequestBanner.vue';
import { ref } from 'vue';

defineProps({
  playbackStatus: Boolean,
  songRequests: Array,
  liveSessions: Array,
});

const tabs = ['Requests', 'Live Sessions'];

const currentTab = ref(0);

const switchTabs = (tab) => {
  currentTab.value = tab;
};
</script>

<template>
  <AuthenticatedLayout title="Home">
    <div class="max-w-5xl mx-auto py-12 px-4">
      <LandingTabs
        :tabs="tabs"
        :currentTab="currentTab"
        @switchTabs="switchTabs"
      />

      <div
        v-if="currentTab === 0"
        class="max-h-[700px] flex flex-col gap-8 p-6 rounded-2xl bg-orange-400/50 mt-8 overflow-y-auto"
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
          :playbackStatus="playbackStatus"
          :songRequest="songRequest"
        />
        <div
          v-if="songRequests.length === 0"
          class="text-center text-orange-900 text-lg font-bold"
        >
          All incoming song requests...
        </div>
      </div>

      <div
        v-if="currentTab === 1"
        class="max-h-[700px] flex flex-col gap-8 p-6 rounded-2xl bg-orange-400/50 mt-8 overflow-y-auto"
      >
        <SessionBanner
          v-for="(session, index) in liveSessions"
          :key="index"
          :session="session"
        />
        <div
          v-if="liveSessions.length === 0"
          class="text-center text-orange-900 text-lg font-bold"
        >
          Start a Live Session!
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
