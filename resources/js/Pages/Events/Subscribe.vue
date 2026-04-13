<script setup>
import {computed, ref, watch} from 'vue'
import {Head, useForm, usePage} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    event: Object,
});
const event = ref(props.event);
const page = usePage();
const toastMessage = ref('');
const toastType = ref('success');
const showToast = ref(false);
let toastTimeout;

const darkMode = ref(false)
const flash = computed(() => page.props.flash ?? {});

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
            form.reset();
            return;
        }

        if (value.error) {
            triggerToast(value.error, 'error');
        }
    },
    { immediate: true, deep: true }
);

const form = useForm({
    fullName: '',
    email: '',
    phone: '',
    responsibleName: '',
    dateBorn: '',
    sizeTshirt: '',
})

const submit = () => {
    form.post(route('event.subscribe', {id: event.value.id}), {
        onError: (errors) => {
            console.error("Erro ao enviar formulário:", errors);
        },
        preserveScroll: true,
    });
}

const toggleDarkMode = () => {
    darkMode.value = !darkMode.value
}
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Inscrição da Corrida"/>

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

            <div class=" w-full p-6 rounded-lg shadow-lg transition bg-white dark:bg-gray-800">
                <h1 class="text-3xl font-bold mb-4">{{ event.name }}</h1>
                <p class="mb-4">{{ event.description }}</p>
                <p v-if="event.name.toString().includes('Corrida')" class="mb-4 font-extrabold">OBRIGATÓRIO UTILIZAR DORSAL E LANTERNA. (Responsabilidade do corredor)</p>

                <p class="font-semibold mb-2">📍 Local: {{ event.location }}</p>
                <p class="font-semibold mb-4">📅 Data: {{ new Date(event.runnerDate).toLocaleDateString() }}</p>

                <h2 class="text-xl font-semibold mb-6">📝 Inscrição</h2>

                <form @submit.prevent="submit" class="space-y-4">
                    <label class="block font-semibold">Nome Completo:</label>
                    <input v-model="form.fullName"
                           type="text"
                           placeholder="Nome Completo"
                           class="w-full px-4 py-3 rounded-lg focus:outline-none transition bg-gray-100 border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           required/>

                    <label class="block font-semibold">Email:</label>
                    <input v-model="form.email"
                           type="email"
                           placeholder="Email"
                           class="w-full px-4 py-3 rounded-lg focus:outline-none transition bg-gray-100 border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }"
                           required/>

                    <label v-if="event.isChildEvent" class="block font-semibold">Nome do Responsável:</label>
                    <input v-if="event.isChildEvent"
                           v-model="form.responsibleName"
                           type="text"
                           placeholder="Nome do Responsável"
                           class="w-full px-4 py-3 rounded-lg focus:outline-none transition bg-gray-100 border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }"
                           required/>

                    <label class="block font-semibold">Contacto:</label>
                    <input v-model="form.phone"
                           type="tel"
                           placeholder="Contacto"
                           class="w-full px-4 py-3 rounded-lg focus:outline-none transition bg-gray-100 border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           required/>

                    <label class="block font-semibold">Data de Nascimento:</label>
                    <input v-model="form.dateBorn"
                           type="date"
                           placeholder="Data de Nascimento"
                           class="w-full px-4 py-3 rounded-lg focus:outline-none transition bg-gray-100 border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           required/>

                    <label class="block font-semibold">👕 Tamanho da T-Shirt</label>
                    <span class="block text-sm mb-2">A escolha não garante o recebimento do tamanho exato selecionado, pois está sujeita à disponibilidade.</span>
                    <select v-model="form.sizeTshirt"
                            class="w-full px-4 py-3 rounded-lg focus:outline-none transition bg-gray-100 border-gray-300 text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    >
                        <option value="" disabled>Select a size</option>
                        <option v-if="!event.isChildEvent" value="S">S</option>
                        <option v-if="!event.isChildEvent" value="M">M</option>
                        <option v-if="!event.isChildEvent" value="L">L</option>
                        <option v-if="!event.isChildEvent" value="XL">XL</option>
                        <option v-if="!event.isChildEvent" value="XXL">XXL</option>
                        <option v-if="event.isChildEvent" value="6-8">6-8</option>
                        <option v-if="event.isChildEvent" value="8-10">8-10</option>
                    </select>

                    <button type="submit"
                            class="w-full py-3 rounded-lg font-bold transition bg-blue-600 text-white hover:bg-blue-700 dark:bg-yellow-400 dark:text-black dark:hover:bg-yellow-500">
                        ✅ Enviar Inscrição
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
