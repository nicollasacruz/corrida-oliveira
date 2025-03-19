<script setup>
import {ref} from 'vue';
import {defineProps} from 'vue';
import NavLink from "@/Components/NavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ImageHeader from "../../img/crossing-their-own-capabilities2.jpg";
import {useMotion} from '@vueuse/motion';
import {Sun, Moon, MapPin, Calendar, Euro} from 'lucide-vue-next';
import {Head} from "@inertiajs/vue3";

defineProps({events: Array});

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
        <Head title="Inscrições" />

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <div v-for="event in events" :key="event.id"
                     class="overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 shadow-md"
                >
                    <img :src="event.image" :alt="event.name"
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
    </AuthenticatedLayout>
</template>
