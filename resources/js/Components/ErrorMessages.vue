<script setup>
import { ref, watch, defineProps } from "vue";

const props = defineProps({
    errors: {
        type: Object,
        required: true,
    },
});

const showErrorMessages = ref(false);
const fadeOut = ref(false);

// Watch for changes in props.errors
watch(
    () => props.errors,
    (newErrors) => {
        if (Object.keys(newErrors).length > 0) {
            showErrorMessages.value = true;
            fadeOut.value = false; // Reset fadeOut state

            // Set a timeout to trigger fade-out after 3 seconds
            setTimeout(() => {
                fadeOut.value = true; // Start fading out
                setTimeout(() => {
                    showErrorMessages.value = false; // Hide after fade-out
                }, 500); // Match this duration with your CSS transition duration
            }, 5000); // Show for 3 seconds
        } else {
            showErrorMessages.value = false; // Hide if no errors
        }
    },
    { immediate: true } // Run immediately on component mount
);
</script>

<template>
    <div class="mb-4" v-if="showErrorMessages" :class="{ 'fade-out': fadeOut }">
        <p class="text-sm text-red-500">Something went wrong!</p>
        <ul class="ml-4 list-disc list-inside">
            <li
                v-for="(error, i) in errors"
                :key="i"
                class="text-sm text-red-500"
            >
                {{ error }}
            </li>
        </ul>
        <hr class="mt-2" />
    </div>
</template>

<style scoped>
.fade-out {
    opacity: 0;
    transition: opacity 0.5s ease-out; /* Duration of the fade-out */
}
</style>
