<?php

declare(strict_types=1);

namespace App\Livewire;

use App\DTOs\System\SystemOverview;
use App\Services\System\SystemService;
use Livewire\Attributes\Computed;
use Livewire\Component;

final class Dashboard extends Component
{
    #[Computed]
    public function system(): SystemOverview
    {
        return app(SystemService::class)->overview();
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.dashboard');
    }
}