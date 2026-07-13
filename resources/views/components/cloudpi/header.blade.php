<header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-zinc-800 bg-zinc-950 px-8">

    <div>
        <h1 class="text-xl font-semibold text-white">
            Dashboard
        </h1>
    </div>

    <div class="flex items-center gap-4">

        <!-- Search -->
        <div>
            <input
                type="text"
                placeholder="Search..."
                class="w-72 rounded-lg border border-zinc-700 bg-zinc-900 px-4 py-2 text-sm text-white outline-none focus:border-blue-500"
            >
        </div>

        <!-- Theme Toggle (Placeholder) -->
        <button
            class="rounded-lg border border-zinc-700 bg-zinc-900 p-2 hover:bg-zinc-800"
            title="Toggle Theme"
        >
            🌙
        </button>

        <!-- Notifications -->
        <button
            class="rounded-lg border border-zinc-700 bg-zinc-900 p-2 hover:bg-zinc-800"
            title="Notifications"
        >
            🔔
        </button>

        <!-- User -->
        <div class="flex items-center gap-2 rounded-lg border border-zinc-700 bg-zinc-900 px-3 py-2">

            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-600 font-semibold">
                K
            </div>

            <div class="text-sm">
                <div>{{ auth()->user()->name }}</div>
            </div>

        </div>

    </div>

</header>