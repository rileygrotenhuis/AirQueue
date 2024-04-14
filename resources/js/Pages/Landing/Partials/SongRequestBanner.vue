<script setup lang="ts">
const props = defineProps({
  songRequest: Object,
});
</script>

<template>
  <div
    class="border flex justify-between items-center p-6 bg-orange-50 hover:bg-orange-200 cursor-pointer rounded-2xl"
  >
    <div class="flex gap-2 items-center">
      <div>
        <img
          :src="songRequest.spotify_image_url"
          :alt="songRequest.song_name"
          class="w-16 h-16 rounded-lg"
        />
      </div>

      <div>
        <h4 class="text-lg font-bold mb-1">
          {{ songRequest.song_name }}
        </h4>
        <p class="text-sm font-light">
          {{ songRequest.song_artist }}
        </p>
      </div>
    </div>

    <div class="flex items-center gap-8">Approve/Reject</div>
  </div>
</template>
