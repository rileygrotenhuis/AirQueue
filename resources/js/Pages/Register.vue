<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register-user'));
};
</script>

<template>
  <GuestLayout title="Register">
    <div>
      <form
        @submit.prevent="submit"
        class="w-full sm:min-w-[485px] h-fit p-6 bg-white bg-opacity-20 rounded-3xl border border-zinc-200 border-opacity-10 shadow-xl backdrop-blur-[35.10px] flex-col justify-start items-center gap-[38px] inline-flex mt-12"
      >
        <h3 class="text-white text-4xl font-bold text-center">Sign In</h3>

        <div class="flex flex-col w-full">
          <label class="text-white mb-1" for="name"> Name </label>
          <input
            v-model="form.name"
            type="text"
            id="name"
            class="bg-transparent px-4 py-2 w-full rounded-lg border border-white justify-start items-center gap-2.5 inline-flex text-white placeholder-white placeholder-opacity-50 focus:ring-orange-300 focus:border-orange-300"
            placeholder="Enter your name here"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="flex flex-col w-full">
          <label class="text-white mb-1" for="email"> Email </label>
          <input
            v-model="form.email"
            type="email"
            id="email"
            class="bg-transparent px-4 py-2 w-full rounded-lg border border-white justify-start items-center gap-2.5 inline-flex text-white placeholder-white placeholder-opacity-50 focus:ring-orange-300 focus:border-orange-300"
            placeholder="Enter your email address here"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="flex flex-col w-full">
          <label class="text-white mb-1" for="password"> Password </label>
          <input
            v-model="form.password"
            type="password"
            id="password"
            class="bg-transparent px-4 py-2 w-full rounded-lg border border-white justify-start items-center gap-2.5 inline-flex text-white placeholder-white placeholder-opacity-50 focus:ring-orange-300 focus:border-orange-300"
            placeholder="Enter your password here"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="flex flex-col w-full">
          <label class="text-white mb-1" for="password_confirmation">
            Confirm Password
          </label>
          <input
            v-model="form.password_confirmation"
            type="password"
            id="password_confirmation"
            class="bg-transparent px-4 py-2 w-full rounded-lg border border-white justify-start items-center gap-2.5 inline-flex text-white placeholder-white placeholder-opacity-50 focus:ring-orange-300 focus:border-orange-300"
            placeholder="Confirm password here"
          />
          <InputError
            class="mt-2"
            :message="form.errors.password_confirmation"
          />
        </div>

        <div class="w-full flex gap-2">
          <a
            :href="route('login')"
            class="w-full text-orange-600 hover:text-orange-300 font-bold hover:cursor-pointer"
          >
            <button
              type="button"
              class="w-full bg-white text-orange-700 px-4 py-2 rounded-lg hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer"
            >
              Already registered?
            </button>
          </a>
          <button
            type="submit"
            class="w-full bg-orange-700 text-white px-4 py-2 rounded-lg border border-orange-700 hover:bg-orange-300 hover:text-orange-900 font-bold hover:border-orange-300 transition-colors duration-300 ease-in-out hover:cursor-pointer"
          >
            Register
          </button>
        </div>
      </form>
    </div>
  </GuestLayout>
</template>
