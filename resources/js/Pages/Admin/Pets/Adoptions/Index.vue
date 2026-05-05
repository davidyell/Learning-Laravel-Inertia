<script setup lang="ts">
import PetCard from "@/components/animals/PetCard.vue";
import type { Adoption } from "@/interfaces/Adoption";
import { Animal } from "@/interfaces/Animal";
import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import dayjs from "dayjs";
import Button from '@/components/ui/button/Button.vue';
import { route } from 'ziggy-js';
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    animal: Animal & { adoptions: Adoption[] };
}>();

function approveAdoption(adoptionId: number) {
    const adoption = props.animal.adoptions.find(adoption => adoption.id === adoptionId);
    router.post(route('admin.pets.adoptions.approve', { animal: props.animal.id, adoption: adoption!.id }));
}

const hasApprovedAdoption = computed(() => props.animal.adoptions.find(adoption => adoption.approved) ?? false)
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
                        <Card
                            v-for="adoption in animal.adoptions"
                            :key="adoption.id"
                            class="w-full mb-4 bg-white border-gray-300"
                        >
                            <CardContent>
                                <div
                                    class="flex flex-row gap-3 items-center p-5"
                                >
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
                                                dayjs(
                                                    adoption.updated_at,
                                                ).format("HH:mm:s D MMM YYYY")
                                            }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <Badge v-if="adoption.approved" variant="success">
                                            Approved by {{ adoption.approver?.name }}
                                        </Badge>
                                        <template v-else-if="hasApprovedAdoption === false">
                                            <Badge variant="warning">
                                                Pending
                                            </Badge>
                                            <Button @click="approveAdoption(adoption.id)">
                                                Approve adoption
                                            </Button>
                                        </template>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                    <p v-else>No adoptions found.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
