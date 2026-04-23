<script setup>
import { computed, defineProps, onBeforeUnmount, watch, ref } from 'vue';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {MapPin, Calendar, Footprints} from 'lucide-vue-next';
import { Link, usePage } from "@inertiajs/vue3";

defineProps({events: Array});

const page = usePage();
const flash = computed(() => page.props.flash ?? {});
const toastMessage = ref('');
const toastType = ref('success');
const showToast = ref(false);
let toastTimeout;

const triggerToast = (message, type = 'success') => {
    if (!message) {
        return;
    }

    toastMessage.value = message;
    toastType.value = type;
    showToast.value = true;

    if (toastTimeout) {
        clearTimeout(toastTimeout);
    }

    toastTimeout = window.setTimeout(() => {
        showToast.value = false;
    }, 4000);
};

watch(
    flash,
    (value) => {
        if (value.success) {
            triggerToast(value.success, 'success');
            return;
        }

        if (value.error) {
            triggerToast(value.error, 'error');
        }
    },
    { immediate: true, deep: true }
);

onBeforeUnmount(() => {
    if (toastTimeout) {
        clearTimeout(toastTimeout);
    }
});

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
            <transition
                enter-active-class="transform ease-out duration-300 transition"
                enter-from-class="translate-y-2 opacity-0"
                enter-to-class="translate-y-0 opacity-100"
                leave-active-class="transition ease-in duration-200"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-if="showToast"
                    :class="toastType === 'success' ? 'bg-green-600' : 'bg-red-600'"
                    class="fixed right-4 top-4 z-50 rounded-lg px-4 py-3 text-sm font-semibold text-white shadow-lg"
                >
                    {{ toastMessage }}
                </div>
            </transition>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <div v-for="event in events" :key="event.id"
                     class="overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 shadow-md">
                    <div v-if="event.image" class="overflow-hidden">
                        <img :src="event.image" :alt="event.name"
                             class="w-full h-48 object-cover transition-transform duration-500 hover:scale-110"/>
                    </div>
                    <div v-else
                         class="flex h-48 items-center justify-center bg-gray-200 text-sm font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-300">
                        Sem imagem na homepage
                    </div>
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
                        <Link :href="route('event.show', { id: event.id })"
                           class="mt-4 inline-block w-full text-center py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition">
                            Inscrição
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
