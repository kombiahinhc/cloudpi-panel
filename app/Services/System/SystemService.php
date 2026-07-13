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
            hostname: $this->hostname(),
            model: $this->model(),
            os: $this->operatingSystem(),
            kernel: php_uname('r'),
            phpVersion: PHP_VERSION,
            uptime: $this->uptime(),

            cpuLoad: round(sys_getloadavg()[0], 2),

            memoryUsedGb: $memory['used_gb'],
            memoryTotalGb: $memory['total_gb'],
            memoryPercent: $memory['percent'],

            diskUsedGb: $disk['used_gb'],
            diskTotalGb: $disk['total_gb'],
            diskPercent: $disk['percent'],

            dockerRunning: $this->dockerRunning(),
        );
    }
    
    private function operatingSystem(): string
    {
        $file = '/etc/os-release';

        if (! file_exists($file)) {
            return php_uname('s');
        }

        $data = parse_ini_file($file);

        return $data['PRETTY_NAME'] ?? php_uname('s');
    }
    
    private function hostname(): string
    {
        return gethostname() ?: 'Unknown';
    }
    
    private function model(): string
    {
        $file = '/proc/device-tree/model';

        if (! file_exists($file)) {
            return 'Unknown';
        }

        return trim(file_get_contents($file));
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
    
    private function uptime(): string
    {
        $seconds = (int) explode(' ', trim(file_get_contents('/proc/uptime')))[0];

        $days = intdiv($seconds, 86400);
        $hours = intdiv($seconds % 86400, 3600);

        return "{$days}d {$hours}h";
    }
}