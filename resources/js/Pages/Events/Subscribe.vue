<script setup>
import {ref} from 'vue'
import {Head, router, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { CheckIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    event: Object,
});
const event = ref(props.event);
const open = ref(false)

const darkMode = ref(false)

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
    form.post(route('event.subscribe', {id: event.value.id}), {
        onSuccess: () => {
            form.reset();
            open.value = true;
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
    <AuthenticatedLayout>
        <Head title="Inscrição da Corrida"/>

        <div class="max-w-7xl mx-auto">
            <div class=" w-full p-6 rounded-lg shadow-lg transition bg-white dark:bg-gray-800">
                <h1 class="text-3xl font-bold mb-4">{{ event.name }}</h1>
                <p class="mb-4">{{ event.description }}</p>
                <p v-if="event.name.toString().includes('Corrida')" class="mb-4 font-extrabold">OBRIGATÓRIO UTILIZAR DORSAL E LANTERNA. (Responsabilidade do corredor)</p>

                <p class="font-semibold mb-2">📍 Location: {{ event.location }}</p>
                <p class="font-semibold mb-4">📅 Date: {{ event.runnerDate }}</p>

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


            <div>
                <TransitionRoot as="template" :show="open">
                    <Dialog class="relative z-10" @close="open = false">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                    <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                        <div>
                                            <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-green-100">
                                                <CheckIcon class="size-6 text-green-600" aria-hidden="true" />
                                            </div>
                                            <div class="mt-3 text-center sm:mt-5">
                                                <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Inscrição enviada com sucesso!</DialogTitle>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-500">Obrigado por se inscrever no evento.</p>
                                                    <p class="text-sm text-gray-500">Você receberá um e-mail de confirmação em breve. Caso não receba, não se preocupe, pois sua inscrição está concluida.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 sm:mt-6">
                                            <button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="open = false">Voltar a tela inicial</button>
                                        </div>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
