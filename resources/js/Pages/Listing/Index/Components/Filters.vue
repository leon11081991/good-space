<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.priceFrom"
          class="input-filter-l w-28"
          type="text"
          placeholder="Price from"
        />
        <input
          v-model.number="filterForm.priceTo"
          class="input-filter-r w-28"
          type="text"
          placeholder="Price to"
        />
      </div>

      <div class="flex flex-nowrap items-center">
        <select
          v-model="filterForm.beds"
          class="input-filter-l w-28"
          name=""
          id=""
        >
          <option :value="null">Beds</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option value="">6+</option>
        </select>
        <select
          v-model="filterForm.baths"
          class="input-filter-r w-28"
          name=""
          id=""
        >
          <option :value="null">Bathrooms</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option value="">6+</option>
        </select>
      </div>

      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.areaFrom"
          class="input-filter-l w-28"
          type="text"
          placeholder="Area from"
        />
        <input
          v-model.number="filterForm.areaTo"
          class="input-filter-r w-28"
          type="text"
          placeholder="Area to"
        />
      </div>

      <button class="btn-normal" type="submit">Filter</button>
      <button @click="clear" type="reset">Clear</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  filters: Object,
});

const filterForm = useForm({
  priceFrom: props.filters.priceFrom ?? null,
  priceTo: props.filters.priceTo ?? null,
  beds: props.filters.beds ?? null,
  baths: props.filters.baths ?? null,
  areaFrom: props.filters.areaFrom ?? null,
  areaTo: props.filters.areaTo ?? null,
});

const filter = () => {
  filterForm.get(route("listing.index"), {
    preserveState: true,
    preserveScroll: true,
  });
};

const clear = () => {
  filterForm.priceFrom = null;
  filterForm.priceTo = null;
  filterForm.beds = null;
  filterForm.baths = null;
  filterForm.areaFrom = null;
  filterForm.areaTo = null;
  filter();
};
</script>
