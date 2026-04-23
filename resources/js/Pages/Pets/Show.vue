<script setup lang="ts">
import { ref } from "vue";
import PublicLayout from "@/Layouts/PublicLayout.vue";
import PrimaryButton from "@/Components/Breeze/PrimaryButton.vue";
import { Animal } from "@/Interfaces/Animal";
import { useAuth } from '@/Composables/useAuth';
import { FwbModal, FwbButton, FwbTextarea, FwbAlert } from 'flowbite-vue';
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js';
import { usePage } from '@inertiajs/vue3';

const props = defineProps<{
    animal: Animal;
    errors: { notes: string };
}>()

const { user, isAuthenticated } = useAuth();
const showAdoptModal = ref(false)
const page = usePage()

const form = useForm({
    id: props.animal.id,
    notes: ''
})

const sendAdoption = () => {
    form.post(route('pets.adopt', props.animal.id), {
        onSuccess: () => {
            form.reset();
            form.clearErrors();
            showAdoptModal.value = false;
        }
    })
}
</script>

<template>
    <PublicLayout title="View Pet">
        <FwbAlert type="info" v-if="page.props.flash?.success">
            {{ page.props.flash.success }}
        </FwbAlert>

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

                <div class="mt-6" v-if="animal.available && isAuthenticated">
                    <PrimaryButton @click="showAdoptModal = true">
                        Adopt this pet
                    </PrimaryButton>
                </div>
                <div class="mt-6" v-else>
                    <FwbButton href="/register">Sign up to adopt</FwbButton>
                </div>
            </div>
        </div>

        <FwbModal v-if="showAdoptModal" @close="showAdoptModal = false">
            <template #header>
                <h2 class="text-lg font-semibold text-gray-900">
                    Adopt {{ animal.name }}
                </h2>
            </template>
            <template #body>
                <p class="mb-3">
                    You're one step closer to giving {{ animal.name }} a forever
                    home! Please contact us to start the adoption process.
                </p>

                <form @submit.prevent="sendAdoption" class="space-y-3">
                    <FwbTextarea v-model="form.notes" :label="`Why do you want to adopt ${animal.name}`"/>
                    <p class="text-sm text-red-600" v-if="errors.notes">{{ errors.notes }}</p>

                    <p class="text-sm text-gray-400">Adopting as: {{ user?.name }} {{ user?.email }}</p>
                    <FwbButton type="submit">Send</FwbButton>
                </form>
            </template>
        </FwbModal>
    </PublicLayout>
</template>
