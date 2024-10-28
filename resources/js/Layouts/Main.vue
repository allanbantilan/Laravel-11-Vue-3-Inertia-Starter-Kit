<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { usePage } from "@inertiajs/vue3";

defineProps({
    auth: Object,
});

const auth = usePage().props.auth;
const dropdownOpen = ref(false);

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
};

const closeDropdown = (event) => {
    if (!event.target.closest(".relative")) {
        dropdownOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", closeDropdown);
});

onUnmounted(() => {
    document.removeEventListener("click", closeDropdown);
});
</script>

<template>
    <header class="bg-slate-800 text-gray-100">
        <nav
            class="flex item-center justify-between p-6 mx-auto max-w-screen-lg"
        >
            <div v-if="auth.user" class="flex gap-4">
                <Link :href="route('home')">Dashboard</Link>
                <Link :href="route('home')"></Link>
            </div>
            <div v-else>
                <Link :href="route('home')">Home</Link>
            </div>
            <div class="flex items-center justify-end gap-4">
                <!-- Show if user is logged in -->
                <div v-if="auth.user" class="relative">
                    <!-- Dropdown Toggle Button -->
                    <button
                        @click="toggleDropdown"
                        class="flex items-center bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 focus:outline-none"
                    >
                        <i class="fas fa-user-circle text-xl mr-2"></i>
                        <!-- Font Awesome user icon -->
                        <span>{{ auth.user.name }}</span>
                        <i class="fas fa-caret-down ml-2"></i>
                        <!-- Font Awesome caret down icon -->
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        v-show="dropdownOpen"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg"
                    >
                        <Link
                            :href="route('home')"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                        >
                            <i class="fas fa-user mr-2"></i> Profile
                        </Link>
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                        >
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </Link>
                    </div>
                </div>

                <!-- Show if user is a guest -->
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="bg-emerald-600 px-4 py-1 rounded-lg text-white hover:bg-emerald-500 flex items-center"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </Link>
                    <Link
                        :href="route('register')"
                        class="bg-emerald-600 px-4 py-1 rounded-lg text-white hover:bg-emerald-500 flex items-center"
                    >
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </Link>
                </template>
            </div>
        </nav>
    </header>

    <main class="p-6">
        <slot />
    </main>
</template>
