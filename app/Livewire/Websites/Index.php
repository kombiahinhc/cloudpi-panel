<?php

declare(strict_types=1);

namespace App\Livewire\Websites;

use App\Livewire\BasePage;
use App\Services\Websites\WebsiteService;

final class Index extends BasePage
{
    /**
     * @var array<int, array<string, mixed>>
     */
    public array $websites = [];

    public function mount(WebsiteService $websiteService): void
    {
        $this->websites = $websiteService
            ->all()
            ->map(fn ($website) => $website->toArray())
            ->all();
    }

    public function render()
    {
        return view('livewire.websites.index')
            ->layout('components.layouts.cloudpi');
    }
}