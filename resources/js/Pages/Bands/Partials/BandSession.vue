<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  band: Object,
  liveSession: Object,
});

const form = useForm({
  band_id: props.band.id,
  title: props.band.name,
  session_key: props.band.name,
  session_passcode: null,
});

const startSession = () => {
  form.post(route('live-sessions.store'));
};

const endSession = () => {
  useForm({}).delete(route('live-sessions.destroy', props.liveSession.id));
};
</script>

<template>
  <div
    class="max-h-[450px] overflow-y-auto border-2 border-orange-700 rounded-2xl p-4"
  >
    <h5 class="text-xl font-bold mb-4">Live Session</h5>
    <button
      v-if="liveSession"
      class="w-full bg-red-600 text-white px-4 py-2 rounded-lg border-2 border-red-600 hover:bg-white hover:text-red-600 font-bold transition-colors duration-300 ease-in-out hover:cursor-pointer"
      @click.prevent="endSession"
    >
      End
    </button>
    <button
      v-else
      class="w-full bg-green-500 text-white px-4 py-2 rounded-lg border-2 border-green-500 hover:bg-white hover:text-green-500 font-bold transition-colors duration-300 ease-in-out hover:cursor-pointer"
      @click.prevent="startSession"
    >
      Start
    </button>
  </div>
</template>
