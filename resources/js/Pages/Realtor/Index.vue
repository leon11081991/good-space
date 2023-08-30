<template>
  <h2 class="text-3xl mb-4">你所建立的房屋資訊</h2>

  <section>
    <RealtorFilters :filters="filters" />
  </section>

  <section
    v-if="listings.data.length"
    class="grid grid-cols-1 lg:grid-cols-2 gap-2"
  >
    <Box
      v-for="listing in listings.data"
      :key="listing.id"
      :class="{ 'border-dashed': listing.deleted_at }"
    >
      <div
        class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
      >
        <div :class="{ 'opacity-25': listing.deleted_at }">
          <div v-if="listing.sold_at != null" class="tag">售出</div>
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl font-medium" />
            <ListingSpace :listing="listing" />
            <listingAddress :listing="listing" class="text-gray-500" />
          </div>
        </div>
        <section>
          <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
            <a
              class="btn-outline text-xs font-medium"
              :href="route('listing.show', { listing: listing.id })"
              target="_blank"
              >預覽</a
            >
            <Link
              class="btn-outline text-xs font-medium"
              :href="route('realtor.listing.edit', { listing: listing.id })"
              >編輯</Link
            >
            <Link
              v-if="!listing.deleted_at"
              class="btn-outline text-xs font-medium"
              as="button"
              method="delete"
              :href="route('realtor.listing.destroy', { listing: listing.id })"
              >刪除</Link
            >
            <Link
              v-else
              class="btn-outline text-xs font-medium"
              as="button"
              method="put"
              :href="route('realtor.listing.restore', { listing: listing.id })"
              >恢復</Link
            >
          </div>
          <div class="mt-2">
            <Link
              :href="
                route('realtor.listing.image.create', { listing: listing.id })
              "
              class="block w-full btn-outline text-xs font-medium text-center"
              >房屋照片({{ listing.images_count }})</Link
            >
          </div>
          <div class="mt-2">
            <Link
              :href="route('realtor.listing.show', { listing: listing.id })"
              class="block w-full btn-outline text-xs font-medium text-center"
              >出價紀錄({{ listing.offers_count }})</Link
            >
          </div>
        </section>
      </div>
    </Box>
  </section>

  <EmptyState v-else>尚無建立房屋資訊</EmptyState>

  <section
    v-if="listings.data.length"
    class="w-full flex justify-center mt-4 mb-4"
  >
    <Pagination :links="listings.links" />
  </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import listingAddress from "@/Components/ListingAddress.vue";
import RealtorFilters from "@/Pages/Realtor/Index/Components/RealtorFilters.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

defineProps({
  filters: Object,
  listings: Object,
});
</script>
