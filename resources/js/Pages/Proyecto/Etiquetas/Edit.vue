<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { useInertia } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const { proyecto } = usePage().props; // Access the "proyecto" data passed from the controller.

const form = useForm({
  /*  user_id: '', */
  etiqueta: "",
});

const submit = () => {
  form.post(
    route("proyecto.add.etiqueta", { id: proyecto.id }),
    /* Optional data to be sent in the request, if needed */
    /* {
        someKey: someValue,
    }, */
    {
      /* Options object containing callbacks or other configuration */
      onFinish: () => form.reset('etiqueta'),
    }
  );
};


const deleteEtiqueta = async (etiquetaId) => {
  console.log("hola");
  try {
    // Call the backend API to delete the etiqueta
    form.delete(route('proyecto.delete.etiqueta', { id: proyecto.id, etiqueta: etiquetaId }),
    {
      /* Options object containing callbacks or other configuration */
      onFinish: () => form.reset('etiqueta'),
    }
    );
    console.log("hola2");
  } catch (error) {
    console.log(error);
  }
};

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edita Etiquetas en {{ proyecto.nombre }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Loop through the etiquetas array and display each etiqueta in a cool row -->
        <div
          v-for="etiqueta in proyecto.etiquetas"
          :key="etiqueta.id"
          class="bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform hover:scale-105 flex items-center justify-between"
          :class="{ 'bg-gray-100': etiqueta.isHovered }"
          @mouseenter="etiqueta.isHovered = true"
          @mouseleave="etiqueta.isHovered = false"
        >
          <div class="text-lg font-semibold mb-4">{{ etiqueta.etiqueta }}</div>
          <!-- Add a delete button for each etiqueta -->
          <button class="text-red-500" @click="deleteEtiqueta(etiqueta.id)">Delete</button>
        </div>
      </div>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="submit">
          <div>
            <InputLabel for="etiqueta" value="Nueva Etiqueta" />

            <TextInput
              id="etiqueta"
              type="text"
              class="mt-1 block w-full"
              v-model="form.etiqueta"
              autofocus
              autocomplete="etiqueta"
            />

            <InputError class="mt-2" :message="form.errors.etiqueta" />
          </div>

          <div class="flex items-center justify-end mt-4">
            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Añadir etiqueta!
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
