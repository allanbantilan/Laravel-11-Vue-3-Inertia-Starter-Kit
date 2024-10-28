<script setup>
const props = defineProps({
    title: String,
});
</script>

<template>
    <h1 class="text-3xl font-bold mb-6 text-center">{{ props.title }}</h1>
</template>
