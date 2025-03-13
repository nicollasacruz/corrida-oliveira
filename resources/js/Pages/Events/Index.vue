<script setup>
  import Layout from '@/Layouts/GuestLayout'
  import { Head } from '@inertiajs/vue3'

  defineProps({
    events: {
      type: Array,
    }
  })
</script>

<template>
  <Layout>
    <Head title="Index" />

  </Layout>
</template>
