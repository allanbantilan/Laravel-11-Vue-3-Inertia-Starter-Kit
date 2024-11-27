<script setup>
import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import Button from "../../Components/Button.vue";
import TextLink from "../../Components/TextLink.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import { router, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Container>
        <div
            class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto w-full sm:max-w-xl"
        >
            <Title title="Register" />
            <p class="flex items-center justify-center mb-4">
                Already have an Account?
                <TextLink routeName="login" label="Login Here" />
            </p>
            <hr class="mb-2" />

            <ErrorMessages :errors="form.errors" />
            <form
                @submit.prevent="submit"
                class="grid grid-cols-1 gap-4 sm:grid-cols-2"
            >
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

                <div class="border-t border-gray-300 pt-4 mt-4 sm:mt-0">
                    <InputField
                        type="password"
                        label="Password"
                        placeholder="Enter your password"
                        icon="fas fa-lock"
                        v-model="form.password"
                    />
                </div>
                <div class="border-t border-gray-300 pt-4 mt-4 sm:mt-0">
                    <InputField
                        type="password"
                        label="Confirm Password"
                        placeholder="Confirm password"
                        icon="fas fa-lock"
                        v-model="form.password_confirmation"
                    />
                </div>
                <!-- Full-width button spanning two columns -->
                <div
                    class="flex items-center justify-end col-span-1 sm:col-span-2 mt-4"
                >
                    <Button>Register</Button>
                </div>
            </form>
        </div>
    </Container>
</template>
