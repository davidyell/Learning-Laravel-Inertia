<script setup>
import { defineProps, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import EditPet from "./EditPet.vue";

const props = defineProps({
    animal: {
        type: Object,
        required: true,
    },
});
const availableClass = ref("text-gray-800");
const unavailableClass = ref("text-gray-400");
</script>

<template>
    <div
        :id="'pet-' + animal.id"
        class="bg-white p-4 rounded-lg shadow-md relative"
    >
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
            :src="animal.image"
            :alt="animal.name"
            class="rounded-lg mb-3 -mt-4"
        />

        <div>
            <h2
                class="text-lg font-semibold"
                :class="animal.available ? availableClass : unavailableClass"
            >
                {{ animal.name }} ({{ animal.age }} years)
            </h2>

            <div
                class="text-sm"
                :class="animal.available ? availableClass : unavailableClass"
            >
                <p>{{ animal.species }}, {{ animal.breed }}</p>
                <p>{{ animal.description }}</p>
                <p v-if="animal.available">
                    &pound;
                    {{
                        animal.price.toLocaleString("en-GB", {
                            style: "currency",
                            currency: "GBP",
                        })
                    }}
                </p>
            </div>

            <EditPet :animal="animal" />
        </div>
    </div>
</template>
