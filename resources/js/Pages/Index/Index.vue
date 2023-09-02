<template>
  <div class="index-bg fixed top-0 bottom-0 -left-1/2 md:left-0 right-0 z-[-1]">
    <!-- <img
      class="w-full min-h-full min-w-[1000px]"
      src="img/unsplash_2d4lAQAlbDA.png"
      alt="index background"
    /> -->
    <img
      class="w-full min-h-full min-w-[1000px]"
      src="../../../../public/assets/images/unsplash_2d4lAQAlbDA.png"
    />
  </div>

  <section class="flex flex-col items-center gap-5 pt-[170px]">
    <h2
      class="text-3xl text-gray-100 dark:text-gray-200 font-medium text-center tracking-wider"
    >
      Hello, 歡迎來到 GoodSpace
    </h2>
    <p
      class="text-2xl text-gray-100 dark:text-gray-200 text-center tracking-wider"
    >
      希望這裡可以找到你理想中的房子
    </p>
    <Link
      href="/listing"
      class="text-gray-400 hover:text-gray-200 underline underline-offset-4 transition ease-in-out duration-500"
      >立即搜尋!!! 找到你喜歡的房子</Link
    >
  </section>

  <div v-if="!user" class="flex justify-center gap-5 pt-20">
    <Link
      :href="route('user-account.create')"
      class="text-gray-200 hover:text-gray-700 btn-outline"
      >註冊</Link
    >
    <Link :href="route('login')" class="btn-blue">登入</Link>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
  message: String,
});

const page = usePage();
const user = computed(() => page.props.user);
</script>
