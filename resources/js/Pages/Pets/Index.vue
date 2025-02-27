<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import Navigation from "@/Components/UserSite/Navigation.vue";

defineProps<{
    appName: string;
}>();
</script>

<template>
    <Head title="Welcome" />

    <Navigation :appName="appName" />

    <div class="pt-24">
        <div class="container px-3 mx-auto">
            <section class="bg-white border-b p-8">
                <h1 class="text-xl text-gray-800">The Adopt A Pet Page</h1>
            </section>
        </div>
    </div>
</template>
