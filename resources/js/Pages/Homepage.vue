<script setup>
import { ref } from 'vue'
import { defineProps } from 'vue'
import NavLink from "@/Components/NavLink.vue";

defineProps({ events: Array })

const darkMode = ref(true) // 🌙 Iniciar no modo escuro

// Alternar entre tema claro e escuro
const toggleDarkMode = () => {
    darkMode.value = !darkMode.value
}
</script>

<template>
    <div :class="{ 'bg-gray-900 text-white': darkMode, 'bg-gray-50 text-gray-900': !darkMode }"
         class="min-h-screen flex flex-col items-center transition-colors duration-300">

        <!-- Header -->
        <header class="w-full py-4 shadow-md"
                :class="{ 'bg-gray-800': darkMode, 'bg-blue-600': !darkMode }">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
                <h1 class="text-3xl font-bold">🏃 Corrida APO</h1>
                <nav class="text-lg">
                    <a href="/" class="px-4 py-2 ">🏠 Home</a>
<!--                    <NavLink :href="route('home')" :active="route('home')" class="px-4 py-2 ">🏠 Home</NavLink>-->
                    <a href="/about" class="px-4 py-2 ">ℹ️ About</a>
                    <a href="/login" class="px-4 py-2 ">🔐 Admin</a>
                </nav>
                <button @click="toggleDarkMode"
                        class="px-4 py-2 rounded-lg text-lg font-semibold transition"
                        :class="{ 'bg-yellow-400 text-black': darkMode, 'bg-gray-800 text-white': !darkMode }">
                    {{ darkMode ? '☀️ Light Mode' : '🌙 Dark Mode' }}
                </button>
            </div>
        </header>

        <!-- Main Content -->
        <main class="py-12 px-6 w-full">
            <h2 class="text-4xl font-bold mb-6 text-center">🏁 Upcoming Races</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                <div v-for="event in events" :key="event.id"
                     class="p-6 rounded-lg shadow-md transition transform hover:scale-105"
                     :class="{ 'bg-gray-800 text-white': darkMode, 'bg-white text-gray-900': !darkMode }">

                    <h3 class="text-2xl font-bold mb-2">{{ event.name }}</h3>
                    <p class="text-lg">📍 {{ event.location }}</p>
                    <p class="text-lg">📅 {{ event.startDate }}</p>

                    <a :href="`/event/${event.id}`"
                       class="mt-4 inline-block text-lg font-semibold py-3 px-6 rounded-lg transition"
                       :class="{ 'bg-blue-500 text-white hover:bg-blue-700': !darkMode, 'bg-yellow-400 text-black hover:bg-yellow-500': darkMode }">
                        ✅ Register Now
                    </a>
                </div>
            </div>
        </main>
    </div>
</template>
