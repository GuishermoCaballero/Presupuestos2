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

            <div class="m-4 w-1/2">
              <GoogleChart/>
            </div>


            <div>Presupuesto: {{ (proyecto.presupuesto).toFixed(2) }} $</div>
            <br>
            <div
              v-for="(etiqueta, index) in proyecto.etiquetas"
              :key="index"
              class="row"
            >
              <div class="label">{{ etiqueta.etiqueta }}: {{ (etiqueta.cantidad).toFixed(2) }}$ - {{ (etiqueta.cantidad / proyecto.presupuesto * 100).toFixed(2) }}% </div>
           <br><hr>
            </div>
            <br>
            <div>Total Gastado: {{ (proyecto.gastado).toFixed(2) }} $</div>
            <div>Total Restante: {{ (proyecto.restante).toFixed(2) }} $</div>


                


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

              <Link
                :href="route('proyecto.usuarios.index', { id: proyecto.id })"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8"
                >Administrar Usuarios</Link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
