<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";

const { proyecto, movimientos, usuario } = usePage().props; // Assuming you have "proyecto" data passed from the backend.

const { user } = usePage().props;

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
      <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        <div>
          <div class="flex">
            <div class="bg-white shadow-md rounded-md p-8">
              <h2 class="text-2xl font-semibold mb-4">{{ proyecto.nombre }}</h2>
              <p class="text-gray-600 mb-6">{{ proyecto.descripcion }}</p>
              <img
                :src="proyecto.imagen_url"
                alt="Imagen del proyecto"
                class="w-full rounded-md h-60 object-cover mb-6"
              />

              <div class="m-4 w-1/2">
                <GoogleChart :data="proyecto.chart" />
              </div>

              <div>Presupuesto: {{ proyecto.presupuesto.toFixed(2) }} $</div>
              <br />
              <div
                v-for="(etiqueta, index) in proyecto.etiquetas"
                :key="index"
                class="row"
              >
                <div class="label">
                  {{ etiqueta.etiqueta }}: {{ etiqueta.cantidad.toFixed(2) }}$ -
                  {{ ((etiqueta.cantidad / proyecto.presupuesto) * 100).toFixed(2) }}%
                </div>
                <br />
                <hr />
              </div>
              <br />
              <div>Total Gastado: {{ proyecto.gastado.toFixed(2) }} $</div>
              <div>Total Restante: {{ proyecto.restante.toFixed(2) }} $</div>

              <div class="m-8" v-if="usuario.is_admin">
                <Link
                  :href="route('proyecto.etiquetas.edit', { id: proyecto.id })"
                  class="font-semibold text-gray-600 hover:text-green-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8 transition-colors duration-300 ease-in-out hover:border-b-2 border-transparent hover:border-green-900"
                >
                  Editar Etiquetas
                </Link>

                <Link
                  :href="route('proyecto.cantidades.edit', { id: proyecto.id })"
                  class="font-semibold text-gray-600 hover:text-green-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8 transition-colors duration-300 ease-in-out hover:border-b-2 border-transparent hover:border-green-900"
                >
                  Editar Cantidades
                </Link>

                <Link
                  :href="route('proyecto.usuarios.index', { id: proyecto.id })"
                  class="font-semibold text-gray-600 hover:text-green-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 m-4 mt-8 transition-colors duration-300 ease-in-out hover:border-b-2 border-transparent hover:border-green-900"
                >
                  Administrar Usuarios
                </Link>

                <Link
                  :href="route('proyecto.delete', { id: proyecto.id })"
                  method="delete"
                  as="button"
                  class="inline-block bg-red-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50 transition duration-300 ease-in-out m-4 mt-8"
                >
                  Delete Proyecto
                </Link>
              </div>
            </div>

            <div>
              <div class="bg-white shadow-md rounded-md p-8 flex-1 mx-4 mb-4 overflow-auto max-h-50vh">
              <h2 class="text-xl font-semibold mb-4">Usuarios Asignados </h2>
              <ul>
                <li >{{ proyecto.user.name }} - Administrador</li>

                <li v-for="(user, index) in proyecto.usuarios" :key="index">{{ user.user.name }} - <span v-if="user.is_admin"> Administrador</span><span v-else>Usuario</span> </li>
              </ul>
            </div>
            <!-- Movimientos (scrollable) -->
            <div class="bg-white shadow-md rounded-md p-8 flex-1 mx-4 mb-4 overflow-auto max-h-50vh">
              <h2 class="text-xl font-semibold mb-4">Movimientos</h2>
              <ul>
                <li v-for="(movimiento, index) in movimientos" :key="index" class="mb-4">{{ movimiento.user.name }} - {{ movimiento.valor }} - {{ new Date(movimiento.created_at).toLocaleDateString() }} </li>
              </ul>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
