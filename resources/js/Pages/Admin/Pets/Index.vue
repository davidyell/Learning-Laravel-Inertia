<script setup lang="ts">
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import PetCard from "@/components/animals/PetCard.vue";
import { Button } from "@/components/ui/button";
import { Dialog, DialogContent } from "@/components/ui/dialog";
import { ref } from "vue";
import { Animal } from "@/interfaces/Animal";
import Pagination from "@/components/Pagination.vue";
import { LengthAwarePaginator } from "../../../interfaces/LengthAwarePaginator";
import { route } from "ziggy-js";
import { Link } from "@inertiajs/vue3";
import FilterPets from "@/components/animals/FilterPets.vue";
import { Species } from "@/interfaces/Species";
import PetForm from "@/components/animals/PetForm.vue";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);

const props = defineProps<{
    animals: LengthAwarePaginator<Animal & { adoptions_count: number }>;
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
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-end mb-4">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Pets
                </h2>
                <Link
                    :href="route('admin.pets.create')"
                    class="text-sm text-gray-600 underline hover:text-gray-900"
                >
                    Add a new pet
                </Link>
            </div>
        </template>

        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <FilterPets :species="species" route-name="admin.pets.index" />

            <div class="grid grid-cols-3 gap-3" v-if="animals.data.length > 0">
                <PetCard
                    v-for="animal in animals.data"
                    :key="animal.id"
                    :animal="animal"
                >
                    <template #footer>
                        <div class="flex flex-row items-center gap-3 mt-4">
                            <Button @click="openEditModal(animal.id)">
                                Edit
                            </Button>
                            <Link
                                v-if="animal.adoptions_count ?? 0 > 0"
                                :href="
                                    route(
                                        'admin.pets.adoptions.show',
                                        animal.id,
                                    )
                                "
                                class="text-sm text-gray-600 underline hover:text-gray-900"
                            >
                                {{ animal.adoptions_count }} Adoptions
                            </Link>
                            <p class="text-sm text-gray-500" v-else>
                                No adoptions yet
                            </p>
                            <p class="my-2 text-sm text-gray-500">
                                Last updated
                                {{ dayjs(animal.updated_at).fromNow() }}
                            </p>
                        </div>
                    </template>
                </PetCard>
            </div>
            <p v-else>
                No pets found. Would you like to
                <a
                    :href="route('admin.pets.create')"
                    class="text-blue-600 hover:text-blue-900"
                    >add a new pet</a
                >?
            </p>
        </div>

        <Pagination :pagination="animals" />

        <Dialog v-model:open="showModal">
            <DialogContent>
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
            </DialogContent>
        </Dialog>
    </AuthenticatedLayout>
</template>
