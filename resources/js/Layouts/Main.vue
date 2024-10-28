<script setup>
defineProps({
    auth: Object,
});
</script>

<template>
    <header class="bg-slate-800 text-gray-100">
        <nav
            class="flex item-center justify-between p-6 mx-auto max-w-screen-lg"
        >
            <Link :href="route('home')">Home</Link>
            <div class="flex items-center justify-items-end gap-4">
                <!-- Show if user is logged in -->
                <Link
                    v-if="auth.user"
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="bg-red-600 px-4 py-1 rounded-lg text-white hover:bg-red-500"
                >
                    Logout
                </Link>

                <!-- Show if user is a guest -->
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="bg-emerald-600 px-4 py-1 rounded-lg text-white hover:bg-emerald-500"
                    >
                        Login
                    </Link>
                    <Link
                        :href="route('register')"
                        class="bg-emerald-600 px-4 py-1 rounded-lg text-white hover:bg-emerald-500"
                    >
                        Register
                    </Link>
                </template>
            </div>
        </nav>
    </header>

    <main class="p-6">
        <slot />
    </main>
</template>
