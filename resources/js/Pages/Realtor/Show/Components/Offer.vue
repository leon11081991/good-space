<template>
  <Box>
    <template #header
      >出價 #{{ offer.id
      }}<span
        v-if="offer.accepted_at"
        class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1"
        >接受出價</span
      >
    </template>
    <section class="flex items-center justify-between">
      <div class="">
        <Price :price="offer.amount" class="text-xl" />
        <div class="text-gray-500">
          價差
          <Price :price="difference" class="" />
        </div>
        <div class="text-gray-500 text-sm">出價者: {{ offer.bidder.name }}</div>
        <div class="text-gray-500 text-sm">出價時間: {{ madeOn }}</div>
      </div>
      <div>
        <Link
          v-if="!isSold"
          class="btn-outline text-xs font-medium"
          :href="route('realtor.offer.accept', { offer: offer.id })"
          method="PUT"
          as="button"
          >接受</Link
        >
      </div>
    </section>
  </Box>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";

const props = defineProps({
  offer: Object,
  listingPrice: Number,
  isSold: Boolean,
});

const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());
// const notSold = computed(
//   () => !props.offer.accepted_at && !props.offer.rejected_at
// );
</script>
