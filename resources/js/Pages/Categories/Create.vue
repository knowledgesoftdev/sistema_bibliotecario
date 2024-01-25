<script>
export default {
  name: "CategorieCreate",
};
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import CategoryForm from "@/components/Categories/Form.vue";

const form = useForm({
  category_name: "",
  slug: "",
});
</script>

<template>
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-light">
        Create Category
      </h1>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <CategoryForm  :form="form" @submit="form.post(route('categories.store'))" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
