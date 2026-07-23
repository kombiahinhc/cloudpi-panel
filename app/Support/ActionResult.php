<?php

declare(strict_types=1);

namespace App\Support;

final readonly class ActionResult
{
    public function __construct(
        public bool $success,
        public string $message,
        public mixed $data = null,
        public int $exitCode = 0,
    ) {
    }

    public static function success(
        string $message = '',
        mixed $data = null,
        int $exitCode = 0,
    ): self {
        return new self(
            success: true,
            message: $message,
            data: $data,
            exitCode: $exitCode,
        );
    }

    public static function failure(
        string $message,
        mixed $data = null,
        int $exitCode = 1,
    ): self {
        return new self(
            success: false,
            message: $message,
            data: $data,
            exitCode: $exitCode,
        );
    }
}