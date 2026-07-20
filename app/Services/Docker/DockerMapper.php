<?php

declare(strict_types=1);

namespace App\Services\Docker;

use App\DTOs\Docker\ContainerDetails;
use Carbon\Carbon;

final class DockerMapper
{
    public function mapContainerDetails(array $inspect): ContainerDetails
    {
        $ports = array_keys(
            $inspect['NetworkSettings']['Ports'] ?? []
        );

        return new ContainerDetails(
            id: $inspect['Id'] ?? '',
            name: ltrim($inspect['Name'] ?? '', '/'),
            image: $inspect['Config']['Image'] ?? '',
            status: ucfirst($inspect['State']['Status'] ?? 'unknown'),
            startedAt: $this->humanDate(
                $inspect['State']['StartedAt'] ?? null
            ),
            restartPolicy: $inspect['HostConfig']['RestartPolicy']['Name'] ?? '-',
            platform: $inspect['Platform'] ?? '-',
            ports: $ports,
        );
    }

    private function humanDate(?string $date): string
    {
        if (blank($date)) {
            return '-';
        }

        try {
            return Carbon::parse($date)->diffForHumans();
        } catch (\Throwable) {
            return $date;
        }
    }
}