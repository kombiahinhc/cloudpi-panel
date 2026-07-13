<?php

declare(strict_types=1);

namespace App\Livewire\Docker;

use App\Services\Docker\DockerService;
use Illuminate\View\View;
use Livewire\Component;

final class Index extends Component
{
    public function restart(string $container): void
    {
        app(DockerService::class)->restart($container);
    }
    
    public function render(): View
    {
        return view('livewire.docker.index', [
            'containers' => app(DockerService::class)->containers(),
        ]);
    }
}