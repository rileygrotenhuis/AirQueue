<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BandsHeader from '@/Pages/Bands/Partials/BandsHeader.vue';
import BandBanner from '@/Pages/Bands/Partials/BandBanner.vue';

defineProps({
  bands: Array,
});
</script>

<template>
  <AuthenticatedLayout title="Bands">
    <div class="max-w-5xl mx-auto py-12 px-4">
      <BandsHeader />
      <div
        class="max-h-[700px] flex flex-col gap-8 p-6 rounded-2xl bg-orange-400/50 mt-8 overflow-y-auto"
      >
        <BandBanner v-for="(band, index) in bands" :key="index" :band="band" />
        <div
          v-if="bands.length === 0"
          class="text-center text-orange-900 text-lg font-bold"
        >
          Start a Band!
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
g
