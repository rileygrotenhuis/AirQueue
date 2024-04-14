<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const emit = defineEmits(['close']);

const form = useForm({
  title: '',
  session_key: '',
  session_passcode: '',
});

const submit = () => {
  form.post(route('live-sessions.store'), {
    onSuccess: () => {
      emit('close');
    },
  });
};
</script>

<template>
  <div class="p-6">
    <div>
      <h3 class="text-orange-700 font-bold text-3xl mb-1">
        Start Live Session
      </h3>
      <p class="font-light text-base">
        Start a new live session to begin collaborating with fellow members.
      </p>
    </div>
    <form @submit.prevent="submit" class="space-y-6 py-6">
      <div>
        <label class="text-lg mb-2" for="name">Title</label>
        <input
          v-model="form.title"
          type="text"
          id="title"
          class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
          placeholder="Enter the title of your live session..."
        />
        <InputError class="mt-1" :message="form.errors.title" />
      </div>
      <div>
        <label class="text-lg mb-2" for="name">Session Key</label>
        <input
          v-model="form.session_key"
          type="text"
          id="session_key"
          class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
          placeholder="Enter the key for this live session..."
        />
        <InputError class="mt-1" :message="form.errors.session_key" />
      </div>
      <div>
        <label class="text-lg mb-2" for="name">Passcode</label>
        <input
          v-model="form.session_passcode"
          type="password"
          id="session_passcode"
          class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
          placeholder="Enter the optional passcode for this live session..."
        />
        <InputError class="mt-1" :message="form.errors.session_passcode" />
      </div>
      <div>
        <button
          type="submit"
          class="float-right w-[150px] bg-orange-700 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer"
        >
          Start
        </button>
      </div>
    </form>
  </div>
</template>
