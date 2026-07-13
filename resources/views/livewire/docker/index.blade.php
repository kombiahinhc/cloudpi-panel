<div>

    <div class="p-8">

        @php
            $totalContainers = count($containers);
            $runningContainers = collect($containers)->where('state', 'running')->count();
            $stoppedContainers = $totalContainers - $runningContainers;
        @endphp

        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <h1 class="text-3xl font-bold">
                        Docker Containers
                    </h1>

                    <span class="rounded-full bg-blue-600 px-3 py-1 text-sm font-semibold text-white">
                        {{ $totalContainers }}
                    </span>

                </div>

                <p class="mt-2 text-zinc-400">
                    Manage your Docker containers from CloudPi.
                </p>

            </div>

            <div class="w-full lg:w-80">

                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search containers..."
                    class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-4 py-2 text-white placeholder:text-zinc-500 focus:border-blue-500 focus:outline-none"
                >

            </div>

        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">

            <div class="rounded-xl border border-zinc-800 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Containers
                </p>

                <h2 class="mt-2 text-3xl font-bold">
                    {{ $totalContainers }}
                </h2>

            </div>

            <div class="rounded-xl border border-zinc-800 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Running
                </p>

                <h2 class="mt-2 text-3xl font-bold text-green-500">
                    {{ $runningContainers }}
                </h2>

            </div>

            <div class="rounded-xl border border-zinc-800 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Stopped
                </p>

                <h2 class="mt-2 text-3xl font-bold text-red-500">
                    {{ $stoppedContainers }}
                </h2>

            </div>

        </div>

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

                        <tr class="border-b border-zinc-800 hover:bg-zinc-800/40">

                            <td class="px-4 py-4 font-medium">
                                {{ $container->name }}
                            </td>

                            <td class="px-4 py-4 text-zinc-300">
                                {{ $container->image }}
                            </td>

                            <td class="px-4 py-4">

                                @if ($container->state === 'running')

                                    <span class="rounded-full bg-green-600/20 px-3 py-1 text-xs font-semibold text-green-400">
                                        Running
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-600/20 px-3 py-1 text-xs font-semibold text-red-400">
                                        Stopped
                                    </span>

                                @endif

                            </td>

                            <td class="max-w-xs truncate px-4 py-4 text-zinc-400">
                                {{ $container->ports ?: '-' }}
                            </td>

                            <td class="px-4 py-4 text-zinc-400">
                                {{ $container->created }}
                            </td>

                            <td class="px-4 py-4">

                                <div class="flex justify-center gap-2">                                
                                    
                                    <button
                                        wire:click="viewLogs('{{ $container->name }}')"
                                        class="rounded-lg bg-zinc-700 px-3 py-2 text-sm text-white transition hover:bg-zinc-600"
                                    >
                                        Logs
                                    </button>

                                    @if ($container->state === 'running')

                                        <button
                                            wire:click="restart('{{ $container->name }}')"
                                            wire:confirm="Restart this container?"
                                            class="rounded-lg bg-blue-600 px-3 py-2 text-sm text-white transition hover:bg-blue-700"
                                        >
                                            Restart
                                        </button>

                                        <button
                                            wire:click="stop('{{ $container->name }}')"
                                            wire:confirm="Stop this container?"
                                            class="rounded-lg bg-red-600 px-3 py-2 text-sm text-white transition hover:bg-red-700"
                                        >
                                            Stop
                                        </button>

                                    @else

                                        <button
                                            wire:click="start('{{ $container->name }}')"
                                            wire:confirm="Start this container?"
                                            class="rounded-lg bg-green-600 px-3 py-2 text-sm text-white transition hover:bg-green-700"
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

    @if ($showLogs)

        <div
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
        >

            <div class="w-11/12 max-w-5xl rounded-xl bg-zinc-900 shadow-2xl">

                <div class="flex items-center justify-between border-b border-zinc-800 p-5">

                    <div>

                        <h2 class="text-xl font-bold">
                            Docker Logs
                        </h2>

                        <p class="text-sm text-zinc-400">
                            {{ $selectedContainer }}
                        </p>

                    </div>

                    <button
                        wire:click="closeLogs"
                        class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700"
                    >
                        Close
                    </button>

                </div>

                <div class="max-h-[600px] overflow-auto p-5">

                    <pre class="whitespace-pre-wrap text-sm text-green-400">{{ $logs }}</pre>

                </div>

            </div>

        </div>

    @endif

</div>