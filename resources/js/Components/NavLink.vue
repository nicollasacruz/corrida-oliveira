<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'font-extrabold inline-flex items-center px-1 pt-1 border-b-2 border-gray-200 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-blue-500 transition duration-150 ease-in-out no-wrap'
        : 'font-extrabold inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-700 hover:text-gray-900 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out no-wrap',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
