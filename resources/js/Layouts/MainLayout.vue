<template>
  <header
    class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full"
  >
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('listing.index')">房屋資訊</Link>
        </div>
        <div
          class="flex items-center text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center"
        >
          <svg
            width="25"
            height="25"
            viewBox="0 0 25 25"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M2.40967 12.9413C2.40967 12.0534 3.18243 11.3335 4.13567 11.3335H16.0451C16.9984 11.3335 17.7711 12.0534 17.7711 12.9413V23.3923C17.7711 24.2803 16.9984 25.0002 16.0451 25.0002H4.13567C3.18243 25.0002 2.40967 24.2803 2.40967 23.3923V12.9413Z"
              fill="#4F46E5"
            />
            <path
              d="M9.32553 3.41064C9.80316 2.86312 10.6788 2.86312 11.1564 3.41064L20.1999 13.7776C20.8526 14.5258 20.2997 15.6667 19.2845 15.6667H1.19742C0.182181 15.6667 -0.370686 14.5258 0.281985 13.7776L9.32553 3.41064Z"
              fill="#4F46E5"
            />
            <path
              d="M19.8795 6.33317C19.8795 7.25364 19.0704 7.99984 18.0723 7.99984C17.0742 7.99984 16.2651 7.25364 16.2651 6.33317C16.2651 5.4127 17.0742 4.6665 18.0723 4.6665C19.0704 4.6665 19.8795 5.4127 19.8795 6.33317Z"
              fill="#4F46E5"
            />
            <path
              d="M25 2.83333C25 4.39814 23.6514 5.66667 21.9879 5.66667C20.3244 5.66667 18.9759 4.39814 18.9759 2.83333C18.9759 1.26853 20.3244 0 21.9879 0C23.6514 0 25 1.26853 25 2.83333Z"
              fill="#4F46E5"
            />
          </svg>
          <Link :href="route('listing.index')">GoodSpace</Link>
        </div>
        <div v-if="user" class="flex items-center gap-4">
          <Link
            :href="route('notification.index')"
            class="text-gray-500 relative pr-2 py-2"
          >
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M10.0177 16.2419C8.42313 16.2419 6.82861 15.9887 5.3162 15.4822C4.74135 15.2838 4.30337 14.88 4.11176 14.3531C3.9133 13.8261 3.98173 13.2444 4.29653 12.7243L5.08353 11.4172C5.24777 11.1435 5.39833 10.596 5.39833 10.2744V8.29665C5.39833 5.75089 7.47189 3.67732 10.0177 3.67732C12.5634 3.67732 14.637 5.75089 14.637 8.29665V10.2744C14.637 10.5892 14.7876 11.1435 14.9518 11.4241L15.7319 12.7243C16.0262 13.2171 16.081 13.8124 15.8825 14.3531C15.684 14.8937 15.2529 15.3043 14.7123 15.4822C13.2067 15.9887 11.6122 16.2419 10.0177 16.2419ZM10.0177 4.70384C8.03989 4.70384 6.42484 6.31205 6.42484 8.29665V10.2744C6.42484 10.774 6.21954 11.5131 5.96633 11.9442L5.17934 13.2513C5.02878 13.5045 4.98772 13.7714 5.07668 13.9972C5.1588 14.2299 5.36411 14.4078 5.64469 14.5036C8.50525 15.4617 11.5369 15.4617 14.3975 14.5036C14.6438 14.4215 14.8355 14.2367 14.9244 13.9904C15.0134 13.744 14.9929 13.4771 14.856 13.2513L14.069 11.9442C13.8089 11.4994 13.6105 10.7671 13.6105 10.2675V8.29665C13.6105 6.31205 12.0023 4.70384 10.0177 4.70384Z"
                fill="#292D32"
              />
              <path
                d="M11.2903 4.88879C11.2424 4.88879 11.1945 4.88195 11.1466 4.86826C10.9482 4.81351 10.7566 4.77245 10.5718 4.74508C9.99009 4.6698 9.42893 4.71086 8.90198 4.86826C8.71037 4.92985 8.50508 4.86826 8.37506 4.72455C8.24503 4.58084 8.20397 4.37553 8.27925 4.19076C8.55983 3.4722 9.24415 3 10.0243 3C10.8045 3 11.4888 3.46535 11.7694 4.19076C11.8378 4.37553 11.8036 4.58084 11.6736 4.72455C11.5709 4.83404 11.4272 4.88879 11.2903 4.88879Z"
                fill="#292D32"
              />
              <path
                d="M10.0174 17.8023C9.3399 17.8023 8.68293 17.5286 8.2039 17.0495C7.72486 16.5705 7.45113 15.9135 7.45113 15.236H8.47764C8.47764 15.6398 8.64186 16.0367 8.92929 16.3241C9.21671 16.6116 9.61363 16.7758 10.0174 16.7758C10.866 16.7758 11.5572 16.0846 11.5572 15.236H12.5837C12.5837 16.6526 11.434 17.8023 10.0174 17.8023Z"
                fill="#292D32"
              />
            </svg>
            <div
              v-if="notificationCount"
              class="absolute right-0 top-0 w-5 h-5 bg-red-700 text-white border border-white dark:border-gray-900 rounded-full text-xs text-center font-normal"
            >
              {{ notificationCount }}
            </div>
          </Link>
          <Link
            class="text-sm text-gray-500"
            :href="route('realtor.listing.index')"
            >{{ user.name }}</Link
          >
          <Link :href="route('realtor.listing.create')" class="btn-primary"
            >+ 建立資訊</Link
          >
          <div>
            <Link :href="route('logout')" method="delete" as="button"
              >登出</Link
            >
          </div>
        </div>
        <div v-else class="flex items-center gap-2">
          <Link :href="route('user-account.create')">註冊</Link>
          <Link :href="route('login')">登入</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4 w-full">
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

const page = usePage();
console.log("page", page);
const flashSuccess = computed(() => page.props.flash.success);
const user = computed(() => page.props.user);
const notificationCount = computed(() =>
  Math.min(page.props.user.notificationCount, 9)
);
</script>
