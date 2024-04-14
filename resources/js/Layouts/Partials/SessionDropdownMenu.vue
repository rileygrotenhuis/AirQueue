<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import SessionIcon from '@/Components/Icons/SessionIcon.vue';
</script>

<template>
  <div class="relative ms-3">
    <Dropdown align="right" width="48">
      <template #trigger>
        <SessionIcon class="cursor-pointer" />
      </template>

      <template #content>
        <div class="block px-4 py-2 text-xs text-gray-400">Sessions</div>

        <DropdownLink href="#"> Start session </DropdownLink>
        <DropdownLink href="#"> Join session </DropdownLink>
      </template>
    </Dropdown>
  </div>
</template>
