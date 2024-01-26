<script>
export default {
  name: "LocationForm",
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
  () => form.location_name,
  (newValue) => {
    form.slug = createSlug(newValue);
  },
  { immediate: true }
);

function createSlug(location_name) {
  return location_name
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-") // Reemplaza caracteres no alfanuméricos con guiones
    .replace(/^-+|-+$/g, ""); // Elimina guiones del inicio y del final
}
</script>

<template>
  <FormSection @submitted="$emit('submit')">
    <template #title>
      {{ updating ? "Updated Location" : "Create New Location" }}
    </template>

    <template #description>
      {{
        updating
          ? "Updated The Selected Location"
          : "Create a New Location From Scratch"
      }}
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-6">
        <InputLabel for="location_name" value="Name Location" />
        <TextInput
          id="location_name"
          v-model="form.location_name"
          type="text"
          autocomplete="location_name"
          class="mt-1 block w-full"
        />
        <InputError :message="$page.props.errors.location_name" class="mt-2" />
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
