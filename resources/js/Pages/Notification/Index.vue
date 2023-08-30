<template>
  <h1 class="text-3xl mb-4">出價通知</h1>
  <section
    v-if="notifications.data.length"
    class="text-gray-700 dark:text-gray-400"
  >
    <div
      v-for="notification in notifications.data"
      :key="notifications.id"
      class="border-b border-gray-200 dark:border=gray-800 py-4 flex justify-between items-center"
    >
      <div>
        <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
          <Link
            :href="
              route('realtor.listing.show', {
                listing: notification.data.listing_id,
              })
            "
            class="text-indigo-600 dark:text-indigo-400"
            >這間房屋</Link
          >
          已被出價
          <Price :price="notification.data.amount" />
          囉！
        </span>
      </div>
      <div>
        <Link
          :href="route('notification.seen', { notification: notification.id })"
          v-if="!notification.read_at"
          as="button"
          method="PUT"
          class="btn-outline text-xs font-medium"
        >
          我已讀取
        </Link>
      </div>
    </div>
  </section>

  <EmptyState v-else>還沒有人出價唷！</EmptyState>

  <section
    v-if="notifications.data.length"
    class="w-full flex justify-center mt-8 mb-8"
  >
    <Paination :links="notifications.links" />
  </section>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";
import Paination from "@/Components/UI/Pagination.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
  notifications: Object,
});
</script>
