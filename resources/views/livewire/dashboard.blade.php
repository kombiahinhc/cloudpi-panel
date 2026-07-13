<?php

use Livewire\Volt\Component;
use App\Services\System\SystemService;

new class extends Component {

    public string $cpu;

    public string $memory;

    public string $disk;

    public string $docker;

    public function mount(SystemService $system): void
    {
        $this->cpu = $system->cpuUsage();

        $this->memory = $system->memoryUsage();

        $this->disk = $system->diskUsage();

        $this->docker = $system->dockerStatus();
    }

};

?>

<div class="p-8">

    <div class="mb-8">
        <p class="text-zinc-400">
            Welcome back, {{ auth()->user()->name }} 👋
        </p>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

        <x-cloudpi.stat-card
            title="CPU Usage"
            :value="$cpu"
        />

        <x-cloudpi.stat-card
            title="Memory"
            :value="$memory"
        />

        <x-cloudpi.stat-card
            title="Disk"
            :value="$disk"
        />

        <x-cloudpi.stat-card
            title="Docker"
            :value="$docker"
            color="green"
        />

    </div>

</div>