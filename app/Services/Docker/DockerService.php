<?php

declare(strict_types=1);

namespace App\Services\Docker;

final class DockerService
{
    public function containers(): array
    {
        $json = shell_exec(
            'docker ps -a --format "{{json .}}"'
        );

        if (empty($json)) {
            return [];
        }

        $lines = explode("\n", trim($json));

        return collect($lines)
            ->filter()
            ->map(fn ($line) => json_decode($line, true))
            ->values()
            ->all();
    }
}