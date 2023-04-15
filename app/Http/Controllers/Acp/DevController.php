<?php namespace App\Http\Controllers\Acp;

class DevController
{
    // Для считывания последних строк лога
    // https://gist.github.com/lorenzos/1711e81a9162320fde20
    public function logs()
    {
        $q = (string) request('q');
        $log = \App::isLocal() ? public_path('uploads/access_log') : base_path('../../logs/access_log');
        $handle = fopen($log, 'r');
        $lines = collect();

        $country = [];
        $bots = $connection = $ip = $requestMethod = $requestUri = null;

        if (\Str::contains($q, 'bots=no')) {
            $bots = false;
        } elseif (\Str::contains($q, 'bots=only')) {
            $bots = true;
        }

        if (\Str::contains($q, 'connection=')) {
            if (preg_match('/connection=([^ ]+)/', $q, $match)) {
                $connection = $match[1];
            }
        }

        if (\Str::contains($q, ['country=', 'country!='])) {
            if (preg_match('/country(!=|=)([A-Z]{2})/', $q, $match)) {
                $country = [
                    'operator' => $match[1],
                    'value' => $match[2],
                ];
            }
        }

        if (\Str::contains($q, 'ip=')) {
            if (preg_match('/ip=([^ ]+)/', $q, $match)) {
                $ip = $match[1];
            }
        }

        if (\Str::contains($q, 'request_method=')) {
            if (preg_match('/request_method=([^ ]+)/', $q, $match)) {
                $requestMethod = strtoupper($match[1]);
            }
        }

        if (\Str::contains($q, 'request_uri=')) {
            if (preg_match('/request_uri=([^ ]+)/', $q, $match)) {
                $requestUri = $match[1];
            }
        }

        if ($handle) {
            while (false !== $line = fgets($handle)) {
                if (null === $json = json_decode($line, flags: JSON_THROW_ON_ERROR)) {
                    continue;
                }

                if (!$ip && $json->ip === '77.244.79.214') {
                    continue;
                }

                if (!$q) {
                    $lines->push($json);

                    continue;
                }

                $found = false;
                $proper = true;

                if ($bots === true) {
                    if (preg_match('/(bot|spider|google|crawler|yahoo)/i', $json->user_agent)) {
                        $found = true;
                        $proper &= true;
                    } else {
                        $proper &= false;
                    }
                } elseif ($bots === false) {
                    if (!preg_match('/(bot|spider|google|crawler|yahoo)/i', $json->user_agent)) {
                        $found = true;
                        $proper &= true;
                    } else {
                        $proper &= false;
                    }
                }

                if ($connection) {
                    if ($connection === $json->connection) {
                        $found = true;
                        $proper &= true;
                    } else {
                        $proper &= false;
                    }
                }

                if (!empty($country)) {
                    if ($country['operator'] === '=' && $json->country === $country['value']) {
                        $found = true;
                        $proper &= true;
                    } elseif ($country['operator'] === '!=' && $json->country !== $country['value']) {
                        $found = true;
                        $proper &= true;
                    } else {
                        $proper &= false;
                    }
                }

                if ($ip) {
                    if ($ip === $json->ip) {
                        $found = true;
                        $proper &= true;
                    } else {
                        $proper &= false;
                    }
                }

                if ($requestMethod) {
                    if ($requestMethod === $json->request_method) {
                        $found = true;
                        $proper &= true;
                    } else {
                        $proper &= false;
                    }
                }

                if ($requestUri) {
                    if ($requestUri === $json->request_uri) {
                        $found = true;
                        $proper &= true;
                    } else {
                        $proper &= false;
                    }
                }

                if ($found && $proper) {
                    $lines->push($json);
                }
            }

            fclose($handle);
        }

        return view('acp.dev.logs', [
            'q' => $q,
            'lines' => $lines,
        ]);
    }

    public function svg()
    {
        $icons = [];

        foreach (glob(resource_path('svg/*.svg')) as $icon) {
            $icons[] = basename($icon, '.svg');
        }

        return view('acp.dev.svg', ['icons' => $icons]);
    }
}
