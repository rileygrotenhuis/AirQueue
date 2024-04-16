<script setup>
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
  session: Object,
});

const action = () => {
  if (props.session.is_member && !props.session.is_host) {
    leaveSession();
  } else if (!props.session.is_member) {
    joinSession();
  }
};

const joinSession = () => {
  useForm({
    session_key: props.session.session_key,
    session_passcode: props.session.session_passcode,
  }).post(route('live-sessions.join'));
};

const leaveSession = () => {
  router.post(route('live-sessions.leave', props.session.id));
};
</script>

<template>
  <div
    class="group w-full px-4 py-2 rounded-lg font-bold transition-colors duration-300 ease-in-out hover:cursor-pointer w-full text-center"
    :class="{
      'bg-orange-700 text-white hover:bg-orange-300 hover:text-orange-700':
        session.is_member,
      'bg-orange-300 text-orange-700 hover:bg-orange-700 hover:text-white':
        !session.is_member,
    }"
    @click.prevent="action"
  >
    <div
      class="block group-hover:hidden truncate mx-auto max-w-full md:max-w-[225px] transition-all duration-50 ease-in-out"
    >
      {{ session.title }}
    </div>
    <div
      class="hidden group-hover:block transition-all duration-50 ease-in-out"
    >
      <button v-if="session.is_member && !session.is_host">LEAVE</button>
      <button v-else-if="!session.is_member">JOIN</button>
      <button v-else>HOSTING</button>
    </div>
  </div>
</template>

<style scoped></style>
