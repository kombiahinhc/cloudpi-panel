<div class="p-8">

    <div class="mb-8">
        <p class="text-zinc-400">
            Welcome back, {{ auth()->user()->name }} 👋
        </p>
    </div>
    
    <div class="mb-8 rounded-xl bg-zinc-900 p-6 shadow">

        <h2 class="mb-6 text-xl font-semibold">
            Server Overview
        </h2>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <p class="text-zinc-500">Hostname</p>
                <p>{{ $this->system->hostname }}</p>
            </div>

            <div>
                <p class="text-zinc-500">Model</p>
                <p>{{ $this->system->model }}</p>
            </div>

            <div>
                <p class="text-zinc-500">Operating System</p>
                <p>{{ $this->system->os }}</p>
            </div>

            <div>
                <p class="text-zinc-500">Kernel</p>
                <p>{{ $this->system->kernel }}</p>
            </div>

            <div>
                <p class="text-zinc-500">PHP</p>
                <p>{{ $this->system->phpVersion }}</p>
            </div>

            <div>
                <p class="text-zinc-500">Uptime</p>
                <p>{{ $this->system->uptime }}</p>
            </div>

        </div>

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