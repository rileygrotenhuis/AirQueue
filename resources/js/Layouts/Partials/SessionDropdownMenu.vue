<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import SessionIcon from '@/Components/Icons/SessionIcon.vue';
import Modal from '@/Components/Modal.vue';
import StartSession from '@/Layouts/Partials/StartSession.vue';
import JoinSession from '@/Layouts/Partials/JoinSession.vue';
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const startSessionModalOpen = ref(false);
const joinSessionModalOpen = ref(false);

const user = usePage().props.auth.user;
</script>

<template>
  <Modal :show="startSessionModalOpen" @close="startSessionModalOpen = false">
    <StartSession @close="startSessionModalOpen = false" />
  </Modal>

  <Modal :show="joinSessionModalOpen" @close="joinSessionModalOpen = false">
    <JoinSession @close="joinSessionModalOpen = false" />
  </Modal>

  <div class="relative ms-3">
    <Dropdown align="right" width="48">
      <template #trigger>
        <SessionIcon class="cursor-pointer" />
      </template>

      <template #content>
        <div v-if="user.is_spotify_connected">
          <div class="block px-4 py-2 text-xs text-gray-400">Sessions</div>

          <button
            @click="startSessionModalOpen = true"
            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
          >
            Start session
          </button>
          <button
            @click="joinSessionModalOpen = true"
            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
          >
            Join session
          </button>

          <hr class="mb-2" />

          <div class="block px-4 py-2 text-xs text-gray-400">Songs</div>

          <a
            :href="route('song-requests.index')"
            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
          >
            + Request a song
          </a>
        </div>
        <div v-else>
          <div class="block px-4 py-2 text-xs text-gray-400">Spotify</div>

          <a
            href="/profile"
            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
          >
            Connect to Spotify
          </a>
        </div>
      </template>
    </Dropdown>
  </div>
</template>
