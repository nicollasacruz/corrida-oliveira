<x-filament-panels::page>
    <div class="grid gap-6 md:grid-cols-2">
        <x-filament::section>
            <div class="space-y-2">
                <h2 class="text-lg font-semibold text-gray-950 dark:text-white">
                    Envio em massa de check-in
                </h2>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Use esta página para enviar o email de check-in a todos os participantes com email registado.
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    O conteúdo enviado usa o template existente de check-in, incluindo as datas atualizadas de entrega do kit.
                </p>
            </div>
        </x-filament::section>

        <x-filament::section>
            <div class="space-y-2">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Participantes com email
                </p>

                <p class="text-3xl font-bold text-primary-600 dark:text-primary-400">
                    {{ $this->participantCount }}
                </p>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Clique em <strong>Enviar email para todos</strong> no topo da página para iniciar o disparo.
                </p>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
