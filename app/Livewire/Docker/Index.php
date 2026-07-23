<?php

declare(strict_types=1);

namespace App\Livewire\Docker;

use App\Services\Docker\DockerService;
use Illuminate\View\View;
use App\Livewire\BasePage;

final class Index extends BasePage
{
    protected DockerService $dockerService;
    
    public string $search = '';

    public bool $showLogs = false;

    public string $selectedContainer = '';

    public string $logs = '';

    public bool $showDetails = false;

    public array $details = [];
    
    public string $startedAt = '-';
    
    public function boot(DockerService $dockerService): void
    {
        $this->dockerService = $dockerService;
    }

    public function viewDetails(string $container): void
    {
        $details = $this->dockerService->inspect($container);

        if ($details !== null) {
            $this->details = $details->toArray();

            $this->showDetails = true;
        }
    }

    public function closeDetails(): void
    {
        $this->showDetails = false;

        $this->details = [];
    }

    public function viewLogs(string $container): void
    {
        $this->selectedContainer = $container;

        $this->logs = $this->dockerService->logs($container);

        $this->showLogs = true;
    }

    public function closeLogs(): void
    {
        $this->showLogs = false;

        $this->selectedContainer = '';

        $this->logs = '';
    }

    public function start(string $container): void
    {
        $result = $this->dockerService->start($container);

       if ($result->success) {
            $this->success("Container '{$container}' started successfully.");
        } else {
            $this->error($result->message);
        }

        if ($result->success) {
            $this->dispatch('$refresh');
        }
    }

    public function stop(string $container): void
    {
        $result = $this->dockerService->stop($container);

        if ($result->success) {
            $this->success("Container '{$container}' stopped successfully.");
        } else {
            $this->error($result->message);
        }

        if ($result->success) {
            $this->dispatch('$refresh');
        }
    }

    public function restart(string $container): void
    {
        $result = $this->dockerService->restart($container);

        if ($result->success) {
            $this->success("Container '{$container}' restarted successfully.");
        } else {
            $this->error($result->message);
        }

        if ($result->success) {
            $this->dispatch('$refresh');
        }
    }

    public function render(): View
    {
        $containers = $this->dockerService->containers();

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