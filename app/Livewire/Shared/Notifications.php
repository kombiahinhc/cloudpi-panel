<?php

declare(strict_types=1);

namespace App\Livewire\Shared;

use Livewire\Attributes\On;
use Livewire\Component;

final class Notifications extends Component
{
    public bool $show = false;

    public string $type = 'success';

    public string $message = '';

    #[On('notify')]
    public function notify(string $type, string $message): void
    {
        $this->type = $type;
        $this->message = $message;
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.shared.notifications');
    }
}