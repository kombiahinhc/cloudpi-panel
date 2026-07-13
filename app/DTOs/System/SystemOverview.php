<?php

declare(strict_types=1);

namespace App\DTOs\System;

final readonly class SystemOverview
{
    public function __construct(
        public string $hostname,
        public float $cpuLoad,

        public float $memoryUsedGb,
        public float $memoryTotalGb,
        public int $memoryPercent,

        public float $diskUsedGb,
        public float $diskTotalGb,
        public int $diskPercent,

        public bool $dockerRunning,

        public string $phpVersion,
        public string $os,
        public string $kernel,
    ) {}
}