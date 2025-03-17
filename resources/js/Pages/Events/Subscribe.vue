<script setup>
import {ref} from 'vue'
import {router, useForm} from '@inertiajs/vue3'

const props = defineProps({
    event: Object,
});
const event = ref(props.event);

const darkMode = ref(true)

const form = useForm({
    fullName: '',
    email: '',
    phone: '',
    responsibleName: '',
    dateBorn: '',
    sizeTshirt: '',
})

const submit = () => {
    console.log(event.id)
    console.log(form, "form")
    form.post(route('event.subscribe', { id: event.value.id }), {
        onSuccess: () => {
            form.reset();
            router.visit(route('home'));
        },
        onError: (errors) => {
            console.error("Erro ao enviar formulário:", errors);
        },
    });
}

const toggleDarkMode = () => {
    darkMode.value = !darkMode.value
}
</script>

<template>
    <div :class="{ 'bg-gray-900 text-white': darkMode, 'bg-gray-100 text-gray-900': !darkMode }"
         class="min-h-screen flex flex-col justify-center items-center p-6 transition-colors duration-300">

        <!-- Botão de alternância de tema -->
        <button @click="toggleDarkMode"
                class="absolute top-4 right-4 px-4 py-2 rounded-md font-semibold transition"
                :class="{ 'bg-yellow-400 text-black': darkMode, 'bg-gray-800 text-white': !darkMode }">
            {{ darkMode ? '☀️ Light Mode' : '🌙 Dark Mode' }}
        </button>

        <div class="max-w-2xl w-full p-6 rounded-lg shadow-lg transition"
             :class="{ 'bg-gray-800': darkMode, 'bg-white': !darkMode }">

            <h1 class="text-3xl font-bold mb-4">{{ event.name }}</h1>
            <p class="mb-4">{{ event.description }}</p>
            <p class="font-semibold mb-2">📍 Location: {{ event.location }}</p>
            <p class="font-semibold mb-4">📅 Date: {{ event.startDate }}</p>

            <h2 class="text-xl font-semibold mb-6">📝 Inscrição</h2>

            <form @submit.prevent="submit" class="space-y-4">
                <label class="block font-semibold">Nome Completo:</label>
                <input v-model="form.fullName"
                       type="text"
                       placeholder="Nome Completo"
                       class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
                       :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }"
                       required/>

                <label class="block font-semibold">Email:</label>
                <input v-model="form.email"
                       type="email"
                       placeholder="Email"
                       class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
                       :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }"
                       required/>

                <label v-if="event.isChildEvent" class="block font-semibold">Nome do Responsável:</label>
                <input v-if="event.isChildEvent"
                       v-model="form.responsibleName"
                       type="text"
                       placeholder="Nome do Responsável"
                       class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
                       :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }"
                       required/>

                <label class="block font-semibold">Contacto:</label>
                <input v-model="form.phone"
                       type="tel"
                       placeholder="Contacto"
                       class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
                       :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }"
                       required/>

                <label class="block font-semibold">Data de Nascimento:</label>
                <input v-model="form.dateBorn"
                       type="date"
                       class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
                       :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }"
                       required/>

                <label class="block font-semibold">👕 T-shirt Size</label>
                <select v-model="form.sizeTshirt"
                        class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
                        :class="{ 'bg-gray-700 text-white border-gray-600': darkMode, 'bg-gray-100 border-gray-300 text-gray-900': !darkMode }">
                    <option value="" disabled>Select a size</option>
                    <option v-if="!event.isChildEvent" value="S">S</option>
                    <option v-if="!event.isChildEvent" value="M">M</option>
                    <option v-if="!event.isChildEvent" value="L">L</option>
                    <option v-if="!event.isChildEvent" value="XL">XL</option>
                    <option v-if="!event.isChildEvent" value="2XL">2XL</option>
                    <option v-if="event.isChildEvent" value="6-8">6-8</option>
                    <option v-if="event.isChildEvent" value="8-10">8-10</option>
                </select>

                <button type="submit"
                        class="w-full py-3 rounded-lg font-bold transition"
                        :class="{ 'bg-yellow-400 text-black hover:bg-yellow-500': darkMode, 'bg-blue-600 text-white hover:bg-blue-700': !darkMode }">
                    ✅ Submit Registration
                </button>
            </form>
        </div>
    </div>
</template>
