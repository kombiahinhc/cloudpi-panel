<?php

declare(strict_types=1);

namespace App\Livewire\Docker;

use App\Services\Docker\DockerService;
use Illuminate\View\View;
use Livewire\Component;

final class Index extends Component
{
    public function start(string $container): void
    {
        app(DockerService::class)->start($container);

        $this->dispatch('$refresh');
    }

    public function stop(string $container): void
    {
        app(DockerService::class)->stop($container);

        $this->dispatch('$refresh');
    }

    public function restart(string $container): void
    {
        app(DockerService::class)->restart($container);

        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.docker.index', [
            'containers' => app(DockerService::class)->containers(),
        ]);
    }
}