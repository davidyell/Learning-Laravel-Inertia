<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import Navigation from "@/components/user-site/Navigation.vue";
import Footer from "@/components/user-site/Footer.vue";
import { getCurrentInstance } from "vue";

defineProps<{
    title: string;
}>();

const app = getCurrentInstance();
const appName =
    app?.appContext.config.globalProperties.appName || "Daves Pet Store";
</script>

<template>
    <Head :title="title" />

    <Navigation :appName="appName" />

    <div class="pt-24">
        <div class="container px-3 mx-auto">
            <section class="bg-white border-b p-8">
                <slot />
            </section>
        </div>
    </div>

    <Footer />
</template>
