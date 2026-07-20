<?php

declare(strict_types=1);

namespace App\DTOs\Docker;

final readonly class ContainerDetails
{
    /**
     * @param array<int, string> $ports
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $image,
        public string $status,
        public string $startedAt,
        public string $restartPolicy,
        public string $platform,
        public array $ports = [],
    ) {
    }

    /**
     * @return array{
     *     id:string,
     *     name:string,
     *     image:string,
     *     status:string,
     *     startedAt:string,
     *     restartPolicy:string,
     *     platform:string,
     *     ports:array<int,string>
     * }
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'status' => $this->status,
            'startedAt' => $this->startedAt,
            'restartPolicy' => $this->restartPolicy,
            'platform' => $this->platform,
            'ports' => $this->ports,
        ];
    }
}