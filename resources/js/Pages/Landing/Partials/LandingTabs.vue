<script setup>
defineProps({
  tabs: Array,
  currentTab: Number,
});

defineEmits(['switchTabs']);
</script>

<template>
  <div>
    <div
      class="rounded-full px-4 py-2 bg-orange-400/50 flex justify-center gap-4"
    >
      <button
        v-for="(tab, index) in tabs"
        :key="index"
        class="w-full font-bold py-1 text-lg rounded-full transition-colors duration-300 hover:bg-orange-600 hover:text-white"
        :class="{
          'bg-orange-600 text-white': index === currentTab,
          'bg-none text-orange-600': index !== currentTab,
        }"
        @click="$emit('switchTabs', index)"
      >
        {{ tab }}
      </button>
    </div>
  </div>
</template>
