<script setup>
  import GuestLayout from '@/Layouts/GuestLayout'
  import { Head } from '@inertiajs/vue3'

  defineProps({
    events: {
      type: Array,
    }
  })
</script>

<template>
  <GuestLayout>
    <Head title="Index" />

  </GuestLayout>
</template>
