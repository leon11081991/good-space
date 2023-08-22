<template>
  <span> {{ listing.city }}{{ listing.street }}{{ listing.street_num }}</span>
</template>

<script setup>
defineProps({
  listing: Object,
});
</script>
