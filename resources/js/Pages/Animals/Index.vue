<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PetCard from "@/Components/Animals/PetCard.vue";
import { Head } from "@inertiajs/vue3";
import Modal from "@/Components/Breeze/Modal.vue";
import { ref } from "vue";
import { Animal } from "@/interfaces/Animal";
import Pagination from "@/Components/Pagination.vue";
import { LengthAwarePaginator } from "../../interfaces/LengthAwarePaginator";
import { route } from "ziggy-js";
import FilterPets from "@/Components/Animals/FilterPets.vue";
import NavLink from "@/Components/Breeze/NavLink.vue";
import { Species } from "@/interfaces/Species";
import PetForm from "@/Components/Animals/PetForm.vue";

const props = defineProps<{
    animals: LengthAwarePaginator<Animal>;
    species: Species[];
}>();
const showModal = ref<boolean>(false);
const editedAnimal = ref<Animal | null>(null);

const resetEditModal = () => {
    showModal.value = false;
    editedAnimal.value = null;
};
const openEditModal = (id: number) => {
    showModal.value = true;
    editedAnimal.value = props.animals.data.find((a) => a.id === id) ?? null;
};
</script>

<template>
    <Head title="Pets" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-end mb-4">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Pets
                </h2>
                <NavLink :href="route('animals.create')">
                    Add a new pet
                </NavLink>
            </div>
        </template>

        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <FilterPets :species="species" />

            <div class="grid grid-cols-3 gap-3" v-if="animals.data.length > 0">
                <PetCard
                    v-for="animal in animals.data"
                    :key="animal.id"
                    :animal="animal"
                    @edit-modal="openEditModal"
                />
            </div>
            <p v-else>
                No pets found. Would you like to
                <a
                    :href="route('animals.create')"
                    class="text-blue-600 hover:text-blue-900"
                    >add a new pet</a
                >?
            </p>
        </div>

        <Pagination :pagination="animals" />

        <Modal :show="showModal" @close="resetEditModal">
            <div class="m-4">
                <PetForm
                    v-if="editedAnimal !== null"
                    :method="'edit'"
                    :animal="editedAnimal"
                    :species="species"
                    :isModal="true"
                    @close="resetEditModal"
                />
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
