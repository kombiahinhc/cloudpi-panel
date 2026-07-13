<?php

declare(strict_types=1);

namespace App\Services\Docker;

use App\DTOs\Docker\ContainerInfo;

final class DockerService
{
    /**
     * @return ContainerInfo[]
     */
    public function containers(): array
    {
        $output = shell_exec(
            'docker ps -a --format "{{json .}}"'
        );

        if (blank($output)) {
            return [];
        }

        $containers = [];

        foreach (explode("\n", trim($output)) as $line) {

            if (blank($line)) {
                continue;
            }

            $json = json_decode($line, true);

            $containers[] = new ContainerInfo(
                id: $json['ID'],
                name: $json['Names'],
                image: $json['Image'],
                status: $json['Status'],
                state: $json['State'],
                ports: $json['Ports'] ?? '',
                created: $json['RunningFor'],
            );
        }

        return $containers;
    }

    public function start(string $container): bool
    {
        $container = escapeshellarg($container);

        exec(
            "docker start {$container}",
            $output,
            $exitCode
        );

        return $exitCode === 0;
    }

    public function stop(string $container): bool
    {
        $container = escapeshellarg($container);

        exec(
            "docker stop {$container}",
            $output,
            $exitCode
        );

        return $exitCode === 0;
    }

    public function restart(string $container): bool
    {
        $container = escapeshellarg($container);

        exec(
            "docker restart {$container}",
            $output,
            $exitCode
        );

        return $exitCode === 0;
    }
}