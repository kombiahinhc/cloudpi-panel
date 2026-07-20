@props([
    'total',
    'running',
    'stopped',
])

<div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">

    <div class="rounded-xl border border-zinc-800 bg-zinc-900 p-6">

        <p class="text-sm text-zinc-400">
            Total Containers
        </p>

        <h2 class="mt-2 text-3xl font-bold">
            {{ $total }}
        </h2>

    </div>

    <div class="rounded-xl border border-zinc-800 bg-zinc-900 p-6">

        <p class="text-sm text-zinc-400">
            Running
        </p>

        <h2 class="mt-2 text-3xl font-bold text-green-500">
            {{ $running }}
        </h2>

    </div>

    <div class="rounded-xl border border-zinc-800 bg-zinc-900 p-6">

        <p class="text-sm text-zinc-400">
            Stopped
        </p>

        <h2 class="mt-2 text-3xl font-bold text-red-500">
            {{ $stopped }}
        </h2>

    </div>

</div>