<template>
  <form @submit.prevent="login">
    <div class="w-1/2 mx-auto">
      <div class="">
        <label for="email" class="label">Email (使用者名稱)</label>
        <input v-model="form.email" id="email" type="text" class="input" />
        <div v-if="form.errors.email" class="input-error">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="mt-4">
        <label for="password" class="label">密碼</label>
        <input
          v-model="form.password"
          id="password"
          type="password"
          class="input"
        />
        <div v-if="form.errors.password" class="input-error">
          {{ form.errors.password }}
        </div>
      </div>

      <div class="mt-4">
        <button class="btn-blue w-full" type="submit">登入</button>
        <div class="mt-2 text-center">
          <p class="text-sm text-gray-700">
            沒有帳號嗎？請點
            <Link
              :href="route('user-account.create')"
              class="text-sm text-gray-500"
              >這裡</Link
            >
          </p>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
  email: null,
  password: null,
});

const login = () => {
  form.post(route("login.store"));
};
</script>
