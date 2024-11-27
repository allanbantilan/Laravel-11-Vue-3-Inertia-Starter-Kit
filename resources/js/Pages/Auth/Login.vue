<script setup>
import Container from "../../Components/Container.vue";
import Title from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import Button from "../../Components/Button.vue";
import TextLink from "../../Components/TextLink.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import { router, useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Container>
        <div
            class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto w-full sm:max-w-xl"
        >
            <Title title="Login" />

            <p class="flex items-center justify-center mb-4">
                Don't have an Account?
                <TextLink routeName="register" label="Register Here" />
            </p>
            <hr class="mb-2" />
            <ErrorMessages :errors="form.errors" />
            <form @submit.prevent="submit">
                <InputField
                    type="email"
                    label="Email"
                    placeholder="Enter your email"
                    icon="fas fa-envelope"
                    v-model="form.email"
                />
                <InputField
                    type="password"
                    label="Password"
                    placeholder="Enter your password"
                    icon="fas fa-lock"
                    v-model="form.password"
                />

                <div class="flex items-center justify-end mt-4">
                    <Button>Login</Button>
                </div>
            </form>
        </div>
    </Container>
</template>
