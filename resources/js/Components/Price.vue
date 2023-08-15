<template>
  <span>{{ formattedPrice }}</span>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  price: [Number, String],
});

const formattedPrice = computed(() =>
  Number(props.price).toLocaleString("zh-Hant", {
    style: "currency",
    currency: "NTD",
    maximumFractionDigits: 0,
  })
);
</script>
