<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pet from "@/Components/Animals/Pet.vue";
import { useForm, Head } from "@inertiajs/vue3";

defineProps(["animals"]);
</script>

<template>
    <Head title="Pets" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="grid grid-cols-3 gap-3">
                <Pet
                    v-for="animal in animals"
                    :key="animal.id"
                    :animal="animal"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
