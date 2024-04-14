<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  band: Object,
  liveSessions: Array,
});

const form = useForm({
  band_id: props.band.id,
  title: props.band.name,
  session_key: props.band.name,
  session_passcode: null,
});

const joinSession = (sessionId) => {
  // live-sessions.join
};

const leaveSession = (sessionId) => {
  // live-sessions.leave
};
</script>

<template>
  <div
    class="max-h-[450px] overflow-y-auto border-2 border-orange-700 rounded-2xl p-4"
  >
    <h5 class="text-xl font-bold mb-4">Live Sessions</h5>
    <div class="flex flex-col gap-4">
      <div
        v-for="(session, index) in liveSessions"
        :key="index"
        class="w-full bg-orange-300 text-orange-700 px-4 py-2 rounded-lg hover:bg-orange-700 hover:text-white font-bold transition-colors duration-300 ease-in-out hover:cursor-pointer w-full text-center"
        @click.prevent="joinSession(session.id)"
      >
        <div class="truncate mx-auto max-w-full md:max-w-[225px]">
          {{ session.title }}
        </div>
      </div>
    </div>
  </div>
</template>
