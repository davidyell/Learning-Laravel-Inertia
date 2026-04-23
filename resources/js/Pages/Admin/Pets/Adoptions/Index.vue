<script setup lang="ts">
import PetCard from "@/Components/Animals/PetCard.vue";
import type { Adoption } from "@/Interfaces/Adoption";
import { Animal } from "@/Interfaces/Animal";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import dayjs from "dayjs";
import { FwbCard, FwbBadge } from "flowbite-vue";

defineProps<{
    animal: Animal & { adoptions: Adoption[] };
}>();
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-end mb-4">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Pet adoptions for {{ animal.name }}
                </h2>
            </div>
        </template>

        <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="grid grid-cols-3 gap-6 items-start">
                <div class="col-span-1">
                    <PetCard :animal="animal" />
                </div>

                <div class="col-span-2">
                    <div v-if="animal.adoptions.length > 0">
                        <FwbCard
                            v-for="adoption in animal.adoptions"
                            :key="adoption.id"
                            variant="horizontal"
                            class="w-full mb-4 bg-white border-gray-300"
                        >
                            <div class="flex flex-row gap-3 items-center p-5">
                                <div class="flex-1">
                                    <h5
                                        class="mb-2 text-2xl font-bold tracking-tight"
                                    >
                                        {{ adoption.user?.name }}
                                    </h5>
                                    <p>{{ adoption.user?.email }}</p>
                                    <p>{{ adoption.notes }}</p>
                                    <p class="text-gray-500 text-sm mt-4">
                                        Submitted at
                                        {{
                                            dayjs(adoption.updated_at).format(
                                                "HH:mm:s D MMM YYYY",
                                            )
                                        }}
                                    </p>
                                </div>
                                <FwbBadge v-if="adoption.approved" type="green">
                                    Approved
                                </FwbBadge>
                                <FwbBadge v-else type="yellow">
                                    Pending
                                </FwbBadge>
                            </div>
                        </FwbCard>
                    </div>
                    <p v-else>No adoptions found.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
