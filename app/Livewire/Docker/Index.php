<?php

declare(strict_types=1);

namespace App\Livewire\Docker;

use App\Services\Docker\DockerService;
use Illuminate\View\View;
use Livewire\Component;

final class Index extends Component
{
    public string $search = '';

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
        $containers = app(DockerService::class)->containers();

        if ($this->search !== '') {

            $containers = array_filter(
                $containers,
                fn ($container) =>
                    str_contains(
                        strtolower($container->name),
                        strtolower($this->search)
                    ) ||
                    str_contains(
                        strtolower($container->image),
                        strtolower($this->search)
                    )
            );

        }

        return view('livewire.docker.index', [
            'containers' => array_values($containers),
        ]);
    }
}