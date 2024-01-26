<script>
export default {
  name: "CategorieIndex",
};
</script>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed } from 'vue';

const props=defineProps({
  categories: {
    type: Object,
    required: true,
  },
});
/*const handleAction = (event, id) => {
  const selectedAction = event.target.value;
  if (selectedAction === "edit") {
    //window.location.href = route("categories.edit", id);
    //this.$inertia.visit(route("categories.edit", id));
    Inertia.visit(route("categories.edit", id));
  } else if (selectedAction === "delete") {
    Inertia.delete(route("categories.destroy", id));
  }
};*/

const deleteCategory = (id) => {
  if (confirm("Are you sure?")) {
    Inertia.delete(route("categories.destroy", id));
  }
};

const decodedLinks = computed(() => {
  return props.categories.links.map(link => {
    const parser = new DOMParser();
    const decodedString = parser.parseFromString(`<!doctype html><body>${link.label}`, 'text/html').body.textContent;
    return {
      ...link,
      label: decodedString
    };
  });
});
</script>

<template>
  <AppLayout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-light">
        Categories
      </h1>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-between">
            <Link
              :href="route('categories.create')"
              class="text-white bg-indigo-500 hover:bg-indigo-700 py-2 px-4 rounded"
              >CREATE CATEGORIES
            </Link>
          </div>
        </div>
        <div class="mt-4">
          <ul role="list" class="divide-y divide-gray-100">
            <li
              class="flex items-center justify-between gap-x-6 py-5"
              v-for="(category,index) in categories.data"
              :key="index"
            >
              <div class="flex items-center gap-x-4">
                <img
                  class="h-12 w-12 flex-none rounded-full bg-gray-50"
                  :src="'image/letra-c.png'"
                  alt=""
                />
                <div class="min-w-0 flex-auto ml-2">
                  <p class="text-sm font-semibold leading-6 text-gray-900">
                    {{ category.category_name }}
                  </p>
                  <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                    {{ category.slug }}
                  </p>
                </div>
              </div>
              <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <div>
                  <p class="text-sm leading-6 text-gray-900">Opciones</p>

                  <div class="mt-1 relative">
                    <!-- <select @change="(event) => handleAction(event,category.slug)"
                      class="block appearance-none w-full bg-gray-50 border border-gray-300 text-gray-900 py-1 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-xs">
                      <option>Selected Option</option>
                      <option value="edit">Edit</option>
                      <option value="delete">Delete</option>
                    </select>-->
                    <Link
                      class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2"
                      :href="route('categories.edit', category.slug)"
                      >Edit</Link>

                    <button
                      class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                      @click="deleteCategory(category.id)"
                    >
                      Delete
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="flex justify-between mt-4">
          <nav aria-label="Page navigation">
            <ul class="flex list-style-none">
              <li
                v-for="link in decodedLinks"
                :key="link.label"
                class="ml-1 first:ml-0"
              >
                <Link
                  v-if="link.url"
                  :href="link.url"
                  :class="[
                    'px-3 py-1 rounded-md',
                    link.active
                      ? 'bg-blue-500 text-white'
                      : 'bg-white text-blue-500 border border-blue-500',
                  ]"
                 
                >{{ link.label }}</Link>
                <span
                  v-else
                  :class="[
                    'px-3 py-1 rounded-md',
                    link.active
                      ? 'bg-blue-500 text-white'
                      : 'bg-white text-gray-500 cursor-default',
                  ]"
                >{{ link.label }}</span>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
