<script setup lang="ts">
import axios from 'axios';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const searchQuery = ref('');

const songSearch = () => {
  axios.get('https://api.spotify.com/v1/search', {
    params: {
      q: searchQuery.value,
      type: 'track',
      limit: 5,
    },
    headers: {
      'Content-Type': 'application/json',
      Authorization: `Bearer ${usePage().props.auth.user.spotify_tokens[0].access_token}`
    }
  }).then((response) => {
    console.log(resopnse.data);
  }).catch((error) => {
    alert('ERROR WITH SEARCH');
    console.error(error.response.data);
  });
};
</script>

<template>
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
      class="float-right w-[150px] bg-orange-700 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer mt-4"
      @click.prevent="songSearch"
    >
      Search
    </button>
  </div>
</template>
