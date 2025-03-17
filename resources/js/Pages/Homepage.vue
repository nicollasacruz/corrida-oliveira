<script setup>
import {ref} from 'vue'
import {defineProps} from 'vue'
import NavLink from "@/Components/NavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ImageHeader from "../../img/crossing-their-own-capabilities2.jpg";

defineProps({events: Array})

const darkMode = ref(true) // 🌙 Iniciar no modo escuro

// Alternar entre tema claro e escuro
const toggleDarkMode = () => {
    darkMode.value = !darkMode.value
}

</script>

<template>

    <AuthenticatedLayout>
        <!-- Main Content -->
        <main class="py-0 w-full">

            <!-- imagem header -->
            <img :src="ImageHeader" alt="caminhada" class="w-screen h-40 md:h-96 object-cover my-0">

            <div class="bg-gray-100 w-screen my-0 pb-8">
                <!-- Título -->
                <h2 class="mt-4 text-xl md:text-4xl font-bold mb-6 mx-4 text-center">Caminhada/Corrida Colorida Noturna de Oliveira</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-[1300px] mx-10 md:mx-auto">
                    <div v-for="event in events" :key="event.id"
                         class="p-6 rounded-lg shadow-md transition transform hover:scale-105 bg-white text-gray-900 ">

                        <h3 class="text-xl font-bold mb-2">{{ event.name }}</h3>
                        <p class="text-md font-bold">📍 {{ event.location }}</p>
                        <p class="text-md">📅 {{ event.endDate }}</p>
                        <p class="text-md">💶 {{ event.subscriptionFee }} €</p>

<!--                        <a :href="`/event/${event.id}`"-->
                        <a :href="route('event.show', {id: event.id})"
                           class="mt-4 inline-block text-lg font-semibold py-1 px-4 rounded-lg transition bg-cyan-600 text-white hover:bg-cyan-700 dark:bg-gray-400 dark:text-black dark:hover:bg-gray-500">
                            Inscrição
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </AuthenticatedLayout>
</template>
