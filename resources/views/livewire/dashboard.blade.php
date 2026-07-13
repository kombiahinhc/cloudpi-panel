<div class="p-8">

    <div class="mb-8">
        <p class="text-zinc-400">
            Welcome back, {{ auth()->user()->name }} 👋
        </p>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

        <x-cloudpi.stat-card
            title="CPU Usage"
            :value="$this->system->cpuLoad"
        />

        <x-cloudpi.stat-card
            title="Memory"
            :value="$this->system->memoryUsedGb . ' GB'"
        />

        <x-cloudpi.stat-card
            title="Disk"
            :value="$this->system->diskPercent . '%'"
        />

        <x-cloudpi.stat-card
            title="Docker"
            :value="$this->system->dockerRunning ? 'Running' : 'Stopped'"
            :color="$this->system->dockerRunning ? 'green' : 'red'"
        />

    </div>

</div>