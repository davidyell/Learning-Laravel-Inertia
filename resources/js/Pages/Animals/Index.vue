<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pet from "@/Components/Animals/Pet.vue";
import { Head } from "@inertiajs/vue3";
import Modal from "@/Components/Breeze/Modal.vue";
import EditPet from "@/Components/Animals/EditPet.vue";
import { ref } from "vue";
import { Animal } from "@/interfaces/Animal";
import Pagination from "@/Components/Pagination.vue";
import { LengthAwarePaginator } from "../../interfaces/LengthAwarePaginator";

const props = defineProps<{
    animals: LengthAwarePaginator<Animal>,
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
                <a
                    :href="route('animals.create')"
                    class="text-sm/6 text-blue-600 hover:text-blue-900 px-3"
                    >Add a new pet</a
                >
            </div>
        </template>

        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="grid grid-cols-3 gap-3">
                <Pet
                    v-if="animals.data.length > 0"
                    v-for="animal in animals.data"
                    :key="animal.id"
                    :animal="animal"
                    @edit-modal="openEditModal"
                />
                <p v-else>No pets found. Please create one. <br/><a
                    :href="route('animals.create')"
                    class="text-sm/6 text-blue-600 hover:text-blue-900 px-3"
                    >Add a new pet</a
                ></p>
            </div>
        </div>

        <Pagination :pagination="animals" />

        <Modal :show="showModal" @close="resetEditModal">
            <div class="m-4">
                <EditPet
                    v-if="editedAnimal !== null"
                    :animal="editedAnimal"
                    :isModal="true"
                    @close="resetEditModal"
                />
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
