<script setup lang="ts">
import ApplicationLogo from "@/Components/Breeze/ApplicationLogo.vue";
</script>

<template>
    <!--Footer-->
    <footer class="bg-white">
        <div class="container mx-auto px-8">
            <div class="w-full flex flex-col md:flex-row py-6">
                <div class="flex-1 mb-6 text-black">
                    <a
                        class="text-black no-underline hover:no-underline text-xl lg:text-2xl"
                        href="/"
                    >
                        <ApplicationLogo
                            class="w-6 h-6 inline-block"
                            :color="'black'"
                        />
                        {{ appName }}
                    </a>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Links</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >FAQ</a
                            >
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Help</a
                            >
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Support</a
                            >
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Legal</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Terms</a
                            >
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Privacy</a
                            >
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Social</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Facebook</a
                            >
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Linkedin</a
                            >
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Twitter</a
                            >
                        </li>
                    </ul>
                </div>
                <div class="flex-1">
                    <p class="uppercase text-gray-500 md:mb-6">Company</p>
                    <ul class="list-reset mb-6">
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >About Us</a
                            >
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="#"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Contact</a
                            >
                        </li>
                        <li class="mt-2 inline-block mr-2 md:block md:mr-0">
                            <a
                                href="/login"
                                class="no-underline hover:underline text-gray-800 hover:text-pink-500"
                                >Login</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>
