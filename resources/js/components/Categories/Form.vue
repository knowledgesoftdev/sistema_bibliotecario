<script>
export default {
  name: "CategorieForm",
};
</script>

<script setup>
import FormSection from "@/components/FormSection.vue";
import InputError from "@/components/InputError.vue";
import InputLabel from "@/components/InputLabel.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import TextInput from "@/components/TextInput.vue";
import { watch } from 'vue';

const { form, updating }=defineProps({
  form: {
    type: Object,
    required: true,
  },

  updating: {
    type: Boolean,
    required: false,
    default: false,
  },
});

defineEmits(["submit"]);

watch(
  () => form.category_name,
  (newValue) => {
    form.slug = createSlug(newValue);
  },
  { immediate: true }
);

function createSlug(category_name) {
  return category_name
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-") // Reemplaza caracteres no alfanuméricos con guiones
    .replace(/^-+|-+$/g, ""); // Elimina guiones del inicio y del final
}
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      {{ updating ? "Updated Category" : "Create New Category" }}
    </template>

    <template #description>
      {{
        updating
          ? "Updated The Selected Category"
          : "Create a New Category From Scratch"
      }}
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="category_name" value="Name Category" />
        <TextInput
          id="category_name"
          v-model="form.category_name"
          type="text"
          autocomplete="category_name"
          class="mt-1 block w-full"
        />
        <InputError :message="$page.props.errors.category_name" class="mt-2" />
      </div>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="slug" value="Slug" />
        <TextInput
          disabled
          id="slug"
          v-model="form.slug"
          type="text"
          autocomplete="slug"
          class="mt-1 block w-full"
        />
        <InputError :message="$page.props.errors.slug" class="mt-2" />
      </div>
    </template>

    <template #actions>
      <PrimaryButton>
        {{ updating ? "Update" : "Create" }}
      </PrimaryButton>
    </template>
  </FormSection>
</template>
