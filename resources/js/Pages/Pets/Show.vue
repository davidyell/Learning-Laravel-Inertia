<script setup lang="ts">
import { ref } from "vue";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import Modal from "@/Components/Breeze/Modal.vue";
import PrimaryButton from "@/Components/Breeze/PrimaryButton.vue";
import { Animal } from "@/Interfaces/Animal";

defineProps<{
    animal: Animal;
}>();

const showAdoptModal = ref(false);
</script>

<template>
    <PublicLayout title="View Pet">
        <div class="lg:flex lg:gap-8">
            <div class="lg:w-1/2">
                <div
                    v-if="animal.available"
                    class="bg-green-500 text-white px-2 py-3 rounded-tl-lg rounded-tr-lg w-full text-center"
                >
                    Adopt me today!
                </div>
                <div
                    v-else
                    class="bg-gray-300 text-gray-500 px-2 py-3 rounded-tl-lg rounded-tr-lg w-full text-center"
                >
                    Found a forever home!
                </div>
                <img
                    :src="animal.image ?? 'https://placecats.com/400/260'"
                    :alt="animal.name"
                    class="w-full object-cover rounded-bl-lg rounded-br-lg"
                />
            </div>

            <div class="lg:w-1/2 mt-6 lg:mt-0">
                <h1
                    class="text-3xl font-semibold"
                    :class="
                        animal.available ? 'text-gray-800' : 'text-gray-400'
                    "
                >
                    {{ animal.name }} ({{ animal.age }} years)
                </h1>

                <p class="text-lg text-gray-600 mt-1">
                    {{ animal.species.name }}, {{ animal.breed }}
                </p>

                <p v-if="animal.description" class="mt-4 text-gray-700">
                    {{ animal.description }}
                </p>

                <p
                    v-if="animal.available"
                    class="text-2xl font-semibold text-gray-800 mt-4"
                >
                    &pound;{{
                        animal.price.toLocaleString("en-GB", {
                            style: "currency",
                            currency: "GBP",
                        })
                    }}
                </p>

                <div class="mt-6" v-if="animal.available">
                    <PrimaryButton @click="showAdoptModal = true">
                        Adopt this pet
                    </PrimaryButton>
                </div>
            </div>
        </div>

        <Modal :show="showAdoptModal" @close="showAdoptModal = false">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">
                    Adopt {{ animal.name }}
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    You're one step closer to giving {{ animal.name }} a forever
                    home! Please contact us to start the adoption process.
                </p>
                <div class="mt-6 flex justify-end">
                    <PrimaryButton @click="showAdoptModal = false">
                        Close
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </PublicLayout>
</template>
