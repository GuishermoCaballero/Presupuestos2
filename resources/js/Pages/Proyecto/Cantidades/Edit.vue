<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const { proyecto } = usePage().props;

const selectedOption = ref("transferencia"); // Set the default selected option

const form = useForm({
  etiqueta: "",
  accion: "",
  cantidad: "",
});

const cambio_form = useForm({
  etiqueta: "",
  accion: "",
  cantidad: "",
});

const cambio_submit = () => {
  cambio_form.post(route("proyecto.change.cantidad", { id: proyecto.id }));
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edita Cantidades en {{ proyecto.nombre }}
      </h2>
    </template>

    <div class="py-12">
      <div class="bg-gray-100 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-md p-6 w-96">
          <h1 class="text-2xl font-bold mb-4">Select an option:</h1>
          <select
            v-model="selectedOption"
            class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
          >
            <option value="transferencia">Transferencia</option>
            <option value="cambio">Cambio</option>
          </select>

          <!-- Show different components based on the selectedOption -->
          <div v-if="selectedOption === 'transferencia'" class="mt-6">
            <form @submit.prevent="submit">
              <div>
                <InputLabel for="cantidad" value="From" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                >
                  <option
                    v-for="etiqueta in proyecto.etiquetas"
                    :key="etiqueta.id"
                    :value="etiqueta.etiqueta"
                  >
                    {{ etiqueta.etiqueta }}
                  </option>
                </select>

<!--                 <InputError class="mt-2" :message="form.errors.etiqueta" />
 -->              </div>

              <div>
                <InputLabel for="cantidad" value="To" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                >
                  <option
                    v-for="etiqueta in proyecto.etiquetas"
                    :key="etiqueta.id"
                    :value="etiqueta.etiqueta"
                  >
                    {{ etiqueta.etiqueta }}
                  </option>
                </select>

<!--                 <InputError class="mt-2" :message="form.errors.cantidad" />
 -->              </div>

              <div>
                <InputLabel for="cantidad" value="Cantidad" />

                <TextInput
                  id="cantidad"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="form.cantidad"
                  autofocus
                  autocomplete="cantidad"
                />

<!--                 <InputError class="mt-2" :message="form.errors.cantidad" />
 -->              </div>

              <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Transferir Cantidad!
                </PrimaryButton>
              </div>
            </form>
          </div>

          <div v-else-if="selectedOption === 'cambio'" class="mt-6">
            <form @submit.prevent="cambio_submit">
              <div>
                <InputLabel for="cantidad" value="Etiqueta" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                  v-model="cambio_form.etiqueta"
                >
                  <option
                    v-for="etiqueta in proyecto.etiquetas"
                    :key="etiqueta.id"
                    :value="etiqueta.etiqueta"
                  >
                    {{ etiqueta.etiqueta }}
                  </option>
                </select>

                <InputError class="mt-2" :message="cambio_form.errors.etiqueta" />
              </div>

              <div>
                <InputLabel for="cantidad" value="Acción" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                  v-model="cambio_form.accion"
                >
                  <option>Suma</option>
                  <option>Resta</option>
                </select>

                <InputError class="mt-2" :message="cambio_form.errors.accion" />
              </div>

              <div>
                <InputLabel for="cantidad" value="Cantidad" />

                <TextInput
                  id="cantidad"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="cambio_form.cantidad"
                  autofocus
                  autocomplete="cantidad"
                />

                <InputError class="mt-2" :message="cambio_form.errors.cantidad" />
              </div>

              <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Transferir Cantidad!
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
    </div>
  </AuthenticatedLayout>
</template>
