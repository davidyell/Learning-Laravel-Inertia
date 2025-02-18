<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
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
            <div class="grid grid-cols-3 gap-3">
                <p>Some create form goes here!</p>
                <p>
                    Perhaps use the same edit form? Once it's refactored out of
                    the modal perhaps
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
