<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextArea from "@/Components/TextArea.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
    animal: {
        type: Object,
        required: true,
    },
    isModal: {
        type: Boolean,
        default: false,
    },
});
const emit = defineEmits(["close"]);
const form = useForm(props.animal);
</script>

<template>
    <form
        @submit.prevent="
            form.put(route('animals.update', animal.id), {
                onSuccess: () => (emit('close'), form.reset()),
            })
        "
    >
        <div class="space-y-12">
            <div class="pb-12">
                <h2
                    class="text-base/7 font-semibold text-gray-900 border-b-1 mb-4"
                >
                    Edit {{ animal.name }} the {{ animal.species }}
                </h2>

                <div class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-3">
                        <InputLabel value="Name" />
                        <div class="mt-2">
                            <TextInput
                                v-model="form.name"
                                label="Name"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            ></TextInput>

                            <InputError
                                :message="form.errors.name"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <InputLabel value="Age (years)" />
                        <div class="mt-2">
                            <TextInput
                                v-model="form.age"
                                label="Age (years)"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            ></TextInput>

                            <InputError
                                :message="form.errors.age"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <InputLabel value="Species" />
                        <div class="mt-2">
                            <TextInput
                                v-model="form.species"
                                label="Species"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            ></TextInput>

                            <InputError
                                :message="form.errors.species"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <InputLabel value="Breed" />
                        <div class="mt-2">
                            <TextInput
                                v-model="form.breed"
                                label="Breed"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            ></TextInput>

                            <InputError
                                :message="form.errors.breed"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div class="col-span-full">
                        <InputLabel value="Description" />
                        <div class="mt-2">
                            <div class="col-span-full">
                                <TextArea
                                    v-model="form.description"
                                    label="Description"
                                    class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                ></TextArea>

                                <InputError
                                    :message="form.errors.description"
                                    class="mt-2"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="col-span-3">
                        <InputLabel value="Price" />
                        <div class="mt-2">
                            <TextInput
                                v-model="form.price"
                                label="Price"
                                class="block w-full min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                            ></TextInput>

                            <InputError
                                :message="form.errors.price"
                                class="mt-2"
                            />
                        </div>
                    </div>

                    <div class="col-span-3">
                        <InputLabel value="Is available" />
                        <div class="mt-2">
                            <Checkbox
                                v-model="form.available"
                                label="Is available"
                                :checked="form.available ? true : false"
                                :value="form.available"
                            />
                            <InputError
                                :message="form.errors.available"
                                class="mt-2"
                            />
                        </div>
                    </div>
                </div>
                <!-- end grid -->
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <div class="space-x-2">
                    <PrimaryButton class="mt-4">Save</PrimaryButton>
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
