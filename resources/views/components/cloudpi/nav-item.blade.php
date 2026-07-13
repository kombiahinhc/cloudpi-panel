@props([
    'href',
    'active' => false,
])

<a
    href="{{ $href }}"
    @class([
        'flex items-center gap-3 rounded-lg px-4 py-3 transition-colors',
        'bg-blue-600 text-white' => $active,
        'text-zinc-300 hover:bg-zinc-800 hover:text-white' => ! $active,
    ])
>
    {{ $slot }}
</a>