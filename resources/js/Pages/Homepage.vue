<script setup>
import {ref, onMounted, defineProps} from 'vue';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {MapPin, Calendar, Footprints} from 'lucide-vue-next';
import {usePage} from "@inertiajs/vue3";

defineProps({events: Array});

const page = usePage();
const errors = ref([]);
const flashError = page.props.flash?.error;
const showErrorModal = ref(false);

console.log(page.props.errors, 'page.props.errors');
console.log(flashError, 'flashError');

onMounted(() => {
    const validationErrors = Object.values(page.props.errors || {});
    if (validationErrors.length > 0) {
        errors.value = validationErrors.flat();
        showErrorModal.value = true;
    }

    if (flashError) {
        errors.value = [flashError]; // erro vindo de `with('error')`
        showErrorModal.value = true;
    }
});


const closeModal = () => {
    showErrorModal.value = false;
    errors.value = [];
};

const darkMode = ref(false);
const toggleDarkMode = () => {
    darkMode.value = !darkMode.value;
    document.documentElement.classList.toggle('dark', darkMode.value);
};

const toCurrency = (value) => {
    return new Intl.NumberFormat('pt-PT', {
        style: 'currency',
        currency: 'EUR'
    }).format(value);
};
</script>


<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <div v-for="event in events" :key="event.id"
                     class="overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 shadow-md">
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
                                {{ new Date(event.runnerDate).toLocaleDateString() }}
                            </p>
                            <p class="flex items-center text-gray-700 dark:text-gray-300">
                                <Footprints class="w-4 h-4 mr-2"/>
                                {{ event.subscriptionFee.toString() }} passos
                            </p>
                        </div>
                        <a :href="route('event.show', { id: event.id })"
                           class="mt-4 inline-block w-full text-center py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition">
                            Inscrição
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Erros -->
        <div v-if="showErrorModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="relative bg-white dark:bg-gray-900 rounded-lg shadow-lg max-w-md w-full p-6">
                <!-- Botão de Fechar -->
                <button @click="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>

                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Erro</h2>
                <ul class="space-y-2">
                    <li v-for="(error, index) in errors" :key="index" class="text-red-600 dark:text-red-400">
                        {{ error }}
                    </li>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

