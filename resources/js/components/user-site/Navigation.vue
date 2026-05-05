<script setup lang="ts">
import ApplicationLogo from "@/components/ApplicationLogo.vue";
import { NavigationMenu, NavigationMenuList, NavigationMenuItem, NavigationMenuTrigger, NavigationMenuContent, NavigationMenuLink } from "@/components/ui/navigation-menu";
import { route } from "ziggy-js";
</script>

<template>
    <!--Nav-->
    <nav id="header" class="brand-gradient fixed w-full z-30 top-0 text-white">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4">
                <a class="flex text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="/">
                    <ApplicationLogo class="w-10 h-10 mr-2" />
                    <span>{{ appName }}</span>
                </a>
            </div>

            <NavigationMenu>
                <NavigationMenuList>
                    <NavigationMenuItem>
                        <NavigationMenuLink :href="route('pets.index')" title="Find a pet"
                            class="hover:bg-primary data-[active]:font-bold active:bg-primary/80"
                            :active="route().current() === 'pets.index'">Find a pet</NavigationMenuLink>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <NavigationMenuLink :href="route('page.rescue')" title="Rescue a pet"
                            class="hover:bg-primary data-[active]:font-bold active:bg-primary/80"
                            :active="route().current() === 'page.rescue'">Need a rescue?</NavigationMenuLink>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <NavigationMenuLink :href="route('register')" title="Register"
                            class="hover:bg-primary data-[active]:font-bold active:bg-primary/80">Register</NavigationMenuLink>
                    </NavigationMenuItem>
                    <NavigationMenuItem>
                        <NavigationMenuLink :href="route('login')" title="Login"
                            class="hover:bg-primary data-[active]:font-bold active:bg-primary/80">Login</NavigationMenuLink>
                    </NavigationMenuItem>
                </NavigationMenuList>
            </NavigationMenu>

        </div>
    </nav>
</template>
