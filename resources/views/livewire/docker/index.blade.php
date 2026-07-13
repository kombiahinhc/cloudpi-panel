<div class="p-8">

    <h1 class="mb-6 text-3xl font-bold">
        Docker Containers
    </h1>

    <div class="overflow-hidden rounded-xl border border-zinc-800 bg-zinc-900">

        <table class="min-w-full">

            <thead class="border-b border-zinc-800 bg-zinc-950">

                <tr>

                    <th class="px-4 py-3 text-left">Name</th>

                    <th class="px-4 py-3 text-left">Image</th>

                    <th class="px-4 py-3 text-left">Status</th>

                    <th class="px-4 py-3 text-left">Ports</th>

                    <th class="px-4 py-3 text-left">Running For</th>

                    <th class="px-4 py-3 text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($containers as $container)

                    <tr class="border-b border-zinc-800">

                        <td class="px-4 py-3 font-medium">
                            {{ $container->name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $container->image }}
                        </td>

                        <td class="px-4 py-3">

                            @if ($container->state === 'running')

                                <span class="rounded bg-green-600 px-2 py-1 text-xs text-white">
                                    Running
                                </span>

                            @else

                                <span class="rounded bg-red-600 px-2 py-1 text-xs text-white">
                                    Stopped
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">
                            {{ $container->ports ?: '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $container->created }}
                        </td>

                        <td class="px-4 py-3">

                            <div class="flex justify-center gap-2">

                                @if ($container->state === 'running')

                                    <button
                                        wire:click="restart('{{ $container->name }}')"
                                        wire:confirm="Restart this container?"
                                        class="rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700"
                                    >
                                        Restart
                                    </button>

                                    <button
                                        wire:click="stop('{{ $container->name }}')"
                                        wire:confirm="Stop this container?"
                                        class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700"
                                    >
                                        Stop
                                    </button>

                                @else

                                    <button
                                        wire:click="start('{{ $container->name }}')"
                                        wire:confirm="Start this container?"
                                        class="rounded bg-green-600 px-3 py-1 text-sm text-white hover:bg-green-700"
                                    >
                                        Start
                                    </button>

                                @endif

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>