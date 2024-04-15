<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

defineProps({
  liveSessions: Array,
});

const form = useForm({
  session_ids: [],
  song_name: '',
  song_artist: '',
});

const sessionIsSelected = (sessionId) => {
  return form.session_ids.includes(sessionId);
};

const toggleSession = (sessionId) => {
  if (sessionIsSelected(sessionId)) {
    form.session_ids = form.session_ids.filter(
      (session) => session !== sessionId
    );
  } else {
    form.session_ids = [...form.session_ids, sessionId];
  }
};

const submit = () => {
  form.post(route('song-requests.store'));
};
</script>

<template>
  <AuthenticatedLayout title="Bands">
    <div class="max-w-5xl mx-auto py-12 px-4">
      <div class="mb-6">
        <h3 class="text-orange-700 font-bold text-3xl mb-1">Request a Song</h3>
        <p class="font-light text-base">
          Request a song to any of your active live sessions for other members
          to listen to themselves.
        </p>
      </div>

      <form
        @submit.prevent="submit"
        class="grid grid-cols-1 md:grid-cols-3 gap-8"
      >
        <div
          class="col-span-1 max-h-[450px] overflow-y-auto border-2 border-orange-700 rounded-2xl p-4"
        >
          <h5 class="text-xl font-bold">Select Live Sessions</h5>
          <div class="flex flex-col gap-2 mt-4">
            <button
              v-for="(session, index) in liveSessions"
              :key="index"
              class="flex items-center border-2 border-orange-400 gap-2 py-2 px-2 rounded-xl cursor-pointer hover:bg-orange-400/50 transition-all duration-300 ease-in-out"
              :class="{
                'bg-orange-400/50': sessionIsSelected(session.id),
              }"
              @click.prevent="toggleSession(session.id)"
            >
              <span
                class="w-4 h-4 border-2 rounded-full transition-all duration-300 ease-in-out"
                :class="{
                  'border-black text-black': !sessionIsSelected(session.id),
                  'border-orange-700 bg-orange-700': sessionIsSelected(
                    session.id
                  ),
                }"
              />
              <span class="truncate max-w-full text-left">
                {{ session.title }}
              </span>
            </button>
          </div>
        </div>

        <div class="col-span-1 md:col-span-2 space-y-6">
          <div>
            <label class="text-lg mb-2" for="name">Song Name</label>
            <input
              v-model="form.song_name"
              type="text"
              id="song_name"
              class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
              placeholder="Enter your song name..."
            />
            <InputError class="mt-2" :message="form.errors.song_name" />
          </div>
          <div>
            <label class="text-lg mb-2" for="name">Song Artist</label>
            <input
              v-model="form.song_artist"
              type="text"
              id="song_artist"
              class="px-4 py-2 w-full rounded-lg border justify-start items-center gap-2.5 inline-flex text-black placeholder-opacity-10 focus:ring-orange-300 focus:border-orange-300"
              placeholder="Enter your song artist..."
            />
            <InputError class="mt-2" :message="form.errors.song_artist" />
          </div>
          <div>
            <InputError class="mt-2" :message="form.errors.session_ids" />
          </div>
          <div>
            <button
              type="submit"
              class="float-right w-[150px] bg-orange-700 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer"
            >
              Request
            </button>
          </div>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
