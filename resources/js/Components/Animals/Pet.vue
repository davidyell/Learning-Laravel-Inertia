<script setup lang="ts">
import { ref } from "vue";
import PrimaryButton from "@/Components/Breeze/PrimaryButton.vue";

const emit = defineEmits(["editModal"]);
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
            <div class="mb-3">Adopt me today!</div>
        </div>
        <div
            v-else
            class="bg-gray-300 text-gray-500 px-2 py-3 rounded-tl-lg rounded-tr-lg w-full text-center"
        >
            <div class="mb-3">Found a forever home!</div>
        </div>
        <img
            :src="animal.image"
            :alt="animal.name"
            class="rounded-lg mb-3 -mt-4"
        />

        <div>
            <h2
                class="text-xl font-semibold"
                :class="animal.available ? availableClass : unavailableClass"
            >
                {{ animal.name }} ({{ animal.age }} years)
            </h2>

            <div
                class="text-sm"
                :class="animal.available ? availableClass : unavailableClass"
            >
                <p class="text-lg">{{ animal.species }}, {{ animal.breed }}</p>
                <p class="my-2">{{ animal.description }}</p>
                <p v-if="animal.available" class="text-lg">
                    &pound;
                    {{
                        animal.price.toLocaleString("en-GB", {
                            style: "currency",
                            currency: "GBP",
                        })
                    }}
                </p>
            </div>
            <div class="text-center mt-4" v-if="$page.props.auth.user.id">
                <PrimaryButton @click="emit('editModal', animal.id)">
                    Edit
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
