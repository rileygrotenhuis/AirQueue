<script setup lang="ts">
import ApproveIcon from '@/Components/Icons/ApproveIcon.vue';
import RejectIcon from '@/Components/Icons/RejectIcon.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  songRequest: Object,
});

const rejectSongRequest = () => {
  useForm({}).post(route('song-requests.reject', props.songRequest.id));
};

const approveSongRequest = () => {
  useForm({}).post(route('song-requests.approve', props.songRequest.id));
};
</script>

<template>
  <div
    class="border flex justify-between items-center p-6 bg-orange-50 cursor-pointer rounded-2xl hover:shadow-xl"
  >
    <div class="flex gap-2 items-center">
      <div>
        <img
          :src="songRequest.spotify_image_url"
          :alt="songRequest.song_name"
          class="w-8 h-8 md:w-16 md:h-16 rounded-lg"
        />
      </div>

      <div>
        <h4
          class="text-sm md:text-lg font-bold truncate max-w-[100px] md:max-w-[300px]"
        >
          {{ songRequest.song_name }}
        </h4>
        <p
          class="text-xs md:text-base font-light truncate max-w-[100px] md:max-w-[300px]"
        >
          {{ songRequest.song_artist }}
        </p>
      </div>
    </div>

    <div class="flex items-center gap-4 md:gap-8">
      <button @click.prevent="rejectSongRequest">
        <RejectIcon />
      </button>
      <button @click.prevent="approveSongRequest">
        <ApproveIcon />
      </button>
    </div>
  </div>
</template>
