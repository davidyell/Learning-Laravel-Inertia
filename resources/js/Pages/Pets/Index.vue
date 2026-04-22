<script setup lang="ts">
import PublicLayout from "@/Layouts/PublicLayout.vue";
import { LengthAwarePaginator } from "@/Interfaces/LengthAwarePaginator";
import { Animal } from "@/Interfaces/Animal";
import { Species } from "@/Interfaces/Species";
import PetCard from '@/Components/Animals/PetCard.vue';
import FilterPets from "@/Components/Animals/FilterPets.vue";

defineProps<{
    canLogin: boolean;
    animals: LengthAwarePaginator<Animal>;
    species: Species[];
}>();
</script>

<template>
    <PublicLayout title="Adopt A Pet">
        <h1 class="text-xl text-gray-800">The Adopt A Pet Page</h1>

        <FilterPets :species="species" route-name="pets.index"/>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-3 items-center">
            <div v-for="animal in animals.data" :key="animal.id">
                <a :href="`/pets/${animal.id}`" :title="`View ${animal.name}`">
                    <PetCard :animal="animal" />
                </a>
            </div>
        </div>
    </PublicLayout>
</template>
