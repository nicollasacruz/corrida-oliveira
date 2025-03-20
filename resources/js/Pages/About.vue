<script setup>
import Layout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({})
</script>

<template>
    <Layout>
        <Head title="Sobre a APO" />

        <div class="max-w-7xl mx-auto text-justify">
            <p class="text-lg leading-relaxed font-semibold">Sobre a APO</p>
            <p class="text-lg leading-relaxed">
                A Associação de Pais de Oliveira (APO) nasceu do desejo e da necessidade de fortalecer a ligação entre as famílias, a escola e a comunidade. Acreditamos que a participação ativa dos pais na educação e no desenvolvimento das crianças e jovens é fundamental para a construção de um futuro melhor.
            </p>
            <p class="text-lg leading-relaxed">
                O nosso objetivo é criar iniciativas que promovam o bem-estar, o crescimento e a educação dos nossos filhos, incentivando a união entre as famílias e o envolvimento da comunidade. Ao longo dos anos, temos trabalhado para oferecer suporte à escola, organizar eventos, orientar atividades e passeios para as crianças e desenvolver projetos que beneficiem não apenas os estudantes, mas também a freguesia de Oliveira como um todo.
            </p>
            <p class="text-lg leading-relaxed">
                Através do desporto, como as nossas caminhadas e corrida, procuramos incentivar hábitos saudáveis, o espírito de equipa e o compromisso com um estilo de vida ativo.
                Mais do que uma simples competição, estes eventos representam a união da comunidade em prol de um objetivo maior: fortalecer os laços entre pais, filhos e todos aqueles que acreditam no poder da educação e do convívio social.
            </p>
            <br>
            <p class="text-lg leading-relaxed">
                A Associação de Pais de Oliveira e seus patrocinadores têm o prazer de convidar todos a participarem da 2ª Caminhada Colorida Noturna de Oliveira,
                um evento que promete muita diversão, cor e animação! Nesta segunda edição, trazemos uma novidade imperdível: além da tradicional caminhada,
                teremos também uma corrida para quem quer mais adrenalina!
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

            <p class="text-lg leading-relaxed font-semibold">
                <br>
                Junte-se a nós e faça parte desta missão de transformar vidas e construir um futuro melhor para Oliveira.
            </p>
        </div>
    </Layout>
</template>
