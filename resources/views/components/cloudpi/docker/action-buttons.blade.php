@props([
    'container',
])

<div class="flex justify-center gap-2">

    <button
        wire:click="viewDetails('{{ $container->name }}')"
        class="rounded-lg bg-zinc-600 px-3 py-2 text-sm text-white transition hover:bg-zinc-500"
    >
        View
    </button>

    <button
        wire:click="viewLogs('{{ $container->name }}')"
        class="rounded-lg bg-blue-600 px-3 py-2 text-sm text-white transition hover:bg-blue-700"
    >
        Logs
    </button>

    @if ($container->state === 'running')

        <button
            wire:click="restart('{{ $container->name }}')"
            class="rounded-lg bg-amber-600 px-3 py-2 text-sm text-white transition hover:bg-amber-700"
        >
            Restart
        </button>

        <button
            wire:click="stop('{{ $container->name }}')"
            class="rounded-lg bg-red-600 px-3 py-2 text-sm text-white transition hover:bg-red-700"
        >
            Stop
        </button>

    @else

        <button
            wire:click="start('{{ $container->name }}')"
            class="rounded-lg bg-green-600 px-3 py-2 text-sm text-white transition hover:bg-green-700"
        >
            Start
        </button>

    @endif

</div>