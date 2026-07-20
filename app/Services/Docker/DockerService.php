<?php

declare(strict_types=1);

namespace App\Services\Docker;

use App\DTOs\Docker\ContainerInfo;
use App\DTOs\Docker\ContainerDetails;
use App\Services\Docker\DockerMapper;

final class DockerService
{
    public function __construct(
        private readonly DockerMapper $mapper,
    ) {
    }
    /**
     * @return ContainerInfo[]
     */
    public function containers(): array
    {
        $output = shell_exec(
            'docker ps -a --format "{{json .}}"'
        );

        $statsOutput = shell_exec(
            'docker stats --no-stream --format "{{json .}}" 2>/dev/null'
        );

        $stats = [];

        if (! blank($statsOutput)) {
            foreach (explode("\n", trim($statsOutput)) as $line) {

                if (blank($line)) {
                    continue;
                }

                $json = json_decode($line, true);

                if (isset($json['Name'])) {
                    $stats[$json['Name']] = [
                        'cpu' => $json['CPUPerc'] ?? '-',
                        'memory' => $json['MemUsage'] ?? '-',
                    ];
                }
            }
        }

        if (blank($output)) {
            return [];
        }

        $containers = [];

        foreach (explode("\n", trim($output)) as $line) {

            if (blank($line)) {
                continue;
            }

            $json = json_decode($line, true);

            $containerStats = $stats[$json['Names']] ?? [];

            $containers[] = new ContainerInfo(
                id: $json['ID'],
                name: $json['Names'],
                image: $json['Image'],
                status: $json['Status'],
                state: $json['State'],
                ports: $json['Ports'] ?? '',
                created: $this->startedAt($json['Names']),
                cpu: $containerStats['cpu'] ?? '-',
                memory: $containerStats['memory'] ?? '-',
            );
        }

        return $containers;
    }

    public function inspect(string $container): ?ContainerDetails
    {
        $container = escapeshellarg($container);

        $output = shell_exec(
            "docker inspect {$container} 2>/dev/null"
        );

        if (blank($output)) {
            return null;
        }

        $inspect = json_decode($output, true);

        if (
            ! is_array($inspect) ||
            empty($inspect[0])
        ) {
            return null;
        }

        return $this->mapper->mapContainerDetails(
            $inspect[0]
        );
    }

    public function logs(string $container, int $lines = 100): string
    {
        $container = escapeshellarg($container);

        $output = shell_exec(
            "docker logs --tail {$lines} {$container} 2>&1"
        );

        return $output ?: 'No logs available.';
    }

    public function start(string $container): bool
    {
        $container = escapeshellarg($container);

        exec("docker start {$container}", $output, $exitCode);

        return $exitCode === 0;
    }

    public function stop(string $container): bool
    {
        $container = escapeshellarg($container);

        exec("docker stop {$container}", $output, $exitCode);

        return $exitCode === 0;
    }

    public function restart(string $container): bool
    {
        $container = escapeshellarg($container);

        exec("docker restart {$container}", $output, $exitCode);

        return $exitCode === 0;
    }
    
    public function startedAtHuman(string $container): string
    {
        return $this->startedAt($container);
    }
    
    private function startedAt(string $container): string
    {
        $container = escapeshellarg($container);

        $output = shell_exec(
            "docker inspect --format='{{.State.StartedAt}}' {$container} 2>/dev/null"
        );

        if (blank($output)) {
            return '-';
        }

        try {
            return now()
                ->parse(trim($output))
                ->diffForHumans();
        } catch (\Throwable) {
            return trim($output);
        }
    }
}