<script setup>
import AuthLayout from "@/layouts/AuthLayout.vue";
import { Alert, AlertDescription } from "@/components/ui/alert";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Head, useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your
            password before continuing.
        </div>

        <form @submit.prevent="submit">
            <div>
                <Label for="password">Password</Label>
                <Input
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <Alert
                    variant="destructive"
                    class="mt-2"
                    v-if="form.errors.password"
                >
                    <AlertDescription>{{
                        form.errors.password
                    }}</AlertDescription>
                </Alert>
            </div>

            <div class="mt-4 flex justify-end">
                <Button
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirm
                </Button>
            </div>
        </form>
    </AuthLayout>
</template>
