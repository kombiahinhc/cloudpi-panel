<?php

declare(strict_types=1);

namespace App\Services\System;

final class SystemService
{
    public function cpuUsage(): string
    {
        $load = sys_getloadavg();

        return number_format($load[0], 2) . ' Load';
    }

    public function memoryUsage(): string
    {
        $data = file_get_contents('/proc/meminfo');

        preg_match('/MemTotal:\s+(\d+)/', $data, $total);
        preg_match('/MemAvailable:\s+(\d+)/', $data, $available);

        $used = ($total[1] - $available[1]) / 1024 / 1024;

        return number_format($used, 2) . ' GB';
    }

    public function diskUsage(): string
    {
        $total = disk_total_space('/');
        $free = disk_free_space('/');

        $used = (($total - $free) / $total) * 100;

        return round($used) . '%';
    }

    public function dockerStatus(): string
    {
        exec('docker info >/dev/null 2>&1', $output, $code);

        return $code === 0 ? 'Running' : 'Stopped';
    }
}