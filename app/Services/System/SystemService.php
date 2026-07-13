<?php

declare(strict_types=1);

namespace App\Services\System;

final class SystemService
{
    public function overview(): array
    {
        return [
            'hostname' => gethostname(),

            'cpu_load' => round(sys_getloadavg()[0], 2),

            'memory' => $this->memory(),

            'disk' => $this->disk(),

            'docker_running' => $this->dockerRunning(),

            'php_version' => PHP_VERSION,

            'os' => php_uname('s'),

            'kernel' => php_uname('r'),
        ];
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
            'percent' => round(($used / $total) * 100),
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
            'percent' => round(($used / $total) * 100),
        ];
    }

    private function dockerRunning(): bool
    {
        exec('docker info >/dev/null 2>&1', $output, $code);

        return $code === 0;
    }
}