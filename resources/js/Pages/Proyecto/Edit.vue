<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';


const { proyecto } = usePage().props; // Assuming you have "proyecto" data passed from the backend.


const form = useForm({
   /*  user_id: '', */
    nombre: '',
    descripcion: '',
    imagen_url: '',
});

const submit = () => {
    form.post(route('proyecto.update'),/*  {
        onFinish: () => form.reset('password', 'password_confirmation'),
    } */);
};


// Initial form fields
const formFields = reactive([
  {
    id: 'nombre',
    label: 'Etiquetas',
    type: 'text',
    value: '', // Field value
    autocomplete: 'nombre',
    modelValue: '', // Replace with the appropriate value from the proyecto object
    error: '', // Field error message, you can add validation later if needed
  },
]);

// Function to add a new field to the form
const addField = () => {
  formFields.push({
    id: `field-${formFields.length}`,
    label: 'Añadir Etiqueta', // Replace with the desired label for new fields
    type: 'text', // Replace with the desired input type for new fields
    value: '', // Field value
    autocomplete: 'off', // You can customize this as needed
    modelValue: '', // Replace with the appropriate value if needed
    error: '', // Field error message, you can add validation later if needed
  });
};

// Function to remove a field from the form
const removeField = (index) => {
  formFields.splice(index, 1);
};



</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edita {{ proyecto.nombre }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit">

                    <div class="mt-4">
                        <!-- Loop through the form fields using v-for -->
                        <div v-for="(field, index) in formFields" :key="index">
                            <InputLabel :for="field.id" :value="field.label" />
                            <TextInput
                                :id="field.id"
                                :type="field.type"
                                class="mt-4 block w-full"
                                v-model="field.value"
                                :autofocus="index === 0"
                                :autocomplete="field.autocomplete"
                                :model-value="field.modelValue"
                            />
                            <InputError class="mt-2" :message="field.error" />

                            <!-- Add a Remove Field button for each field except the first one -->
                            <button v-if="index >= 0" @click="removeField(index)" class="mt-2 mb-8">Remove Field</button>
                        </div>

                        <!-- Add Field button -->
                        <button @click="addField" class="mt-4">Add Field</button>
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Guardar!
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
