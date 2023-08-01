<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";

const { proyectos } = usePage().props; // Access the "proyectos" data passed from the controller.

const getImageUrl = (imageName) => {
  if (!imageName) {
    return "path-to-placeholder-image.png";
  }

  const storageURL = "http://presupuestos2.test/storage";
  const imageUrl = `${storageURL}/${imageName}`;

  return imageUrl;
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Proyectos:</h2>
        <Link
          :href="route('proyecto.create')"
          class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1 focus:ring-offset-white"
        >
          Crear un proyecto
        </Link>
      </div>
    </template>

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
            <!-- src="http://presupuestos2.test/storage/files/andrew%20tate.jpg" -->
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
