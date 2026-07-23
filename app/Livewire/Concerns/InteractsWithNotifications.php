<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

trait InteractsWithNotifications
{
    protected function success(string $message): void
    {
        $this->dispatch(
            'notify',
            type: 'success',
            message: $message,
        );
    }

    protected function error(string $message): void
    {
        $this->dispatch(
            'notify',
            type: 'error',
            message: $message,
        );
    }

    protected function warning(string $message): void
    {
        $this->dispatch(
            'notify',
            type: 'warning',
            message: $message,
        );
    }

    protected function info(string $message): void
    {
        $this->dispatch(
            'notify',
            type: 'info',
            message: $message,
        );
    }
}