<?php

declare(strict_types=1);

namespace App\DTOs\Websites;

final readonly class WebsiteInfo
{
    public function __construct(
        public string $domain,
        public string $root,
        public string $phpVersion,
        public bool $sslEnabled,
        public bool $enabled,
        public string $configPath,
    ) {
    }

    public function toArray(): array
    {
        return [
            'domain' => $this->domain,
            'root' => $this->root,
            'phpVersion' => $this->phpVersion,
            'sslEnabled' => $this->sslEnabled,
            'enabled' => $this->enabled,
            'configPath' => $this->configPath,
        ];
    }
}