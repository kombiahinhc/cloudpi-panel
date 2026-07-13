<?php

use Livewire\Volt\Component;

new class extends Component {
    //
};

?>

<div class="p-8">

    <h1 class="text-4xl font-bold">
        Dashboard
    </h1>

    <p class="mt-2 text-zinc-400">
        Welcome to CloudPi 🚀
    </p>

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