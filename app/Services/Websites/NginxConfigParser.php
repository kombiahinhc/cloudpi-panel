<?php

declare(strict_types=1);

namespace App\Services\Websites;

use App\DTOs\Websites\WebsiteInfo;
use Illuminate\Support\Collection;

final class NginxConfigParser
{
    /**
     * @return Collection<int, WebsiteInfo>
     */
    public function parse(?string $directory = null): Collection
    {
        $directory ??= config('cloudpi.nginx.sites_enabled');
        
        $websites = collect();

        if (! is_dir($directory)) {
            return $websites;
        }

        foreach (glob($directory . '/*') ?: [] as $file) {
            if (! is_file($file) && ! is_link($file)) {
                continue;
            }

            $config = @file_get_contents($file);

            if ($config === false) {
                continue;
            }

            $domain = $this->match('/server_name\s+([^;]+);/', $config, 'Unknown');
            $root = $this->match('/root\s+([^;]+);/', $config, '-');

            preg_match('/fastcgi_pass\s+unix:.*php([0-9.]+)-fpm\.sock;/', $config, $php);

            $phpVersion = $php[1] ?? '-';

            $sslEnabled = str_contains($config, 'listen 443')
                || str_contains($config, 'ssl_certificate');

            $websites->push(
                new WebsiteInfo(
                    domain: trim(explode(' ', $domain)[0]),
                    root: $root,
                    phpVersion: $phpVersion,
                    sslEnabled: $sslEnabled,
                    enabled: is_link($file),
                    configPath: realpath($file) ?: $file,
                )
            );
        }

        return $websites->sortBy('domain')->values();
    }

    private function match(string $pattern, string $config, string $default): string
    {
        preg_match($pattern, $config, $matches);

        return trim($matches[1] ?? $default);
    }
}