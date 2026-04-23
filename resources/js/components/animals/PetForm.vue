<script setup lang="ts">
import { Alert, AlertDescription } from "@/components/ui/alert";
import { Button } from "@/components/ui/button";
import { Checkbox } from "@/components/ui/checkbox";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { useForm } from "@inertiajs/vue3";
import { Animal } from "@/interfaces/Animal";
import { Species } from "@/interfaces/Species";
import { route } from "ziggy-js";

const props = defineProps<{
    method: string;
    animal: Animal;
    species: Species[];
    isModal: boolean;
}>();
const emit = defineEmits(["close"]);
const form = useForm({
    name: props.animal?.name ?? "",
    age: props.animal?.age ?? "",
    breed: props.animal?.breed ?? "",
    description: props.animal?.description ?? "",
    price: props.animal?.price ?? "",
    available: props.animal?.available ?? false,
    species_id: props.animal?.species?.id ?? undefined,
});
</script>

<template>
    <form
        @submit.prevent="
            if (props.method === 'create') {
                form.post(route('admin.pets.store'), {
                    onSuccess: () => (emit('close'), form.reset()),
                });
            } else {
                form.put(route('admin.pets.update', props.animal.id), {
                    onSuccess: () => (emit('close'), form.reset()),
                });
            }
        "
    >
        <div class="space-y-12">
            <div class="pb-12">
                <h2
                    v-if="props.method === 'edit'"
                    class="text-base/7 font-semibold text-gray-900 border-b-1 mb-4"
                >
                    Edit {{ animal.name }} the {{ animal.species.name }}
                </h2>
                <h2
                    v-else
                    class="text-base/7 font-semibold text-gray-900 border-b-1 mb-4"
                >
                    Create new pet
                </h2>

                <div class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-3">
                        <Label>Name</Label>
                        <div class="mt-2">
                            <Input
                                v-model="form.name"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            />

                            <Alert
                                variant="destructive"
                                class="mt-2"
                                v-if="form.errors.name"
                            >
                                <AlertDescription>{{
                                    form.errors.name
                                }}</AlertDescription>
                            </Alert>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <Label>Age (years)</Label>
                        <div class="mt-2">
                            <Input
                                v-model="form.age"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            />

                            <Alert
                                variant="destructive"
                                class="mt-2"
                                v-if="form.errors.age"
                            >
                                <AlertDescription>{{
                                    form.errors.age
                                }}</AlertDescription>
                            </Alert>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <Label>Species</Label>
                        <div class="mt-2">
                            <select
                                id="filter-species"
                                class="p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mr-4 w-full"
                                v-model="form.species_id"
                            >
                                <option
                                    v-for="s in species"
                                    :key="s.id"
                                    :value="s.id"
                                >
                                    {{ s.name }}
                                </option>
                            </select>

                            <Alert
                                variant="destructive"
                                class="mt-2"
                                v-if="form.errors.species_id"
                            >
                                <AlertDescription>{{
                                    form.errors.species_id
                                }}</AlertDescription>
                            </Alert>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <Label>Breed</Label>
                        <div class="mt-2">
                            <Input
                                v-model="form.breed"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            />

                            <Alert
                                variant="destructive"
                                class="mt-2"
                                v-if="form.errors.breed"
                            >
                                <AlertDescription>{{
                                    form.errors.breed
                                }}</AlertDescription>
                            </Alert>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <Label>Description</Label>
                        <div class="mt-2">
                            <div class="col-span-full">
                                <Textarea
                                    v-model="form.description"
                                    class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                />

                                <Alert
                                    variant="destructive"
                                    class="mt-2"
                                    v-if="form.errors.description"
                                >
                                    <AlertDescription>{{
                                        form.errors.description
                                    }}</AlertDescription>
                                </Alert>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <Label>Price</Label>
                        <div class="mt-2">
                            <Input
                                v-model="form.price"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            />

                            <Alert
                                variant="destructive"
                                class="mt-2"
                                v-if="form.errors.price"
                            >
                                <AlertDescription>{{
                                    form.errors.price
                                }}</AlertDescription>
                            </Alert>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <Label>Is available</Label>
                        <div class="mt-2">
                            <Checkbox v-model:checked="form.available" />
                            <Alert
                                variant="destructive"
                                class="mt-2"
                                v-if="form.errors.available"
                            >
                                <AlertDescription>{{
                                    form.errors.available
                                }}</AlertDescription>
                            </Alert>
                        </div>
                    </div>
                </div>
                <!-- end grid -->
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <div class="space-x-2">
                    <Button class="mt-4">Save</Button>
                    <button
                        v-if="isModal"
                        class="mt-4"
                        @click="
                            $event.preventDefault();
                            emit('close');
                            form.reset();
                            form.clearErrors();
                        "
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>
