<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

const { proyecto, usuario } = usePage().props; // Access the "proyecto" data passed from the controller.

const form = useForm({
  puede_ver: usuario.puede_ver,
  puede_editar_etiquetas: usuario.puede_editar_etiquetas,
  puede_editar_cantidades: usuario.puede_editar_cantidades,
  puede_editar_usuarios: usuario.puede_editar_usuarios,
});

const submit = () => {
  form.post(
    route("proyecto.usuarios.permissions.save", { id: proyecto.id, usuario: usuario.id })
  );
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edita Permisos de {{ usuario.user.name }}
      </h2>
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

    <div class="py-12">
      <form @submit.prevent="submit">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div
            class="bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform flex items-center justify-between"
          >
            <div class="text-lg font-semibold mb-4">Puede Ver</div>
            <div class="text-lg font-semibold mb-4">
              <input type="checkbox" v-model="form.puede_ver" />
            </div>
          </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div
            class="bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform flex items-center justify-between"
          >
            <div class="text-lg font-semibold mb-4">Puede Editar Etiquetas</div>
            <div class="text-lg font-semibold mb-4">
              <input type="checkbox" v-model="form.puede_editar_etiquetas" />
            </div>
          </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div
            class="bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform flex items-center justify-between"
          >
            <div class="text-lg font-semibold mb-4">Puede Editar Cantidades</div>
            <div class="text-lg font-semibold mb-4">
              <input type="checkbox" v-model="form.puede_editar_cantidades" />
            </div>
          </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div
            class="bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform flex items-center justify-between"
          >
            <div class="text-lg font-semibold mb-4">Puede Editar Usuarios</div>
            <div class="text-lg font-semibold mb-4">
              <input type="checkbox" v-model="form.puede_editar_usuarios" />
            </div>
          </div>
        </div>

        <div class="flex items-center justify-end m-4">
          <PrimaryButton
            class="ml-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Guardar Permisos
          </PrimaryButton>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
