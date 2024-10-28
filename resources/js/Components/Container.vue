<script setup>
import { defineProps } from "vue";

// Props for customizing the container
defineProps({
    maxWidth: {
        type: String,
        default: "max-w-screen-lg", // Set the default max width
    },
    padding: {
        type: String,
        default: "p-6", // Set default padding
    },
    centered: {
        type: Boolean,
        default: true, // Center align by default
    },
});
</script>

<template>
    <div
        :class="[
            maxWidth, // Apply max width class
            padding, // Apply padding class
            { 'mx-auto': centered }, // Center align if `centered` is true
        ]"
    >
        <slot />
    </div>
</template>
