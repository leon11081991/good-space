<template>
  <header
    class="fixed top-0 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full z-40 flex items-center h-15 sm:h-20"
  >
    <div class="container mx-auto">
      <nav class="px-4 py-2 sm:py-0 flex items-center justify-between">
        <div
          class="flex items-center text-xl text-blue-600 dark:text-blue-300 font-bold text-center"
        >
          <Link :href="route('app.index')">
            <Logo />
          </Link>
        </div>

        <div class="nav-wrapper">
          <div
            class="absolute sm:relative top-12 py-2 left-0 sm:top-0 bg-white dark:bg-gray-800 w-full flex items-center justify-center gap-2 border-b dark:border-b-gray-700 sm:border-none"
          >
            <div class="nav-item">
              <Link href="/about">關於</Link>
            </div>
            <div class="nav-item">
              <Link :href="route('listing.index')">房屋資訊</Link>
            </div>
          </div>
        </div>

        <div v-if="user" class="flex items-center gap-4">
          <Link
            :href="route('notification.index')"
            class="text-gray-500 relative p-2"
          >
            <Notification
              class="hover:text-blue-300 transition-all duration-150 ease-in"
            />
            <div
              v-if="notificationCount"
              class="absolute right-0 top-0 w-5 h-5 bg-red-700 text-white border border-white dark:border-gray-900 rounded-full text-xs text-center font-normal"
            >
              {{ notificationCount }}
            </div>
          </Link>

          <div class="text-gray-500 p-2 group relative">
            <User
              class="hover:text-blue-300 hover:cursor-pointer transition-all duration-300 ease-in"
            />
            <div
              id="user-actions"
              class="absolute w-[200px] right-0 hidden items-center gap-4 bg-white dark:bg-gray-800 p-5 rounded-b-md shadow-md group-hover:flex group-hover:flex-col transition-all duration-1000 z-50"
            >
              <p class="text-sm text-gray-500">嗨嗨！ {{ user.name }}</p>
              <Link
                class="btn-outline text-sm dark:border-gray-500 w-full text-center text-gray-400 hover:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-700"
                :href="route('realtor.listing.index')"
              >
                你建立的資訊
              </Link>
              <Link
                :href="route('realtor.listing.create')"
                class="btn-blue w-full text-center"
                >+ 建立資訊</Link
              >
              <Link
                :href="route('logout')"
                method="delete"
                as="button"
                class="text-sm transition-all duration-1000 dark:border-gray-500 hover:text-gray-700 dark:hover:text-gray-100"
                >登出</Link
              >
            </div>
          </div>
        </div>

        <div v-else class="flex items-center gap-2">
          <Link :href="route('user-account.create')">註冊</Link>
          <Link class="btn-blue" :href="route('login')">登入</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="relative container mx-auto p-4 mt-[100px] w-full">
    <div
      v-if="flashSuccess"
      class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
    >
      {{ flashSuccess }}
    </div>
    <slot></slot>
  </main>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

import Logo from "../../../public/assets/svg/logo.svg";
import Notification from "../../../public/assets/svg/notification.svg";
import User from "../../../public/assets/svg/user.svg";

const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
const user = computed(() => page.props.user);
const notificationCount = computed(() =>
  Math.min(page.props.user.notificationCount, 9)
);
</script>
