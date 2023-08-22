<template>
  <div>
    <span class="font-bold">{{ listing.beds }}</span>
    房
    <span class="text-gray-400 p-1">| </span>
    <span class="font-bold">{{ listing.baths }}</span>
    衛
    <span class="text-gray-400 p-1">| </span>
    <span class="font-bold">{{ listing.area }}</span>
    坪
  </div>
</template>

<script setup>
defineProps({
  listing: Object,
});
</script>
