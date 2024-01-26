<script>
export default {
  name: "LocationEdit",
};
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import LocationForm from "@/components/Locations/Form.vue";

const props = defineProps({
  location: {
    type: Object,
    required: true
  },
});

const form = useForm({
  location_name: props.location.location_name,
  slug: props.location.slug,
});
</script>

<template>
   <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-light">
        Edit Location
      </h1>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <LocationForm :updating="true"  :form="form" @submit="form.put(route('locations.update',location.id))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

