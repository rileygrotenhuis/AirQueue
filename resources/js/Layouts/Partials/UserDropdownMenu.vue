<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { router } from '@inertiajs/vue3';

const logout = () => {
  router.post(route('logout'));
};
</script>

<template>
  <div class="relative ms-3">
    <Dropdown align="right" width="48">
      <template #trigger>
        <button
          class="flex text-sm transition font-bold text-orange-700 hover:text-orange-300 bg-orange-300 hover:bg-orange-700 rounded-full p-2"
        >
          {{ $page.props.auth.user.initials }}
        </button>
      </template>

      <template #content>
        <div class="block px-4 py-2 text-xs text-gray-400">Account</div>

        <DropdownLink :href="route('profile.index')"> Profile </DropdownLink>

        <form @submit.prevent="logout">
          <button
            type="submit"
            class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
          >
            Log Out
          </button>
        </form>
      </template>
    </Dropdown>
  </div>
</template>
