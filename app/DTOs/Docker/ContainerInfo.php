<?php

declare(strict_types=1);

namespace App\DTOs\Docker;

final readonly class ContainerInfo
{
    public function __construct(
        public string $id,
        public string $name,
        public string $image,
        public string $status,
        public string $state,
        public string $ports,
        public string $created,

        // Live statistics
        public string $cpu = '-',
        public string $memory = '-',
    ) {
    }
}