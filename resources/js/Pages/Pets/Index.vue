<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import Navigation from "@/Components/UserSite/Navigation.vue";
import Footer from "@/Components/UserSite/Footer.vue";
import { LengthAwarePaginator } from "@/interfaces/LengthAwarePaginator";
import { Animal } from "@/interfaces/Animal";
import { Species } from "@/interfaces/Species";

defineProps<{
    appName: string;
    canLogin: boolean;
    animals: LengthAwarePaginator<Animal>;
    species: Species[];
}>();
</script>

<template>
    <Head title="Welcome" />

    <Navigation :appName="appName" />

    <div class="pt-24">
        <div class="container px-3 mx-auto">
            <section class="bg-white border-b p-8">
                <h1 class="text-xl text-gray-800">The Adopt A Pet Page</h1>

                <p v-for="animal in animals.data" :key="animal.id">
                    {{ animal.name }}
                </p>
            </section>
        </div>
    </div>

    <Footer />
</template>
