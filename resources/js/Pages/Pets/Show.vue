<script setup lang="ts">
import { ref } from "vue";
import PublicLayout from "@/layouts/PublicLayout.vue";
import { Button } from "@/components/ui/button";
import { Alert, AlertDescription } from "@/components/ui/alert";
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
} from "@/components/ui/dialog";
import { Textarea } from "@/components/ui/textarea";
import { Label } from "@/components/ui/label";
import { Animal } from "@/interfaces/Animal";
import { useAuth } from "@/composables/useAuth";
import { useForm, Link } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { usePage } from "@inertiajs/vue3";

const props = defineProps<{
    animal: Animal;
    errors: { notes: string };
}>();

const { user, isAuthenticated } = useAuth();
const showAdoptModal = ref(false);
const page = usePage();

const form = useForm({
    id: props.animal.id,
    notes: "",
});

const sendAdoption = () => {
    form.post(route("pets.adopt", props.animal.id), {
        onSuccess: () => {
            form.reset();
            form.clearErrors();
            showAdoptModal.value = false;
        },
    });
};
</script>

<template>
    <PublicLayout title="View Pet">
        <Alert variant="destructive" v-if="page.props.flash?.success">
            <AlertDescription>{{ page.props.flash.success }}</AlertDescription>
        </Alert>

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
                    <Button @click="showAdoptModal=true">
                        Adopt this pet
                    </Button>
                </div>
                <div class="mt-6" v-else>
                    <Button as-child>
                        <Link href="/register">Sign up to adopt</Link>
                    </Button>
                </div>
            </div>
        </div>

        <Dialog v-model:open="showAdoptModal">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Adopt {{ animal.name }}</DialogTitle>
                </DialogHeader>
                <p class="mb-3">
                    You're one step closer to giving {{ animal.name }} a forever
                    home! Please contact us to start the adoption process.
                </p>

                <form @submit.prevent="sendAdoption" class="space-y-3">
                    <Label>Why do you want to adopt {{ animal.name }}</Label>
                    <Textarea v-model="form.notes" />
                    <Alert variant="destructive" v-if="errors.notes">
                        <AlertDescription>{{ errors.notes }}</AlertDescription>
                    </Alert>

                    <p class="text-sm text-gray-400">
                        Adopting as: {{ user?.name }} {{ user?.email }}
                    </p>
                    <Button type="submit">Send</Button>
                </form>
            </DialogContent>
        </Dialog>
    </PublicLayout>
</template>
