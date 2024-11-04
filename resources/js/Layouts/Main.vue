<script setup>
import { ref, defineProps } from "vue";

// Show or hide dropdown
const show = ref(false);

// Define props
const props = defineProps({
    auth: Object,
    sidebarVisible: {
        type: Boolean,
        default: false,
    },
});

// Function to toggle dropdown
const toggleDropdown = () => {
    show.value = !show.value;
};

// Function to close dropdown
const closeDropdown = () => {
    show.value = false;
};

const sidebarVisible = ref(true); // State to manage sidebar visibility

function toggleSidebar() {
    sidebarVisible.value = !sidebarVisible.value; // Toggle sidebar visibility
}
</script>

<template>
    <header class="bg-slate-800 text-gray-100 overflow-hidden">
        <nav
            :class="
                auth.user
                    ? 'flex items-center justify-between p-6  max-w-screen-lg'
                    : 'flex items-center justify-end p-6'
            "
        >
            <div class="ml-0" v-if="auth.user">LOGO HERE</div>

            <!-- Login and Register buttons on the right when user is a guest -->
            <div v-if="!auth.user" class="flex gap-4 mr-12">
                <Link
                    :href="route('login')"
                    class="bg-emerald-500 px-4 py-2 rounded-lg text-white hover:bg-emerald-600 transition duration-200"
                >
                    Login
                </Link>
                <Link
                    :href="route('register')"
                    class="bg-emerald-500 px-4 py-2 rounded-lg text-white hover:bg-emerald-600 transition duration-200"
                >
                    Register
                </Link>
            </div>
        </nav>
    </header>

    <!-- Sidebar for logged-in users -->
    <div class="flex h-[calc(100vh-4.5rem)] overflow-hidden relative">
        <!-- Sidebar for logged-in users -->
        <aside
            v-if="auth.user"
            :class="[
                'fixed left-0 w-64 bg-gray-900 text-white shadow-md flex flex-col transition-all duration-300 h-full',
                {
                    'translate-x-0': sidebarVisible,
                    '-translate-x-full': !sidebarVisible,
                },
            ]"
        >
            <div class="p-6 flex flex-col h-[calc(100vh-2.5rem)]">
                <!-- Toggle button inside sidebar -->
                <div class="flex items-center justify-between mb-4">
                    <span>Navigation</span>
                    <button
                        @click="toggleSidebar"
                        class="p-2 hover:bg-gray-800 rounded-lg transition-colors"
                    >
                        <i
                            :class="`fas fa-chevron-${
                                sidebarVisible ? 'left' : 'right'
                            } w-4 h-4 hover:scale-110 transition-transform`"
                        ></i>
                    </button>
                </div>

                <ul class="space-y-2 flex-grow">
                    <li>
                        <Link
                            :href="route('dashboard')"
                            class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-800 transition duration-200"
                        >
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link
                          :href="route('profile')"
                            class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-800 transition duration-200"
                        >
                            <i class="fas fa-user mr-2"></i> Profile
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="#"
                            class="flex items-center py-2 px-4 rounded-lg hover:bg-gray-800 transition duration-200"
                        >
                            <i class="fas fa-cog mr-2"></i> Settings
                        </Link>
                    </li>
                </ul>

                <!-- User Info and Logout Section -->
                <div class="mt-auto p-6 border-t border-gray-800">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col mr-8">
                            <span class="font-semibold text-lg">{{
                                auth.user.name
                            }}</span>
                            <span class="text-gray-400">{{
                                auth.user.email
                            }}</span>
                        </div>
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            @click.stop="closeDropdown"
                            class="text-red-500 hover:text-red-400 p-2 hover:bg-gray-800 rounded-lg transition-colors"
                        >
                            <i class="fas fa-sign-out-alt"></i>
                        </Link>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Icons when sidebar is hidden -->
        <div
            v-if="auth.user && !sidebarVisible"
            class="fixed left-0 w-16 bg-gray-900 text-white shadow-md transition-all duration-300 h-[calc(100vh-4rem)] flex flex-col"
        >
            <div class="flex-grow">
                <!-- Toggle button in collapsed state -->
                <div class="px-4 py-6">
                    <button
                        @click="toggleSidebar"
                        class="w-8 h-8 p-2 hover:bg-gray-800 rounded-lg transition-colors"
                    >
                        <i
                            :class="`fas fa-chevron-${
                                sidebarVisible ? 'left' : 'right'
                            } w-4 h-4 hover:scale-110 transition-transform`"
                        ></i>
                    </button>
                </div>

                <div class="flex flex-col space-y-6">
                    <Link
                        href="#"
                        class="flex items-center justify-center px-4"
                    >
                        <i
                            class="fas fa-user w-8 h-8 p-2 hover:bg-gray-800 rounded-lg cursor-pointer transition-colors"
                        ></i>
                    </Link>
                    <Link
                        href="#"
                        class="flex items-center justify-center px-4"
                    >
                        <i
                            class="fas fa-cog w-8 h-8 p-2 hover:bg-gray-800 rounded-lg cursor-pointer transition-colors"
                        ></i>
                    </Link>
                    <Link
                        href="#"
                        class="flex items-center justify-center px-4"
                    >
                        <i
                            class="fas fa-tachometer-alt w-8 h-8 p-2 hover:bg-gray-800 rounded-lg cursor-pointer transition-colors"
                        ></i>
                    </Link>
                </div>
            </div>

            <!-- Logout Section -->
            <div class="p-4 border-t border-gray-800">
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    @click.stop="closeDropdown"
                    class="flex items-center justify-center w-full h-full p-2 hover:bg-gray-800 rounded-lg cursor-pointer transition-colors text-red-500 hover:text-red-400"
                >
                    <i class="fas fa-sign-out-alt w-4 h-4"></i>
                </Link>
            </div>
        </div>

        <!-- Main content area -->
        <!-- <main
            :class="[
                'sidebar-content flex-grow p-6 overflow-y-auto transition-all duration-300',
                sidebarVisible ? 'sidebar-expanded' : 'sidebar-collapsed',
            ]"
        >
            <slot />
        </main> -->
        <main
            v-if="auth.user"
            :class="[
                'p-8 mx-auto w-full transition-all duration-300',
                sidebarVisible ? 'ml-64' : 'ml-16',
            ]"
        >
            <slot />
        </main>

        <!-- Show this if the user is not authenticated -->
        <main v-else class="p-6 mx-auto w-full">
            <slot />
        </main>
    </div>
</template>

<style scoped>
/* These styles will only apply to elements with these classes within this component */
.sidebar-content.sidebar-expanded {
    margin-left: 16rem; /* 64px */
}

.sidebar-content.sidebar-collapsed {
    margin-left: 4rem; /* 16px */
}

/* Ensure transitions work properly */
.sidebar-content {
    transition: margin-left 0.3s ease;
}
</style>
