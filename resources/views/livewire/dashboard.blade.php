<?php

use App\Services\System\SystemService;
use Livewire\Volt\Component;

new class extends Component {

    public array $system = [];

    public function mount(SystemService $service): void
    {
        $this->system = $service->overview();
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
            :value="$system['cpu_load']"
        />

        <x-cloudpi.stat-card
            title="Memory"
            :value="$system['memory']['used_gb'].' GB'"
        />

        <x-cloudpi.stat-card
            title="Disk"
            :value="$system['disk']['percent'].'%'"
        />

        <x-cloudpi.stat-card
            title="Docker"
            :value="$system['docker_running'] ? 'Running' : 'Stopped'"
            :color="$system['docker_running'] ? 'green' : 'red'"
        />

    </div>

</div>