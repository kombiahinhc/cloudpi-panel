<?php

declare(strict_types=1);

namespace App\Services\Websites;

use App\DTOs\Websites\WebsiteInfo;
use App\Services\Support\CommandExecutor;
use Illuminate\Support\Collection;

final readonly class WebsiteService
{
    public function __construct(
        private CommandExecutor $commandExecutor,
        private NginxConfigParser $parser,
    ) {
    }

    /**
     * @return Collection<int, WebsiteInfo>
     */
    public function all(): Collection
    {
        return $this->parser->parse();
    }
}