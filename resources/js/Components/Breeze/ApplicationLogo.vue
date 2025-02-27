<script setup lang="ts">
defineProps<{
    color?: "white" | "black";
}>();
</script>
<template>
    <img
        v-if="color === 'black'"
        src="/pet-hotel-sign-of-a-bone-in-a-dog-house-svgrepo-com.svg"
        alt="Pet Store"
    />
    <img
        v-else
        src="/pet-hotel-sign-of-a-bone-in-a-dog-house-svgrepo-com-white.svg"
        alt="Pet Store"
    />
</template>
