<script setup>
import { useForm } from '@inertiajs/vue3';
import BandSessionBanner from '@/Pages/Bands/Partials/BandSessionBanner.vue';

const props = defineProps({
  band: Object,
  bandSessions: Array,
});

const form = useForm({
  band_id: props.band.id,
  title: props.band.name,
  session_key: props.band.name,
  session_passcode: null,
});
</script>

<template>
  <div
    class="max-h-[450px] overflow-y-auto border-2 border-orange-700 rounded-2xl p-4"
  >
    <h5 class="text-xl font-bold mb-4">Live Sessions</h5>
    <div class="flex flex-col gap-4">
      <BandSessionBanner
        v-for="(session, index) in bandSessions"
        :key="index"
        :session="session"
      />
      <div v-if="bandSessions.length === 0">No band sessions.</div>
    </div>
  </div>
</template>
