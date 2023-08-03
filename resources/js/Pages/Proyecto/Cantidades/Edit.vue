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

const transferencia_form = useForm({
  form: "transferencia",
  from: "",
  to: "",
  cantidad: "",
  quien: "",
});

const cambio_form = useForm({
  form: "cambio",
  etiqueta: "",
  accion: "",
  cantidad: "",
  quien: "",

});

const cambio_submit = () => {
  cambio_form.post(route("proyecto.save.cantidad", { id: proyecto.id }));
};

const transferencia_submit = () => {
  transferencia_form.post(route("proyecto.save.cantidad", { id: proyecto.id }));
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edita Cantidades en {{ proyecto.nombre }}
      </h2>
      <Link

          :href="route('proyecto.show', { id: proyecto.id })"
          class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-8 mt-8"
          >Atrás</Link
        >
    </template>
    <div v-if="$page.props.flash.error" class="bg-red-500 p-4 rounded-lg text-white m-4">
      <p class="text-lg">{{ $page.props.flash.error }}</p>
    </div>

    <div
      v-if="$page.props.flash.success"
      class="bg-green-500 p-4 rounded-lg text-white m-4"
    >
      <p class="text-lg">{{ $page.props.flash.success }}</p>
    </div>
    <div class="py-12 bg-gray-300">
      <div class="bg-gray-100 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-md p-6 w-96">
          <h1 class="text-2xl font-bold mb-4">Elige una opción</h1>
          <select
            v-model="selectedOption"
            class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
          >
            <option value="transferencia">Transferencia</option>
            <option value="cambio">Cambio</option>
          </select>

          <!-- Show different components based on the selectedOption -->
          <div v-if="selectedOption === 'transferencia'" class="mt-6">
            <form @submit.prevent="transferencia_submit">
              <div>
                <InputLabel for="cantidad" value="Desde" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                  v-model="transferencia_form.from"
                >
                  <option
                    v-for="etiqueta in proyecto.etiquetas"
                    :key="etiqueta.id"
                    :value="etiqueta.id"
                  >
                    {{ etiqueta.etiqueta }} - {{ etiqueta.cantidad.toFixed(2) }}$
                  </option>
                </select>

                <InputError class="mt-2" :message="transferencia_form.errors.from" />
              </div>

              <div>
                <InputLabel for="cantidad" value="Para" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                  v-model="transferencia_form.to"
                >
                  <option
                    v-for="etiqueta in proyecto.etiquetas"
                    :key="etiqueta.id"
                    :value="etiqueta.id"
                  >
                    {{ etiqueta.etiqueta }} - {{ etiqueta.cantidad.toFixed(2) }}$
                  </option>
                </select>

                <InputError class="mt-2" :message="transferencia_form.errors.to" />
              </div>

              <div>
                <InputLabel for="cantidad" value="Cantidad" />

                <TextInput
                  id="cantidad"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="transferencia_form.cantidad"
                  autofocus
                  autocomplete="cantidad"
                />

                <InputError class="mt-2" :message="transferencia_form.errors.cantidad" />
              </div>

              <div>
                <InputLabel for="cantidad" value="Quien realiza el movimiento" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                  v-model="transferencia_form.quien"
                >
                  <option :value="proyecto.user.id" >
                      {{ proyecto.user.name }} (Administrador)
                  </option>
                  <option
                    v-for="usuario in proyecto.usuarios"
                    :key="usuario.id"
                    :value="usuario.user.id"
                  >
                    {{ usuario.user.name }}
                  </option>
                </select>

                <InputError class="mt-2" :message="transferencia_form.errors.quien" />
              </div>

              <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                  class="ml-4"
                  :class="{ 'opacity-25': transferencia_form.processing }"
                  :disabled="transferencia_form.processing"
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
                    :value="etiqueta.id"
                  >
                    {{ etiqueta.etiqueta }} - {{ etiqueta.cantidad.toFixed(2) }}$
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
                  <option value="suma">Suma</option>
                  <option value="resta">Resta</option>
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

              <div>
                <InputLabel for="cantidad" value="Quien realiza el movimiento" />

                <select
                  class="w-full px-4 py-2 border border-gray-300 rounded-md text-gray-900 focus:outline-none focus:ring focus:ring-indigo-200"
                  v-model="cambio_form.quien"
                >
                  <option :value="proyecto.user.id" >
                      {{ proyecto.user.name }} (Administrador)
                  </option>
                  <option
                    v-for="usuario in proyecto.usuarios"
                    :key="usuario.id"
                    :value="usuario.user.id"
                  >
                    {{ usuario.user.name }}
                  </option>
                </select>

                <InputError class="mt-2" :message="cambio_form.errors.quien" />
              </div>

              <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                  class="ml-4"
                  :class="{ 'opacity-25': cambio_form.processing }"
                  :disabled="cambio_form.processing"
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
