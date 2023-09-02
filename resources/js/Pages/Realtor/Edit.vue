<template>
  <form @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label">房間數</label>
        <input v-model.number="form.beds" type="text" class="input" />
        <div v-if="form.errors.beds" class="input-error">
          {{ form.errors.beds }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">衛浴數</label>
        <input v-model.number="form.baths" type="text" class="input" />
        <div v-if="form.errors.baths" class="input-error">
          {{ form.errors.baths }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">坪數</label>
        <input v-model.number="form.area" type="text" class="input" />
        <div v-if="form.errors.area" class="input-error">
          {{ form.errors.area }}
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">行政區</label>
        <input v-model.trim="form.city" type="text" class="input" />
        <div v-if="form.errors.city" class="input-error">
          {{ form.errors.city }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">郵遞區號</label>
        <input v-model.trim="form.code" type="text" class="input" />
        <div v-if="form.errors.code" class="input-error">
          {{ form.errors.code }}
        </div>
      </div>

      <div class="col-span-4">
        <label class="label">街道名</label>
        <input v-model.trim="form.street" type="text" class="input" />
        <div v-if="form.errors.street" class="input-error">
          {{ form.errors.street }}
        </div>
      </div>

      <div class="col-span-2">
        <label class="label">街道號碼</label>
        <input v-model.trim="form.street_num" type="text" class="input" />
        <div v-if="form.errors.street_num" class="input-error">
          {{ form.errors.street_num }}
        </div>
      </div>

      <div class="col-span-6">
        <label class="label">總價</label>
        <input v-model.number="form.price" type="text" class="input" />
        <div v-if="form.errors.price" class="input-error">
          {{ form.errors.price }}
        </div>
      </div>

      <div class="col-span-6">
        <button type="submit" class="btn-blue">儲存</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  listing: Object,
});

const form = useForm({
  beds: props.listing.beds,
  baths: props.listing.baths,
  area: props.listing.area,
  city: props.listing.city,
  code: props.listing.code,
  street: props.listing.street,
  street_num: props.listing.street_num,
  price: props.listing.price,
});

const update = () => {
  form.put(route("realtor.listing.update", { listing: props.listing.id }));
};
</script>
