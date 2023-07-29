<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";

const { proyecto } = usePage().props; // Assuming you have "proyecto" data passed from the backend.
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ proyecto.nombre }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
          <div class="bg-white shadow-md rounded-md p-8">
            <h2 class="text-2xl font-semibold mb-4">{{ proyecto.nombre }}</h2>
            <p class="text-gray-600 mb-6">{{ proyecto.descripcion }}</p>
            <img
              :src="proyecto.imagen_url"
              alt="Imagen del proyecto"
              class="w-full rounded-md h-60 object-cover mb-6"
            />
            <!-- Add any other information you want to display about the proyecto here -->
            <!-- For example: -->
            <!-- <p class="text-gray-600">Fecha de inicio: {{ proyecto.fecha_inicio }}</p> -->
            <!-- <p class="text-gray-600">Cliente: {{ proyecto.cliente }}</p> -->
            <!-- ... and so on ... -->

            <div
              v-for="(etiquetaData, index) in proyecto.totales"
              :key="index"
              class="row"
            >
              <div class="label">{{ etiquetaData.etiqueta }}</div>
              <div class="progress-bar">
                <div
                  class="progress"
                  :style="{ width: etiquetaData.cantidad + '%' }"
                ></div>
              </div>
              <div class="percentage">{{ etiquetaData.cantidad }}%</div>
            </div>

            <div class="m-8">
              <Link
                :href="route('proyecto.etiquetas.edit', { id: proyecto.id })"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8"
                >Editar Etiquetas</Link
              >

              <Link
                :href="route('proyecto.cantidades.edit', { id: proyecto.id })"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8"
                >Editar Cantidades</Link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
