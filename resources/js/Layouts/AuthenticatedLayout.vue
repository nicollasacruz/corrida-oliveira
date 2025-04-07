<script setup>
import {onMounted, ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link, usePage} from '@inertiajs/vue3';
import ImageHeader from "../../img/crossing-their-own-capabilities2.jpg";
import LogoAlexandre from "../../img/alexandre.jpeg";
import LogoIpon from "../../img/ipon.jpeg";
import LogoNuwave from "../../img/nuwave.jpeg";
import LogoOliveira from "../../img/oliveira.jpeg";
import LogoDoceBiscoito from "../../img/docebiscoito.jpeg";
import LogoMariaConc from "../../img/mariadaconceicao.jpeg";
import LogoNunoBogas from "../../img/nunobogas.jpeg";
import LogoTerra from "../../img/terra.jpeg";
import LogoLimbo from "../../img/LimboTech.jpeg";
import LogoCeramicaNormand from "../../img/CeramicaNormand.jpeg";
import LogoCeramicaJM from "../../img/CeramicaJM.jpeg";
import LogoEstrelaDeAnis from "../../img/EstrelaDeAnis.jpeg";
import LogoJcoAuto from "../../img/JcoAuto.jpeg";
import LogoTalhoDasAldeias from "../../img/TalhoDasAldeias.jpeg";
import LogoCeramicaDaArieira from "../../img/CERAMICA DA ARIEIRA.jpeg";
import LogoHenriqueCoelho from "../../img/Henrique Coelho.jpeg";
import LogoPedroBike from "../../img/PEDROBIKEARTE.jpeg";
import LogoDivisoTetos from "../../img/divisotetos.png";
import LogoUcha from "../../img/uchaSupermercado.jpeg";
import LogoDreamSakos from "../../img/dreamsakos.jpeg";
import LogoMarilyn from "../../img/marylin.png";
import LogoDuo from "../../img/duo.jpeg";
import LogoExtraValue from "../../img/extravalue.jpeg";
import LogoBagoeira from "../../img/bagoeira.jpeg";
import LogoPiloto from "../../img/piloto.jpeg";
import LogoHulp from "../../img/hulp.jpeg";
import LogoValentri from "../../img/valentri.jpeg";
import LogoRosa from "../../img/logo-rose.jpeg";
import BannerValentri from "../../img/valentri.jpg";
import BannerHurb from "../../img/hurb.jpg";


import {Calendar, Euro, MapPin, Moon, Sun} from "lucide-vue-next";
import {isMotionInstance} from "@vueuse/motion";

const showingNavigationDropdown = ref(false);
const user = usePage().props.auth.user;
const darkMode = ref(false);

const consentGiven = ref(localStorage.getItem('cookieConsent') === 'true')
const consentDenied = ref(localStorage.getItem('cookieConsent') === 'false')

const giveConsent = () => {
    localStorage.setItem('cookieConsent', 'true')
    consentGiven.value = true
    window.dataLayer = window.dataLayer || []
    window.dataLayer.push({event: 'cookieConsentGiven'})
    gtag('consent', 'update', {
        'ad_storage': 'granted',
        'analytics_storage': 'granted',
        'ad_user_data': 'granted',
        'ad_personalization': 'granted'
    })
}
const denyConsent = () => {
    localStorage.setItem('cookieConsent', 'false')
    consentDenied.value = true
    consentGiven.value = false
    window.dataLayer = window.dataLayer || []
    window.dataLayer.push({event: 'cookieConsentDenied'})
    gtag('consent', 'update', {
        'ad_storage': 'denied',
        'analytics_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied'
    })
}

onMounted(() => {
    window.dataLayer = window.dataLayer || []
    window.dataLayer.push({
        'event': 'defaultConsent',
        'analytics_storage': 'denied',
        'ad_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied'
    })
})

const carouselImages = [
    ImageHeader,
    BannerValentri,
    ImageHeader,
    BannerHurb
]

const currentImageIndex = ref(0)

const nextImage = () => {
    currentImageIndex.value = (currentImageIndex.value + 1) % carouselImages.length
    console.log(currentImageIndex.value)
}

onMounted(() => {
    setInterval(nextImage, 3000)
})

const logos = [
    { src: LogoOliveira, alt: "Logo Freguesia de Oliveira" },
    { src: LogoLimbo, alt: "Logo Limbo Tech" },
    { src: LogoDreamSakos, alt: "Logo DreamSakos" },
    { src: LogoPiloto, alt: "Logo Piloto Automóveis" },
    { src: LogoIpon, alt: "Logo Ginásio Ipon" },
    { src: LogoNuwave, alt: "Logo empresa NuWave" },
    { src: LogoNunoBogas, alt: "Logo Nuno Bogas" },
    { src: LogoDoceBiscoito, alt: "Logo Doce Biscoito" },
    { src: LogoDivisoTetos, alt: "Logo empresa Divisotetos" },
    { src: LogoEstrelaDeAnis, alt: "Logo Estrela de Anis" },
    { src: LogoCeramicaDaArieira, alt: "Logo Ceramica da Arieira" },
    { src: LogoMarilyn, alt: "Logo Marilyb" },
    { src: LogoDuo, alt: "Logo Duo" },
    { src: LogoUcha, alt: "Logo Ucha Supermercados" },
    { src: LogoBagoeira, alt: "Logo Bagoeira" },
    { src: LogoCeramicaNormand, alt: "Logo Ceramica Normand" },
    { src: LogoJcoAuto, alt: "Logo Jco Auto" },
    { src: LogoTerra, alt: "Logo Terra" },
    { src: LogoHenriqueCoelho, alt: "Logo Henrique" },
    { src: LogoAlexandre, alt: "Logo Alexandre" },
    { src: LogoHulp, alt: "Logo Hulp" },
    { src: LogoValentri, alt: "Logo Valentri" },
    { src: LogoRosa, alt: "Logo Rosa" },
    { src: LogoExtraValue, alt: "Logo empresa ExtraValue" },
    { src: LogoMariaConc, alt: "Logo Maria da Conceição" },
    { src: LogoPedroBike, alt: "Logo Pedro Bike Art" },
    { src: LogoCeramicaJM, alt: "Logo Ceramica JM" },
    { src: LogoTalhoDasAldeias, alt: "Logo Talho das Aldeias" }
];


</script>

<template>
    <div v-if="!consentGiven" class="fixed bottom-0 left-0 right-0 bg-gray-800 text-white p-4 text-center z-50">
        <p>Este site utiliza cookies para melhorar a experiência do usuário. Ao continuar navegando, você concorda com o
            uso de cookies.</p>
        <button @click="giveConsent" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Aceitar</button>
        <button @click="denyConsent" class="bg-red-500 text-white px-4 py-2 rounded mt-2">Recusar</button>

    </div>
    <div class="max-w-full">
        <div
            class="bg-white text-gray-900 dark:bg-gray-900 dark:text-white min-h-screen flex flex-col items-center transition-colors duration-300">
            <!-- Navbar -->
            <nav
                class="my-2 md:my-6 md:py-2 max-w-screen-lg border-b border-gray-100 md:bg-cyan-500 dark:bg-gray-800 w-full md:rounded-lg">
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
                                <NavLink :href="route('about')" :active="route().current('about')">NOSSO EVENTO
                                </NavLink>
                                <!--                                <NavLink :href="route('home')" :active="route().current('home')">APO</NavLink>-->
                                <NavLink href="/admin" :active="route().current('filament.admin.pages.dashboard')">
                                    ADMIN
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
                        <ResponsiveNavLink href="/about">Nosso Evento</ResponsiveNavLink>
                        <ResponsiveNavLink href="/admin">Admin</ResponsiveNavLink>
                    </div>
                </div>
            </nav>
            <div :class="{'dark': darkMode}" class="min-h-screen">
                <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-500">
                    <header class="relative h-[150px] md:h-[55vh] overflow-hidden">
                        <div class="w-full h-full relative overflow-hidden">
                            <transition-group name="fade" tag="div" class="w-full h-full">
                                <img
                                    v-for="(img, index) in carouselImages"
                                    v-show="currentImageIndex === index"
                                    :key="index"
                                    :src="img"
                                    class="absolute inset-0 w-full h-full object-cover object-center filter brightness-[0.65] dark:brightness-50 transition-opacity duration-1000"
                                    alt="Banner do evento"
                                />
                            </transition-group>
                        </div>


                        <div class="absolute top-4 right-4 z-20">
                            <button @click="toggleDarkMode"
                                    class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                                <component :is="darkMode ? Sun : Moon" class="w-5 h-5 text-gray-800 dark:text-white"/>
                            </button>
                        </div>

                        <div v-show="currentImageIndex === 0 || currentImageIndex === 2"
                             class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 md:px-6">
                            <h1
                                class="text-3xl md:text-5xl lg:text-6xl font-display font-bold text-white max-w-4xl leading-tight tracking-tight shadow-sm"
                            >
                                Caminhada & Corrida Colorida Noturna de Oliveira
                            </h1>
                        </div>
                    </header>

                    <main class="container px-4 md:px-6 py-12 md:py-16">
                        <slot/>
                    </main>
                </div>
            </div>

        </div>
        <footer class="w-full bg-gray-700 text-white">
            <!-- Seção dos patrocinadores -->
            <div class="py-2 text-center">
                <span class="block text-2xl font-bold">
                    Patrocinadores
                </span>

                <!--                <div class="relative w-full overflow-hidden py-6">-->
                <!--                    <div class="flex gap-x-8 animate-scroll whitespace-nowrap w-max">-->
                <!--                        &lt;!&ndash; Logos (repetidos para looping) &ndash;&gt;-->
                <!--                        <template v-for="i in 2" :key="i">-->
                <!--                            <img :src="LogoOliveira" alt="Logo Freguesia de Oliveira" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoLimbo" alt="Logo Limbo Tech" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoIpon" alt="Logo Ginásio Ipon" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoNuwave" alt="Logo empresa NuWave" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoAlexandre" alt="Logo Alexandre" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoDoceBiscoito" alt="Logo Doce Biscoito" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoNunoBogas" alt="Logo Nuno Bogas" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoCeramicaJM" alt="Logo Ceramica" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoCeramicaNormand" alt="Logo Ceramica Normand" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoEstrelaDeAnis" alt="Logo Estrela de Anis" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoJcoAuto" alt="Logo Jco Auto" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoTalhoDasAldeias" alt="Logo Talho das Aldeias" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoTerra" alt="Logo Terra" class="h-14 flex-shrink-0"/>-->
                <!--                            <img :src="LogoMariaConc" alt="Logo Maria da Conceição" class="h-14 flex-shrink-0"/>-->
                <!--                        </template>-->
                <!--                    </div>-->
                <!--                </div>-->

                <div class="relative overflow-hidden px-4 pt-4 max-w-full md:max-w-[1000px] md:mx-auto">
                    <div class="flex gap-4 flex-nowrap md:flex-wrap md:justify-center animate-scroll pause-on-hover md:animate-none w-max md:w-full">
                        <!-- Logos originais -->
                        <template v-for="(logo, index) in logos" :key="`logo-${index}`">
                            <img :src="logo.src" :alt="logo.alt" class="h-14 flex-shrink-0" />
                        </template>

                        <!-- Duplicação para loop -->
                        <template class="" v-for="(logo, index) in logos" :key="`logo-duplicate-${index}`">
                            <img :src="logo.src" :alt="logo.alt" class="h-14 flex-shrink-0 md:hidden" />
                        </template>

                    </div>
                </div>
            </div>

            <!-- Rodapé Final -->
            <div class="py-4 px-4 text-center text-xs">
                <p>Desenvolvido por
                    <a href="https://wa.me/351910607636" target="_blank"
                       class="font-bold text-blue-400 hover:text-blue-300">
                        Nicollas Cruz - Limbo Tecnologia
                    </a>
                </p>
                <p>&copy; 2025 - Caminhada & Corrida Colorida Noturna de Oliveira</p>
            </div>
        </footer>
    </div>
</template>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;

.fade-enter-active, .fade-leave-active {
    transition: opacity 1s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
@layer utilities {
    .pause-on-hover:hover {
        animation-play-state: paused;
    }
}
</style>
