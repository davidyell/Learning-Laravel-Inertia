<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pet from "@/Components/Animals/Pet.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import Modal from "@/Components/Breeze/Modal.vue";
import EditPet from "@/Components/Animals/EditPet.vue";

const props = defineProps({
    animals: {
        type: Array,
        required: true,
    },
});
const showModal = ref(false);
const editedAnimal = ref(null);

const resetEditModal = () => {
    showModal.value = false;
    editedAnimal.value = null;
};
const openEditModal = (id) => {
    showModal.value = true;
    editedAnimal.value = props.animals.find((a) => a.id === id);
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
                    v-for="animal in animals"
                    :key="animal.id"
                    :animal="animal"
                    @edit-modal="openEditModal"
                />
            </div>
        </div>

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
