<template>
  <form>
    <div class="mb-4 mt-4 flex flex-wrap gap-4">
      <div class="flex flex-nowrap items-center gap-2">
        <input
          id="deleted"
          v-model="filterForm.deleted"
          type="checkbox"
          class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
        />
        <label for="deleted">(包含)已刪除</label>
      </div>
      <div class="">
        <select class="input-filter-l w-32" v-model="filterForm.by">
          <option value="created_at">刊登時間</option>
          <option value="price">價格</option>
        </select>
        <select class="input-filter-r w-32" v-model="filterForm.order">
          <option
            v-for="option in sortOptions"
            :key="option.value"
            :value="option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>
    </div>
  </form>
</template>

<script setup>
import { reactive, watch, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";

const sortLabels = {
  created_at: [
    {
      label: "最新",
      value: "desc",
    },
    {
      label: "最舊",
      value: "asc",
    },
  ],
  price: [
    {
      label: "最高",
      value: "desc",
    },
    {
      label: "最低",
      value: "asc",
    },
  ],
};

const sortOptions = computed(() => sortLabels[filterForm.by]);

const props = defineProps({
  filters: Object,
  listings: Object,
});

const filterForm = reactive({
  deleted: props.filters.deleted ?? false,
  by: props.filters.by ?? "created_at",
  order: props.filters.order ?? "desc",
});

watch(
  filterForm,
  debounce(() => {
    router.get(route("realtor.listing.index"), filterForm, {
      preserveState: true,
      preserveScroll: true,
    });
  }, 1000)
);
</script>
