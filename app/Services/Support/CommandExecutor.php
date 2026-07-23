<?php

declare(strict_types=1);

namespace App\Services\Support;

use App\Support\ActionResult;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

final class CommandExecutor
{
    public function run(string $command): ActionResult
    {
        if (Config::get('cloudpi.commands.sudo', false)) {
            $command = 'sudo ' . $command;
        }

        exec($command . ' 2>&1', $output, $exitCode);

        $message = trim(implode(PHP_EOL, $output));

        if (Config::get('cloudpi.commands.log', true)) {
            Log::debug('Shell command executed', [
                'command' => $command,
                'exit_code' => $exitCode,
                'output' => $message,
            ]);
        }

        if ($exitCode === 0) {
            return ActionResult::success(
                message: $message,
                exitCode: $exitCode,
            );
        }

        return ActionResult::failure(
            message: $message !== '' ? $message : 'Command execution failed.',
            exitCode: $exitCode,
        );
    }
}