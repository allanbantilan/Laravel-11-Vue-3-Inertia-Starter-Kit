<script setup>
const model = defineModel();
const props = defineProps({
    label: String,
    type: {
        String,
        default: "text",
    },
    placeholder: String,
    icon: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <div class="mb-4">
        <label :for="label" class="block text-gray-700 font-semibold mb-2">
            <i :class="`fas fa-${icon} mr-2`"></i>
            <!-- Font Awesome Icon -->
            {{ props.label }}
        </label>
        <input
            :type="type"
            :id="label"
            class="w-full p-3 border rounded-lg"
            :placeholder="placeholder"
            v-model="model"
        />
    </div>
</template>
