<template>
  <div class="mb-4">
    <Link :href="route('realtor.listing.index')">← 回到房屋列表</Link>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
      <Box v-if="!hasOffers" class="flex md:col-span-7 item-center">
        <div class="w-full text-center font-medium text-gray-500">沒有出價</div>
      </Box>

      <div v-else class="md:col-span-7 flex flex-col gap-4">
        <Offer
          v-for="offer in listing.offers"
          :key="offer.id"
          :offer="offer"
          :listing-price="listing.price"
          :is-sold="listing.sold_at != null"
        />
      </div>

      <div class="md:col-span-5">
        <Box class="md:col-span-5">
          <template #header>基本資訊</template>
          <Price :price="listing.price" class="text-2xl font-bold" />
          <ListingSpace :listing="listing" class="text-lg" />
          <ListingAddress :listing="listing" class="text-gray-500" />
        </Box>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import Offer from "@/Pages/Realtor/Show/Components/Offer.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";

const props = defineProps({
  listing: Object,
});

const hasOffers = computed(() => props.listing.offers.length);
</script>
