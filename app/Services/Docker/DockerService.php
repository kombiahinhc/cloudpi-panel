<?php

declare(strict_types=1);

namespace App\Services\Docker;

use App\DTOs\Docker\ContainerInfo;
use App\DTOs\Docker\ContainerDetails;
use App\Services\Docker\DockerMapper;
use App\Support\ActionResult;
use App\Services\Support\CommandExecutor;

final class DockerService
{
    public function __construct(
        private readonly DockerMapper $mapper,
        private readonly CommandExecutor $commandExecutor,
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

    public function start(string $container): ActionResult
    {
        return $this->run("docker start " . escapeshellarg($container));
    }

    public function stop(string $container): ActionResult
    {
        return $this->run("docker stop " . escapeshellarg($container));
    }

    public function restart(string $container): ActionResult
    {
        return $this->run("docker restart " . escapeshellarg($container));
    }

    private function run(string $command): ActionResult
    {
        return $this->commandExecutor->run($command);
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