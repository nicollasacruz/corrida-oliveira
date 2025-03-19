<script setup>
  import Layout from '@/Layouts/AuthenticatedLayout.vue'
  import { Head } from '@inertiajs/vue3'

  defineProps({})
</script>

<template>
  <Layout>
    <Head title="Nosso Evento" />


      <div class="max-w-7xl mx-auto">
          <p class="text-lg leading-relaxed">
              A Associação de Pais de Oliveira e seus patrocinadores têm o prazer de convidar todos a participarem da 2ª Caminhada Colorida Noturna de Oliveira, um evento que promete muita diversão, cor e animação! Nesta segunda edição, trazemos uma novidade imperdível: além da tradicional caminhada, teremos também uma corrida para quem quer mais adrenalina!
          </p>
          <br>
          <p><strong>📅 Data:</strong> 24/05/2025</p>
          <p><strong>📍 Local:</strong> Partida Adro da Igreja de Oliveira</p>
          <p><strong>🕗 Hora:</strong> 20h</p>
          <br>
          <p class="text-lg font-semibold">O que esperar deste evento:</p>
          <ul class="list-disc pl-5 space-y-2">
              <li>Caminhada Colorida: cheia de cor, luz e alegria! Um evento para todas as idades!</li>
              <li>Corrida Colorida: Para os mais energéticos, uma corrida cheia de emoção e espírito competitivo.</li>
              <li>Animação e Festa: Após a caminhada e corrida, a diversão continua com música, animação e comidas para todos.</li>
          </ul>
          <br>
          <p class="text-lg font-semibold">Inscreva-se agora e garanta o seu lugar neste evento repleto de energia e cor!</p>
          <br><br>
          <p class="font-semibold">💶 Pagamento e levantamento de Kits:</p>
          <p>📆 Dias 22 e 23 de Maio na Junta de Freguesia de Oliveira das 21h às 22.30h.</p>
      </div>


  </Layout>
</template>
