<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Species } from "@/interfaces/Species";
import { Animal } from "@/interfaces/Animal";
import PetForm from "@/Components/Animals/PetForm.vue";

const props = defineProps<{
    animal: Animal;
    species: Species[];
}>();

useForm({
    name: "",
});
</script>

<template>
    <Head title="Create pet" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-end mb-4">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Create Pet
                </h2>
            </div>
        </template>

        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <PetForm
                :method="'create'"
                :animal="props.animal"
                :species="props.species"
                :isModal="false"
            />
        </div>
    </AuthenticatedLayout>
</template>
