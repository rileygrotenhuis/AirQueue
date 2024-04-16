<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
  band: Object,
});

const emit = defineEmits(['close']);

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('bands.invite', props.band.id), {
    onSuccess: () => {
      emit('close');
    },
  });
};
</script>

<template>
  <div class="p-6">
    <div>
      <h3 class="text-orange-700 font-bold text-3xl mb-1">Invite Member</h3>
      <p class="font-light text-base">
        Invite a new member to join your band and collaborate in regular live
        sessions.
      </p>
    </div>
    <form @submit.prevent="submit" class="space-y-6 py-6">
      <div>
        <label class="text-lg mb-2" for="name">Member's Email</label>
        <input
          v-model="form.email"
          type="email"
          id="email"
          class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
          placeholder="Enter new member's email address..."
        />
        <InputError class="mt-1" :message="form.errors.email" />
      </div>
      <div>
        <button
          type="submit"
          class="float-right w-[150px] bg-orange-700 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer"
        >
          Invite
        </button>
      </div>
    </form>
  </div>
</template>
