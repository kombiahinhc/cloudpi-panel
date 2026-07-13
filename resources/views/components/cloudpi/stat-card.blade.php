@props([
    'title',
    'value',
    'color' => 'white',
])

<div class="rounded-xl border border-zinc-800 bg-zinc-900 p-6 shadow-sm">

    <p class="text-sm text-zinc-400">
        {{ $title }}
    </p>

    <h3 @class([
        'mt-2 text-3xl font-bold',
        'text-white' => $color === 'white',
        'text-green-500' => $color === 'green',
        'text-red-500' => $color === 'red',
        'text-yellow-500' => $color === 'yellow',
        'text-blue-500' => $color === 'blue',
    ])>
        {{ $value }}
    </h3>

</div>