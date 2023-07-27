<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";

const { proyectos } = usePage().props; // Access the "proyectos" data passed from the controller.
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proyectos:</h2>
    </template>

    <Link
      :href="route('proyecto.create')"
      class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
      >Crear un proyecto</Link
    >

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 gap-4">
          <!-- Use a for loop to iterate over the "proyectos" -->
          <a
            v-for="proyecto in proyectos"
            :key="proyecto.id"
            :href="route('proyecto.show', { id: proyecto.id })"
            class="bg-white shadow-md rounded-md p-4 cursor-pointer transition-transform duration-300 transform hover:scale-105"
          >
            <!-- Display the proyecto data in a cool card format -->
            <h3 class="text-lg font-semibold mb-2">{{ proyecto.nombre }}</h3>
            <p class="text-gray-600 mb-4">{{ proyecto.descripcion }}</p>
            <img
              :src="proyecto.imagen_url"
              alt="Imagen del proyecto"
              class="w-full rounded-md h-40 object-cover"
            />
          </a>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
