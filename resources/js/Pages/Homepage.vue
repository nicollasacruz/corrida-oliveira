<script setup>
import { ref } from 'vue';
import { defineProps } from 'vue';
import NavLink from "@/Components/NavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ImageHeader from "../../img/crossing-their-own-capabilities2.jpg";
import { useMotion } from '@vueuse/motion';
import { Sun, Moon, MapPin, Calendar, Euro } from 'lucide-vue-next';

defineProps({ events: Array });

const darkMode = ref(false);

const toggleDarkMode = () => {
    darkMode.value = !darkMode.value;
    if (darkMode.value) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <div :class="{'dark': darkMode}" class="min-h-screen">
            <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-500">
                <header class="relative h-[40vh] md:h-[50vh] overflow-hidden">
                    <img
                        :src="ImageHeader"
                        alt="Caminhada noturna com luzes coloridas"
                        class="w-full h-full object-cover object-center filter brightness-[0.65] dark:brightness-50"
                    />

                    <div class="absolute top-4 right-4 z-20">
                        <button @click="toggleDarkMode"
                                class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                            <component :is="darkMode ? Sun : Moon" class="w-5 h-5 text-gray-800 dark:text-white"/>
                        </button>
                    </div>

                    <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 md:px-6">
                        <h1
                            class="text-3xl md:text-5xl lg:text-6xl font-display font-bold text-white max-w-4xl leading-tight tracking-tight shadow-sm"
                        >
                            Caminhada & Corrida Colorida Noturna de Oliveira
                        </h1>
                    </div>
                </header>

                <main class="container px-4 md:px-6 py-12 md:py-16">
                    <div class="max-w-7xl mx-auto">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                            <div v-for="event in events" :key="event.id"
                                 class="overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 shadow-md"
                            >
                                <img src="https://i.imgur.com/qghad5V.jpeg" :alt="event.name"
                                     class="w-full h-48 object-cover transition-transform duration-500 hover:scale-110"/>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ event.name }}</h3>
                                    <div class="space-y-2 mt-4">
                                        <p class="flex items-center text-gray-700 dark:text-gray-300">
                                            <MapPin class="w-4 h-4 mr-2"/>
                                            {{ event.location }}
                                        </p>
                                        <p class="flex items-center text-gray-700 dark:text-gray-300">
                                            <Calendar class="w-4 h-4 mr-2"/>
                                            {{ event.endDate }}
                                        </p>
                                        <p class="flex items-center text-gray-700 dark:text-gray-300">
                                            <Euro class="w-4 h-4 mr-2"/>
                                            {{ event.subscriptionFee }}
                                        </p>
                                    </div>
                                    <a :href="route('event.show', { id: event.id })"
                                       class="mt-4 inline-block w-full text-center py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition">Inscrição</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
