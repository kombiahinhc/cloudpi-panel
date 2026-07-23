<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Concerns\InteractsWithNotifications;
use Livewire\Component;

abstract class BasePage extends Component
{
    use InteractsWithNotifications;
}