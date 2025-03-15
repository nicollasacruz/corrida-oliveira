<script setup>
import {ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link, usePage} from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const user = usePage().props.auth.user;
const darkMode = ref(false);

</script>

<template>
    <div>
        <div class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white min-h-screen flex flex-col items-center transition-colors duration-300">
            <!-- Navbar -->
            <nav class="my-2 md:my-6 md:py-2 max-w-screen-lg border-b border-gray-100 md:bg-cyan-500 dark:bg-gray-800 w-full md:rounded-lg">
                <div class="mx-auto max-w-7xl px-4 sm:px-4 lg:px-8">
                    <div class="flex h-24 md:h-20 justify-between items-center">
                        <div class="flex">
                            <div class="flex shrink-0 items-center w-full">
                                <NavLink :href="route('home')">
                                    <ApplicationLogo
                                        class="block h-24 md:h-16 w-auto fill-current text-gray-800 dark:text-white rounded-md"/>
                                </NavLink>
                            </div>
                            <div class="hidden space-x-8 sm:flex sm:ml-10">
                                <NavLink :href="route('home')" :active="route().current('home')">INSCRIÇÕES</NavLink>
                                <NavLink :href="route('home')" :active="route().current('home')">APO</NavLink>
                                <NavLink v-if="user" :href="route('dashboard')" :active="route().current('dashboard')">
                                    ADMIN
                                </NavLink>
                                <NavLink v-else :href="route('login')" :active="route().current('login')">Admin
                                </NavLink>
                            </div>
                        </div>

                        <div v-if="user"
                             class="hidden sm:flex sm:items-center">
                            <div class="relative ml-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button class="px-3 py-2 text-gray-500 dark:text-white">{{ user.name }}</button>
                                    </template>
                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger Menu -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="p-2 text-gray-400 dark:text-white focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path v-if="!showingNavigationDropdown" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                    <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div v-show="showingNavigationDropdown" class="sm:hidden">
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink :href="route('home')">Inscrição</ResponsiveNavLink>
                        <ResponsiveNavLink href="/about">About</ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('home')">Admin</ResponsiveNavLink>
                    </div>
                </div>
            </nav>
            <main>
                <slot/>
            </main>

        </div>
    </div>
</template>
