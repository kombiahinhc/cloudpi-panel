<?php

declare(strict_types=1);

namespace App\DTOs\System;

final readonly class SystemOverview
{
    public function __construct(
        public string $hostname,
        public string $model,
        public string $os,
        public string $kernel,
        public string $phpVersion,
        public string $uptime,

        public float $cpuLoad,

        public float $memoryUsedGb,
        public float $memoryTotalGb,
        public int $memoryPercent,

        public float $diskUsedGb,
        public float $diskTotalGb,
        public int $diskPercent,

        public bool $dockerRunning,
    ) {}
}