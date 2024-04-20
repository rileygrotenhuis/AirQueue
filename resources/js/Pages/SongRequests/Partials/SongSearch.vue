<script setup lang="ts">
import axios from 'axios';
import { ref } from 'vue';

const searchQuery = ref('');
const searchResults = ref([]);
const selectedSong = ref(null);

defineExpose({ selectedSong });

const songSearch = () => {
  axios
    .get(route('song-requests.search', { search: searchQuery.value }))
    .then((response) => {
      searchResults.value = response.data.tracks.items;
    })
    .catch((error) => {
      console.error(error.response.data.message);
    });
};

const selectSong = (song) => {
  selectedSong.value = {
    song_name: song.name,
    song_artist: song.album.artists[0].name,
    spotify_image_url: song.album.images[2].url,
    spotify_track_id: song.id,
    spotify_track_uri: song.uri,
  };
};
</script>

<template>
  <div>
    <div>
      <label class="text-lg mb-2" for="name">Song Name</label>
      <input
        v-model="searchQuery"
        type="text"
        id="song_name"
        class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
        placeholder="Enter your song name..."
      />
      <button
        class="w-[150px] bg-orange-700 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer mt-4"
        @click.prevent="songSearch"
      >
        Search
      </button>
    </div>

    <div class="flex flex-col gap-8 mt-8">
      <div
        v-if="searchResults.length > 0"
        v-for="(song, index) in searchResults"
        :key="index"
        class="w-full p-6 border border-orange-700 rounded-lg flex gap-4 items-center cursor-pointer hover:bg-orange-700/10 transition-all duration-300 ease-in-out"
        :class="{
          'bg-white': selectedSong?.song_name !== song.name,
          'bg-orange-700/10': selectedSong?.song_name === song.name,
        }"
        @click.prevent="selectSong(song)"
      >
        <img :src="song.album.images[2].url" :alt="song.name" />
        <div class="max-w-[400px]">
          <p>{{ song.name }}</p>
          <p class="font-bold">{{ song.album.artists[0].name }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
