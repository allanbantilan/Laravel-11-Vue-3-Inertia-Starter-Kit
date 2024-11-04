<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    message: {
        type: String,
        required: false, // Not required since it can be empty
    },
});

const visible = ref(false);

// Function to close the message
const close = () => {
    visible.value = false;
};

// Show the message when the component is mounted
onMounted(() => {
    visible.value = true;
    setTimeout(() => {
        close();
    }, 4000); // Hide after 5 seconds
});
</script>

<template>
    <transition name="slide">
        <div
            v-if="visible"
            class="fixed top-5 right-5 bg-emerald-500 text-white p-4 rounded-lg shadow-lg z-50 transition-all duration-300 ease-in-out"
        >
            {{ message }}
        </div>
    </transition>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.5s ease;
}
.slide-enter {
    transform: translateX(100%); /* Slide in from the right */
}
.slide-leave-to {
    transform: translateX(100%); /* Slide out to the right */
}
</style>
