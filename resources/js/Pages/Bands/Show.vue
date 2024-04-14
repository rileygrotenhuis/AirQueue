<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  band: Object,
});

const form = useForm({
  name: props.band.name,
  description: props.band.description,
});

const submit = () => {
  form.put(route('bands.update', props.band.id));
};
</script>

<template>
  <AuthenticatedLayout title="Bands">
    <div class="max-w-4xl mx-auto py-12 px-4">
      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <h3 class="text-orange-700 font-bold text-3xl mb-1">Manage Band</h3>
          <p class="font-light text-base">
            Manage the settings of your band and invite other members to join.
          </p>
          <p></p>
        </div>
        <div>
          <label class="text-lg mb-2" for="name">Band Name</label>
          <input
            v-model="form.name"
            type="text"
            id="name"
            class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
            placeholder="Enter your band name..."
          />
        </div>
        <div>
          <label class="text-lg mb-2" for="name">Description</label>
          <input
            v-model="form.description"
            type="text"
            id="description"
            class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
            placeholder="Band description..."
          />
        </div>
        <div>
          <button
            type="submit"
            class="float-right w-[150px] bg-orange-700 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer"
          >
            Save
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
