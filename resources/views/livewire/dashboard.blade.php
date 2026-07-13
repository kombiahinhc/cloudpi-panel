<?php

use Livewire\Volt\Component;

new class extends Component {
    //
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
            value="5%"
        />

        <x-cloudpi.stat-card
            title="Memory"
            value="2.1 GB"
        />

        <x-cloudpi.stat-card
            title="Disk"
            value="22%"
        />

        <x-cloudpi.stat-card
            title="Docker"
            value="Running"
            color="green"
        />

    </div>

</div>