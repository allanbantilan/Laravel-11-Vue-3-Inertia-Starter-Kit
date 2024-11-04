<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import InputField from "../../Components/InputField.vue";
import Container from "../../Components/Container.vue";
import Button from "../../Components/Button.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import SuccessModal from "../../Components/SuccessModal.vue";
const props = defineProps({
    user: Object,
    status: String,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",
    newPassword: "",
});

const submit = () => {
    form.post(route("profile.update"), {});
};

const submitPassword = () => {
    form.post(route("profile.update.password"), {
        onSuccess: () => form.reset("password", "newPassword"),
        onError: () => form.reset("password", "newPassword"),
    });
};
</script>
<!-- TODO: The name and email should be seperated from the password -->
<template>
    <SuccessModal v-if="props.status" :message="props.status" />
    <div class="flex justify-center items-center w-full px-4 space-x-4">
        <!-- Update Name and Email Section -->
        <div class="bg-white p-8 rounded-lg shadow-md w-1/2">
            <h2
                class="text-2xl font-bold text-gray-800 tracking-wide border-b-2 border-gray-300 pb-2"
            >
                Update Name and Email
            </h2>

            <form @submit.prevent="submit" class="mt-4">
                <InputField
                    type="text"
                    label="Name"
                    placeholder="Enter your name"
                    icon="user"
                    v-model="form.name"
                />
                <InputField
                    type="email"
                    label="Email"
                    placeholder="Enter your email"
                    icon="fas fa-envelope"
                    v-model="form.email"
                />
                <Button :disabled="form.processing">Update</Button>
            </form>
        </div>

        <!-- Update Password Section -->
        <div class="bg-white p-8 rounded-lg shadow-md w-1/2">
            <h2
                class="text-2xl font-bold text-gray-800 tracking-wide border-b-2 border-gray-300 pb-2"
            >
                Update Password
            </h2>
            <form @submit.prevent="submitPassword" class="mt-4">
                <ErrorMessages :errors="form.errors" />
                <InputField
                    type="password"
                    label="Current Password"
                    placeholder="Current password"
                    icon="fas fa-lock"
                    v-model="form.password"
                />
                <InputField
                    type="password"
                    label="New Password"
                    placeholder="Enter your new password"
                    icon="fas fa-lock"
                    v-model="form.newPassword"
                />
                <Button :disabled="form.processing">Change Password</Button>
            </form>
        </div>
    </div>
</template>
