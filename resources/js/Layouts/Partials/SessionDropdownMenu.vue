<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import SessionIcon from '@/Components/Icons/SessionIcon.vue';
import Modal from '@/Components/Modal.vue';
import StartSession from '@/Layouts/Partials/StartSession.vue';
import JoinSession from '@/Layouts/Partials/JoinSession.vue';
import { ref } from 'vue';

const startSessionModalOpen = ref(false);
const joinSessionModalOpen = ref(false);
</script>

<template>
  <Modal :show="startSessionModalOpen">
    <StartSession @close="startSessionModalOpen = false" />
  </Modal>

  <Modal :show="joinSessionModalOpen">
    <JoinSession @close="joinSessionModalOpen = false" />
  </Modal>

  <div class="relative ms-3">
    <Dropdown align="right" width="48">
      <template #trigger>
        <SessionIcon class="cursor-pointer" />
      </template>

      <template #content>
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
      </template>
    </Dropdown>
  </div>
</template>
