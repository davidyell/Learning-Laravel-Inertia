<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Welcome back {{ $page.props.auth.user.name }}!
                    </div>

                    <div class="flex justify-center justify-around p-6">
                        <div class="text-center">
                            <h3>Pet count</h3>
                            <p class="text-4xl font-semibold text-gray-900">
                                {{ $page.props.petCount }}
                            </p>
                        </div>
                        <div class="text-center">
                            <h3>Pets available</h3>
                            <p class="text-4xl font-semibold text-gray-900">
                                {{ $page.props.petsAvailable }}
                            </p>
                        </div>
                        <div class="text-center">
                            <h3>Pets adopted</h3>
                            <p class="text-4xl font-semibold text-gray-900">
                                {{
                                    $page.props.petCount -
                                    $page.props.petsAvailable
                                }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
