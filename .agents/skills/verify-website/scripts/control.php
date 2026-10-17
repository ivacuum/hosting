#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace HostingVerification\Control;

use RuntimeException;
use Throwable;

const REPO = __DIR__ . '/../../../..';

/**
 * @param  array<string, string>  $settings
 * @return array<string, string>
 */
function environment(array $settings = []): array
{
    $environment = [];
    foreach (['PATH', 'HOME', 'TMPDIR', 'LANG'] as $key) {
        $value = getenv($key);
        if ($value !== false) {
            $environment[$key] = $value;
        }
    }

    return array_replace($environment, $settings);
}

/**
 * @param  list<string>  $command
 * @param  array<string, string>  $settings
 * @return array{code: int, stdout: string, stderr: string}
 */
function run(array $command, string|null $cwd = null, array $settings = [], string|null $log = null, bool $check = true): array
{
    $output = null;
    $pipes = [];
    $descriptors = [0 => ['file', '/dev/null', 'r']];
    if ($log !== null) {
        $output = fopen($log, 'ab');
        if ($output === false) {
            throw new RuntimeException('Cannot open log ' . $log);
        }
        $descriptors[1] = $output;
        $descriptors[2] = $output;
    } else {
        $descriptors[1] = ['pipe', 'w'];
        $descriptors[2] = ['pipe', 'w'];
    }

    $process = proc_open($command, $descriptors, $pipes, $cwd, $settings === [] ? null : environment($settings));
    if (!is_resource($process)) {
        if (is_resource($output)) {
            fclose($output);
        }
        throw new RuntimeException('Cannot start ' . $command[0]);
    }

    $captured = [1 => '', 2 => ''];
    try {
        foreach ($pipes as $pipe) {
            stream_set_blocking($pipe, false);
        }
        while ($pipes !== []) {
            $read = array_values($pipes);
            $write = null;
            $except = null;
            if (stream_select($read, $write, $except, null) === false) {
                throw new RuntimeException('Cannot read command output');
            }
            foreach ($read as $pipe) {
                $index = array_search($pipe, $pipes, true);
                $chunk = fread($pipe, 65536);
                if ($chunk === false) {
                    throw new RuntimeException('Cannot read command output');
                }
                $captured[$index] .= $chunk;
                if (feof($pipe)) {
                    fclose($pipe);
                    unset($pipes[$index]);
                }
            }
        }
    } catch (Throwable $error) {
        proc_terminate($process);
        throw $error;
    } finally {
        foreach ($pipes as $pipe) {
            fclose($pipe);
        }
        $code = proc_close($process);
        if (is_resource($output)) {
            fclose($output);
        }
    }

    if ($check && $code !== 0) {
        $detail = trim($captured[2]);
        throw new RuntimeException($command[0] . ' exited with status ' . $code . ($detail !== '' ? ': ' . $detail : ($log !== null ? '; inspect ' . $log : '')));
    }

    return ['code' => $code, 'stdout' => $captured[1], 'stderr' => $captured[2]];
}

function resolvePath(string $path): string
{
    if ($path === '' || str_contains($path, "\0")) {
        throw new RuntimeException('Invalid run directory');
    }
    if (!str_starts_with($path, '/')) {
        $cwd = getcwd();
        if ($cwd === false) {
            throw new RuntimeException('Cannot determine the current directory');
        }
        $path = $cwd . '/' . $path;
    }
    $resolved = '';
    foreach (explode('/', $path) as $part) {
        if ($part === '' || $part === '.') {
            continue;
        }
        if ($part === '..') {
            $resolved = dirname($resolved === '' ? '/' : $resolved);
            $resolved = $resolved === '/' ? '' : $resolved;

            continue;
        }
        $candidate = $resolved . '/' . $part;
        if (file_exists($candidate) || is_link($candidate)) {
            $real = realpath($candidate);
            if ($real === false) {
                throw new RuntimeException('Cannot resolve ' . $candidate);
            }
            $resolved = $real === '/' ? '' : $real;
        } else {
            $resolved = $candidate;
        }
    }

    return $resolved === '' ? '/' : $resolved;
}

function makeDirectory(string $path): void
{
    if (is_link($path) || (!is_dir($path) && !mkdir($path, 0777, true))) {
        throw new RuntimeException('Cannot create directory ' . $path);
    }
}

function writeFile(string $path, string $contents): void
{
    if (file_put_contents($path, $contents) !== strlen($contents)) {
        throw new RuntimeException('Cannot write ' . $path);
    }
}

/** @param array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} $state */
function save(string $root, array $state): void
{
    $temporary = $root . '/instance.json.' . bin2hex(random_bytes(6));
    try {
        writeFile($temporary, json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) . "\n");
        if (!rename($temporary, $root . '/instance.json')) {
            throw new RuntimeException('Cannot persist instance ownership');
        }
    } finally {
        if (is_file($temporary)) {
            unlink($temporary);
        }
    }
}

/** @return array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} */
function load(string $root): array
{
    $contents = file_get_contents($root . '/instance.json');
    if ($contents === false) {
        throw new RuntimeException('Cannot read instance manifest');
    }
    $state = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($state) || ($state['root'] ?? null) !== $root
        || !is_string($state['id'] ?? null) || preg_match('/^hosting-verify-[A-Za-z0-9_-]+$/D', $state['id']) !== 1
        || !is_string($state['revision'] ?? null)) {
        throw new RuntimeException('Instance manifest does not belong to this directory');
    }
    foreach (['url', 'server_marker'] as $key) {
        if (array_key_exists($key, $state) && (!is_string($state[$key]) || $state[$key] === '')) {
            throw new RuntimeException('Invalid instance manifest field ' . $key);
        }
    }
    if ((array_key_exists('pid', $state) && (!is_int($state['pid']) || $state['pid'] <= 1))
        || (array_key_exists('cleaned', $state) && !is_bool($state['cleaned']))) {
        throw new RuntimeException('Invalid instance manifest process or cleanup state');
    }

    return $state;
}

function requireProcessFunctions(): void
{
    foreach (['proc_open', 'pcntl_fork', 'pcntl_exec', 'posix_setsid', 'posix_getpid', 'posix_getpgid', 'posix_getsid', 'posix_kill'] as $function) {
        if (!function_exists($function)) {
            throw new RuntimeException('PHP function ' . $function . ' is required for isolated server lifecycle');
        }
    }
}

function dockerPort(string $name, int $port): string
{
    $output = trim(run(['docker', 'port', $name, $port . '/tcp'])['stdout']);
    if (preg_match('/^127\.0\.0\.1:([0-9]+)$/D', $output, $matches) !== 1) {
        throw new RuntimeException('Unexpected container port binding for ' . $name);
    }

    return $matches[1];
}

/** @param array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} $state */
function provisionServices(array $state): void
{
    foreach ([
        ['mysql', 'mysql:8.4', 3306, ['--tmpfs', '/var/lib/mysql', '-e', 'MYSQL_ROOT_PASSWORD=verification-only', '-e', 'MYSQL_DATABASE=hosting']],
        ['redis', 'redis:alpine', 6379, []],
    ] as [$suffix, $image, $port, $extra]) {
        run(['docker', 'run', '-d', '--name', $state['id'] . '-' . $suffix,
            '--label', 'hosting-verification=' . $state['id'], '-p', '127.0.0.1::' . $port, ...$extra, $image]);
    }
}

/** @param array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} $state */
function cleanupServices(array $state): void
{
    foreach (['redis', 'mysql'] as $suffix) {
        $name = $state['id'] . '-' . $suffix;
        $found = run(['docker', 'inspect', '--format', '{{index .Config.Labels "hosting-verification"}}', $name], check: false);
        if ($found['code'] === 0) {
            if (trim($found['stdout']) !== $state['id']) {
                throw new RuntimeException('Refusing to remove a container owned by another run');
            }
            run(['docker', 'logs', $name], log: $state['root'] . '/evidence/' . $suffix . '.log');
            run(['docker', 'rm', '-fv', $name]);
        } elseif (preg_match('/no such (?:object|container):/i', $found['stderr']) !== 1) {
            throw new RuntimeException(trim($found['stderr']) ?: 'Cannot inspect container ' . $name);
        }
    }
}

/** @param array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} $state */
function sql(array $state, string $query): string
{
    $prefix = strtoupper(ltrim($query));
    if ((!str_starts_with($prefix, 'SELECT ') && !str_starts_with($prefix, 'SHOW ')) || str_contains($query, ';')) {
        throw new RuntimeException('Only one read-only SELECT or SHOW statement is allowed');
    }

    $name = $state['id'] . '-mysql';
    $label = trim(run(['docker', 'inspect', '--format', '{{index .Config.Labels "hosting-verification"}}', $name])['stdout']);
    if ($label !== $state['id']) {
        throw new RuntimeException('MySQL container ownership mismatch');
    }

    return run(['docker', 'exec', $name, 'mysql', '-h127.0.0.1', '-uroot', '-pverification-only',
        '--default-character-set=utf8mb4', '--batch', 'hosting', '-e', $query])['stdout'];
}

/** @param callable(): string $check */
function waitFor(callable $check, int $seconds = 180): string
{
    $deadline = hrtime(true) + $seconds * 1_000_000_000;
    while (hrtime(true) < $deadline) {
        try {
            return $check();
        } catch (RuntimeException) {
            sleep(1);
        }
    }
    throw new RuntimeException('Readiness timed out; inspect evidence logs');
}

/** @param array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} $state */
function request(array $state, string $path): string
{
    if (!isset($state['url']) || preg_match('#^http://127\.0\.0\.1:[0-9]+$#D', $state['url']) !== 1) {
        throw new RuntimeException('Invalid instance URL');
    }
    $context = stream_context_create(['http' => ['timeout' => 10]]);
    $body = @file_get_contents($state['url'] . $path, false, $context);
    if ($body === false) {
        throw new RuntimeException('Cannot request ' . $path . ' from the instance');
    }

    return $body;
}

/** @return array{command: string, zombie: bool}|null */
function processInfo(int $pid): array|null
{
    $result = run(['ps', '-ww', '-p', (string) $pid, '-o', 'stat=', '-o', 'command='], check: false);
    if ($result['code'] === 1 && trim($result['stdout']) === '') {
        return null;
    }
    if ($result['code'] !== 0 || preg_match('/^\s*(\S+)\s+(.+)$/sD', $result['stdout'], $matches) !== 1) {
        throw new RuntimeException('Cannot inspect server PID');
    }

    return ['command' => trim($matches[2]), 'zombie' => str_starts_with($matches[1], 'Z')];
}

/** @param array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} $state */
function ownsServer(array $state): bool
{
    if (!isset($state['pid'], $state['server_marker'])) {
        throw new RuntimeException('Instance manifest has no server ownership');
    }
    if ($state['server_marker'] !== $state['root'] . '/app/artisan') {
        throw new RuntimeException('Instance manifest has no run-specific Artisan marker');
    }
    $info = processInfo($state['pid']);
    if ($info === null || $info['zombie']) {
        return false;
    }
    if (!str_contains($info['command'], $state['server_marker'])
        || posix_getpgid($state['pid']) !== $state['pid']
        || posix_getsid($state['pid']) !== $state['pid']
        || $state['pid'] === posix_getpgid(0)
        || $state['pid'] === posix_getsid(0)) {
        throw new RuntimeException('Refusing to signal an unowned or non-private server process group');
    }

    return true;
}

function groupIsRunning(int $pgid): bool
{
    $output = run(['ps', '-axo', 'pgid=', '-o', 'stat='])['stdout'];
    foreach (explode("\n", trim($output)) as $line) {
        if (preg_match('/^\s*([0-9]+)\s+(\S+)/D', $line, $matches) === 1
            && (int) $matches[1] === $pgid && !str_starts_with($matches[2], 'Z')) {
            return true;
        }
    }

    return false;
}

/** @param array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool} $state */
function stopServer(array $state): void
{
    if (!isset($state['pid'])) {
        return;
    }
    requireProcessFunctions();
    if (ownsServer($state)) {
        if (!posix_kill(-$state['pid'], 15) && groupIsRunning($state['pid'])) {
            throw new RuntimeException('Cannot terminate the owned server process group');
        }
    } elseif (groupIsRunning($state['pid'])) {
        throw new RuntimeException('Refusing to signal a server group without its owned leader');
    }
    $deadline = hrtime(true) + 15_000_000_000;
    while (groupIsRunning($state['pid'])) {
        if (hrtime(true) >= $deadline) {
            throw new RuntimeException('Server teardown timed out; copied app was retained');
        }
        usleep(100_000);
    }
}

/**
 * @param  array{id: string, root: string, revision: string, url?: string, pid?: int, server_marker?: string, cleaned?: bool}  $state
 * @param  array<string, string>  $settings
 */
function startServer(string $root, array &$state, int $port, array $settings): void
{
    $artisan = $root . '/app/artisan';
    $state['server_marker'] = $artisan;
    $launcher = <<<'PHP'
    $pid = pcntl_fork();
    if ($pid < 0) { exit(1); }
    if ($pid > 0) { exit(0); }
    if (posix_setsid() !== posix_getpid()) { exit(1); }
    $report = fopen('php://fd/3', 'w');
    $ack = fopen('php://fd/4', 'r');
    if ($report === false || $ack === false) { exit(1); }
    $message = posix_getpid()."\n";
    if (fwrite($report, $message) !== strlen($message)) { exit(1); }
    fclose($report);
    stream_set_blocking($ack, false);
    $read = [$ack];
    $write = $except = null;
    if (stream_select($read, $write, $except, 10) !== 1) { exit(1); }
    $message = fread($ack, 16);
    fclose($ack);
    if ($message !== "GO\n") { exit(1); }
    pcntl_exec($argv[1], array_slice($argv, 2));
    exit(1);
    PHP;
    $log = fopen($root . '/evidence/server.log', 'ab');
    if ($log === false) {
        throw new RuntimeException('Cannot open server log');
    }
    $pipes = [];
    $process = proc_open([
        PHP_BINARY, '-r', $launcher, '--', PHP_BINARY, $artisan, 'serve', '--host=127.0.0.1',
        '--port=' . $port, '--tries=1', '--no-reload', '--no-interaction',
    ], [0 => ['file', '/dev/null', 'r'], 1 => $log, 2 => $log, 3 => ['pipe', 'w'], 4 => ['pipe', 'r']], $pipes, $root . '/app', environment($settings));
    fclose($log);
    if (!is_resource($process)) {
        throw new RuntimeException('Cannot start server launcher');
    }
    $acknowledged = false;
    try {
        stream_set_blocking($pipes[3], false);
        $read = [$pipes[3]];
        $write = $except = null;
        if (stream_select($read, $write, $except, 10) !== 1) {
            throw new RuntimeException('Server launcher did not report its private PID');
        }
        $report = fread($pipes[3], 32);
        if ($report === false || preg_match('/^[0-9]+\n$/D', $report) !== 1 || (int) $report <= 1) {
            throw new RuntimeException('Server launcher did not report its private PID');
        }
        $state['pid'] = (int) $report;
        if (!ownsServer($state)) {
            throw new RuntimeException('Server launcher exited before ownership was recorded');
        }
        save($root, $state);
        if (@fwrite($pipes[4], "GO\n") !== 3 || !fflush($pipes[4])) {
            throw new RuntimeException('Cannot acknowledge server ownership');
        }
        $acknowledged = true;
    } finally {
        foreach ($pipes as $pipe) {
            fclose($pipe);
        }
        $code = proc_close($process);
        if (!$acknowledged && isset($state['pid'])) {
            $deadline = hrtime(true) + 12_000_000_000;
            do {
                $info = processInfo($state['pid']);
                if ($info === null || $info['zombie']) {
                    break;
                }
                if (hrtime(true) >= $deadline) {
                    throw new RuntimeException('Unacknowledged server launcher did not exit');
                }
                usleep(100_000);
            } while (true);
        }
    }
    if ($code !== 0) {
        throw new RuntimeException('Server launcher failed');
    }
}

/** @return array{id: string, url: string, revision: string, counts: string, status: string} */
function doctor(string $root): array
{
    $state = load($root);
    if ($state['cleaned'] ?? false) {
        throw new RuntimeException('Instance was already cleaned');
    }
    requireProcessFunctions();
    if (!ownsServer($state)) {
        throw new RuntimeException('Server PID no longer belongs to this run');
    }
    foreach (['mysql', 'redis'] as $suffix) {
        $name = $state['id'] . '-' . $suffix;
        $label = trim(run(['docker', 'inspect', '--format', '{{index .Config.Labels "hosting-verification"}}', $name])['stdout']);
        if ($label !== $state['id']) {
            throw new RuntimeException('Container ownership mismatch');
        }
    }
    if (trim(run(['docker', 'exec', $state['id'] . '-redis', 'redis-cli', 'ping'])['stdout']) !== 'PONG') {
        throw new RuntimeException('Redis container is not ready');
    }
    if (trim(request($state, '/verification-instance.txt')) !== $state['id']) {
        throw new RuntimeException('Wrong instance owns the HTTP port');
    }
    $counts = sql($state, 'SELECT (SELECT COUNT(*) FROM users) AS users, (SELECT COUNT(*) FROM trips) AS trips, (SELECT COUNT(*) FROM gigs) AS gigs, (SELECT COUNT(*) FROM photos) AS photos');
    $html = request($state, '/life');
    if (!str_contains($html, 'data-route="life"') || !str_contains($html, 'Поездки')) {
        throw new RuntimeException('Seeded user-facing page is not usable');
    }
    $result = ['id' => $state['id'], 'url' => $state['url'], 'revision' => $state['revision'], 'counts' => $counts, 'status' => 'ready'];
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) . "\n";

    return $result;
}

function copyLogs(string $source, string $destination): void
{
    if (is_link($source)) {
        throw new RuntimeException('Refusing to copy symlinked application logs');
    }
    if (!is_dir($source)) {
        return;
    }
    makeDirectory($destination);
    $entries = scandir($source);
    if ($entries === false) {
        throw new RuntimeException('Cannot read application logs');
    }
    foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        $from = $source . '/' . $entry;
        $to = $destination . '/' . $entry;
        if (is_link($from)) {
            throw new RuntimeException('Refusing to copy symlinked application logs');
        }
        if (is_dir($from)) {
            copyLogs($from, $to);
        } elseif (!copy($from, $to)) {
            throw new RuntimeException('Cannot preserve application log ' . $from);
        }
    }
}

function removeApp(string $path): void
{
    $entries = scandir($path);
    if ($entries === false) {
        throw new RuntimeException('Cannot read copied app ' . $path);
    }
    foreach ($entries as $entry) {
        if ($entry === '.' || $entry === '..') {
            continue;
        }
        $child = $path . '/' . $entry;
        if (is_dir($child) && !is_link($child)) {
            removeApp($child);
        } elseif (!unlink($child)) {
            throw new RuntimeException('Cannot remove copied file ' . $child);
        }
    }
    if (!rmdir($path)) {
        throw new RuntimeException('Cannot remove copied directory ' . $path);
    }
}

function cleanup(string $root): void
{
    $state = load($root);
    if ($state['cleaned'] ?? false) {
        return;
    }
    $app = $root . '/app';
    if (is_link($app)) {
        throw new RuntimeException('Refusing to remove a symlinked app');
    }
    makeDirectory($root . '/evidence');
    stopServer($state);
    cleanupServices($state);
    if (is_dir($app)) {
        copyLogs($app . '/storage/logs', $root . '/evidence/app-logs');
        removeApp($app);
    } elseif (file_exists($app)) {
        throw new RuntimeException('Refusing to remove an app path that is not a directory');
    }
    $state['cleaned'] = true;
    save($root, $state);
    echo 'Cleaned ' . $state['id'] . '; retained ' . $root . '/evidence' . "\n";
}

function launch(string $root): void
{
    requireProcessFunctions();
    if (file_exists($root) || is_link($root)) {
        throw new RuntimeException('Launch requires a run directory that does not exist');
    }
    $state = [
        'id' => 'hosting-verify-' . bin2hex(random_bytes(6)), 'root' => $root,
        'revision' => trim(run(['git', 'rev-parse', 'HEAD'], realpath(REPO))['stdout']),
    ];
    if (!mkdir($root, 0777, true)) {
        throw new RuntimeException('Cannot create run directory ' . $root);
    }
    save($root, $state);
    try {
        makeDirectory($root . '/evidence');
        writeFile($root . '/evidence/source-status.txt', run(['git', 'status', '--short'], realpath(REPO))['stdout']);
        $app = $root . '/app';
        makeDirectory($app);
        $excludes = ['.git', '.docker', '.env*', '.idea', '.agents', '.ai', 'storage', 'public/uploads', 'public/storage', 'public/hot', 'public/assets', 'bootstrap/cache/*.php'];
        $copy = ['rsync', '-a'];
        foreach ($excludes as $exclude) {
            $copy[] = '--exclude=/' . $exclude;
        }
        $copy[] = realpath(REPO) . '/';
        $copy[] = $app . '/';
        run($copy);
        foreach (['vendor', 'node_modules'] as $dependency) {
            if (is_link($app . '/' . $dependency)) {
                $source = realpath(REPO . '/' . $dependency);
                if ($source === false || !is_dir($source)) {
                    throw new RuntimeException('Cannot copy dependency directory ' . $dependency);
                }
                if (!unlink($app . '/' . $dependency)) {
                    throw new RuntimeException('Cannot replace dependency symlink ' . $dependency);
                }
                makeDirectory($app . '/' . $dependency);
                run(['rsync', '-a', $source . '/', $app . '/' . $dependency . '/']);
            }
        }
        foreach (['storage/app', 'storage/logs', 'storage/framework/cache/data', 'storage/framework/sessions', 'storage/framework/views', 'bootstrap/cache', 'public/uploads/temp'] as $directory) {
            makeDirectory($app . '/' . $directory);
        }
        provisionServices($state);
        $mysqlPort = dockerPort($state['id'] . '-mysql', 3306);
        $redisPort = dockerPort($state['id'] . '-redis', 6379);
        waitFor(fn (): string => sql($state, 'SELECT 1'));
        $socket = stream_socket_server('tcp://127.0.0.1:0', $errorCode, $errorMessage);
        if ($socket === false) {
            throw new RuntimeException('Cannot allocate an HTTP port: ' . $errorMessage);
        }
        $address = stream_socket_get_name($socket, false);
        fclose($socket);
        if ($address === false || preg_match('/^127\.0\.0\.1:([0-9]+)$/D', $address, $matches) !== 1) {
            throw new RuntimeException('Cannot determine the allocated HTTP port');
        }
        $port = (int) $matches[1];
        $state['url'] = 'http://127.0.0.1:' . $port;
        $settings = [
            'APP_ENV' => 'local', 'APP_DEBUG' => 'true', 'APP_KEY' => 'base64:' . base64_encode(random_bytes(32)),
            'APP_URL' => $state['url'], 'DB_CONNECTION' => 'mysql', 'DB_HOST' => '127.0.0.1', 'DB_PORT' => $mysqlPort,
            'DB_DATABASE' => 'hosting', 'DB_USERNAME' => 'root', 'DB_PASSWORD' => 'verification-only', 'DB_SOCKET' => '',
            'REDIS_CLIENT' => 'predis', 'REDIS_URL' => 'redis://127.0.0.1:' . $redisPort,
            'CACHE_STORE' => 'file', 'SESSION_DRIVER' => 'file', 'SESSION_COOKIE' => $state['id'],
            'MAIL_MAILER' => 'log', 'QUEUE_CONNECTION' => 'sync', 'SCOUT_DRIVER' => 'collection', 'DEBUGBAR_ENABLED' => 'false',
            'LOG_CHANNEL' => 'single', 'AI_AGENT' => '1',
        ];
        $dotenv = '';
        foreach ($settings as $key => $value) {
            $dotenv .= $key . '="' . str_replace(['\\', '"', '$', "\n", "\r"], ['\\\\', '\\"', '\\$', '\\n', '\\r'], $value) . '"' . "\n";
        }
        $mask = umask(0077);
        try {
            writeFile($app . '/.env', $dotenv);
        } finally {
            umask($mask);
        }
        run(['yarn', 'build'], $app, $settings, $root . '/evidence/setup.log');
        run([PHP_BINARY, 'artisan', 'migrate', '--seed', '--seeder=App\\Seeder\\DatabaseSeeder', '--no-interaction'], $app, $settings, $root . '/evidence/setup.log');
        writeFile($app . '/public/verification-instance.txt', $state['id'] . "\n");
        startServer($root, $state, $port, $settings);
        waitFor(fn (): string => request($state, '/verification-instance.txt'), 30);
        $result = doctor($root);
        writeFile($root . '/evidence/doctor.json', json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR) . "\n");
    } catch (Throwable $error) {
        try {
            cleanup($root);
        } catch (Throwable $cleanupError) {
            fwrite(STDERR, 'Cleanup failed: ' . $cleanupError->getMessage() . "\n");
        }
        throw $error;
    }
}

function help(): string
{
    return <<<'HELP'
    usage: control.php [-h] {launch,doctor,sql,cleanup} root [query]

    Disposable local Hosting instance. Run --help for the command contract.

    positional arguments:
      {launch,doctor,sql,cleanup}
      root                  Absolute, run-specific directory; launch requires it not to exist
      query                 Single SELECT/SHOW query for sql

    options:
      -h, --help            show this help message and exit

    Launch requires PHP pcntl and posix functions for an isolated server process group.
    HELP;
}

/** @param list<string> $arguments */
function main(array $arguments): int
{
    $separator = array_search('--', $arguments, true);
    $optionArguments = $separator === false ? $arguments : array_slice($arguments, 0, $separator);
    if (in_array('--help', $optionArguments, true) || in_array('-h', $optionArguments, true)) {
        echo help() . "\n";

        return 0;
    }
    $positionals = [];
    $options = true;
    foreach ($arguments as $argument) {
        if ($options && $argument === '--') {
            $options = false;
        } elseif ($options && str_starts_with($argument, '-') && $argument !== '-') {
            fwrite(STDERR, 'control.php: error: unrecognized argument ' . $argument . "\n");

            return 2;
        } else {
            $positionals[] = $argument;
        }
    }
    if (count($positionals) < 2 || count($positionals) > 3
        || !in_array($positionals[0], ['launch', 'doctor', 'sql', 'cleanup'], true)
        || ($positionals[0] === 'sql' && ($positionals[2] ?? '') === '')) {
        fwrite(STDERR, "usage: control.php [-h] {launch,doctor,sql,cleanup} root [query]\ncontrol.php: error: supply a command, root, and a query for sql\n");

        return 2;
    }
    try {
        $root = resolvePath($positionals[1]);
        $repo = realpath(REPO);
        if ($root === '/' || $root === $repo || str_starts_with($root, $repo . '/')) {
            fwrite(STDERR, "control.php: error: Use a scratch directory outside the checkout\n");

            return 2;
        }
        match ($positionals[0]) {
            'launch' => launch($root),
            'doctor' => doctor($root),
            'sql' => print sql(load($root), $positionals[2]),
            'cleanup' => cleanup($root),
        };

        return 0;
    } catch (Throwable $error) {
        fwrite(STDERR, 'control.php: ' . $error->getMessage() . "\n");

        return 1;
    }
}

if (realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    exit(main(array_slice($argv, 1)));
}
