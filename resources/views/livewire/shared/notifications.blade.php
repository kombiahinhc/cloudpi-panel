<div
    x-data="{ show: @entangle('show') }"
    x-show="show"
    x-transition.opacity.duration.200ms
    class="fixed top-6 right-6 z-[9999]"
    style="display: none;"
>

    <div
        @class([
            'min-w-[340px] rounded-xl border p-4 shadow-2xl',
            'border-green-700 bg-green-900/90 text-green-100' => $type === 'success',
            'border-red-700 bg-red-900/90 text-red-100' => $type === 'error',
            'border-yellow-700 bg-yellow-900/90 text-yellow-100' => $type === 'warning',
            'border-blue-700 bg-blue-900/90 text-blue-100' => $type === 'info',
        ])
        x-init="
            $watch('show', value => {
                if (value) {
                    setTimeout(() => show = false, 3000);
                }
            });
        "
    >

        <div class="flex items-center justify-between gap-4">

            <p class="font-medium">
                {{ $message }}
            </p>

            <button
                wire:click="close"
                class="text-lg leading-none opacity-70 hover:opacity-100"
            >
                ×
            </button>

        </div>

    </div>

</div>