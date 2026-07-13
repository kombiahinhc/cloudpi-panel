<?php

declare(strict_types=1);

namespace App\Services\System;
use App\DTOs\System\SystemOverview;

final class SystemService
{
    public function overview(): SystemOverview
    {
        $memory = $this->memory();
        $disk = $this->disk();

        return new SystemOverview(
            hostname: gethostname() ?: 'Unknown',
            cpuLoad: round(sys_getloadavg()[0], 2),

            memoryUsedGb: $memory['used_gb'],
            memoryTotalGb: $memory['total_gb'],
            memoryPercent: $memory['percent'],

            diskUsedGb: $disk['used_gb'],
            diskTotalGb: $disk['total_gb'],
            diskPercent: $disk['percent'],

            dockerRunning: $this->dockerRunning(),

            phpVersion: PHP_VERSION,
            os: php_uname('s'),
            kernel: php_uname('r'),
        );
    }

    private function memory(): array
    {
        $meminfo = file('/proc/meminfo');

        $values = [];

        foreach ($meminfo as $line) {
            [$key, $value] = explode(':', $line);

            $values[$key] = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        }

        $total = $values['MemTotal'];
        $available = $values['MemAvailable'];
        $used = $total - $available;

        return [
            'total_gb' => round($total / 1024 / 1024, 2),
            'used_gb' => round($used / 1024 / 1024, 2),
            'percent' => (int) round(($used / $total) * 100),
        ];
    }

    private function disk(): array
    {
        $total = disk_total_space('/');
        $free = disk_free_space('/');

        $used = $total - $free;

        return [
            'total_gb' => round($total / 1024 / 1024 / 1024, 2),
            'used_gb' => round($used / 1024 / 1024 / 1024, 2),
            'percent' => (int) round(($used / $total) * 100),
        ];
    }

    private function dockerRunning(): bool
    {
        exec('docker info >/dev/null 2>&1', $output, $code);

        return $code === 0;
    }
}