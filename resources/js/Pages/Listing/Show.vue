<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box
      v-if="listing.images.length"
      class="md:col-span-7 flex items-center w-full"
    >
      <div class="grid grid-cols-2 gap-1">
        <img
          v-for="image in listing.images"
          :key="image.id"
          :src="image.src"
          alt=""
        />
      </div>
    </Box>
    <EmptyState v-else class="md:col-span-7 flex items-center w-full">
      沒有圖片
    </EmptyState>
    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>房屋基本資訊</template>
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Box>
      <Box>
        <template #header>每月付額</template>
        <div>
          <label class="label">年利率 ({{ interestRate }}%)</label>
          <input
            v-model.number="interestRate"
            type="range"
            min="0.1"
            max="10"
            step="0.1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />
          <label class="label">貸款期限 ({{ duration }} 年)</label>
          <input
            v-model.number="duration"
            type="range"
            min="5"
            max="30"
            step="5"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />
          <div class="text-gray-600 darK:text-gray-300 mt-2">
            <div class="text-gray-400">
              每月月付
              <Price :price="monthlyPayment" class="text-3xl" />
            </div>

            <div class="mt-2 text-gray-500">
              <div class="flex justify-between">
                <div class="">總付額</div>
                <div class="">
                  <Price :price="totalPaid" class="font-medium" />
                </div>
              </div>
              <div class="flex justify-between">
                <div class="">房屋本金</div>
                <div class="">
                  <Price :price="listing.price" class="font-medium" />
                </div>
              </div>
              <div class="flex justify-between">
                <div class="">房貸金額</div>
                <div class="">
                  <Price :price="totalInterest" class="font-medium" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </Box>

      <MakeOffer
        v-if="user && !offerMade"
        @offer-updated="offerUpdated($event)"
        :listing-id="listing.id"
        :price="listing.price"
      />
      <OfferMAde v-if="user && offerMade" :offer="offerMade" />
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";

import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import ListingAddress from "@/Components/ListingAddress.vue";
import MakeOffer from "@/Pages/Listing/Show/Components/MakeOffer.vue";
import OfferMAde from "@/Pages/Listing/Show/Components/OfferMade.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

const props = defineProps({
  listing: Object,
  offerMade: Object,
});

const offer = ref(props.listing.price);

const interestRate = ref(1.5);
const duration = ref(20);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
  offer,
  interestRate,
  duration
);

const page = usePage();
const user = computed(() => page.props.user);

const offerUpdated = ($event) => (offer.value = $event);
</script>
