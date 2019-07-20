<?php namespace App;

use Cache;
use File;

class WhoisQuery
{
    protected $data;
    protected $domain;
    protected $servers;
    protected $subdomain;
    protected $tlds;

    public function __construct($domain)
    {
        $this->domain = idn_to_ascii($domain, IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);

        $this->servers = json_decode(
            File::get(base_path('database/whois_servers.json')),
            true
        );

        $this->fillSubdomainAndTld($this->domain);
    }

    public function getDnsRecords()
    {
        $ipv4 = $ipv6 = $mx = $ns = [];

        // Без точки, в случае отсутствия записей у домена, запрос
        // будет произведен к текущему домену сервера, что вернет
        // совершенно нерелевантные данные
        if ($this->domain != "{$this->subdomain}.{$this->tlds}") {
            // Запрос для домена третьего и более уровня
            $ips = array_merge(
                (array) @dns_get_record("{$this->subdomain}.{$this->tlds}.", DNS_NS),
                (array) @dns_get_record("{$this->domain}.")
            );
        } else {
            // Первый запрос хорошо работает в продакшне, второй — на локале
            // Приходится оставлять оба, иначе велик риск получения пустых ответов
            $ips = array_merge(
                (array) @dns_get_record("{$this->domain}."),
                (array) @dns_get_record("{$this->domain}.", DNS_ALL)
            );
        }

        if (empty($ips)) {
            return [];
        }

        foreach ($ips as $row) {
            switch ($row['type']) {
                case 'A':    $ipv4[] = $row['ip']; break;
                case 'AAAA': $ipv6[] = $row['ipv6']; break;
                case 'MX':   $mx[] = $row['target']; break;
                case 'NS':   $ns[] = $row['target']; break;
            }
        }

        $ipv4 = array_unique($ipv4);
        $ipv6 = array_unique($ipv6);
        $mx = array_unique($mx);
        $ns = array_unique($ns);

        asort($ipv4);
        asort($ipv6);
        asort($mx);
        asort($ns);

        return [
            'ipv4' => implode(' ', $ipv4),
            'ipv6' => implode(' ', $ipv6),
            'mx'   => implode(' ', $mx),
            'ns'   => implode(' ', $ns),
        ];
    }

    public function getRaw()
    {
        if ($this->data) {
            return $this->data;
        }

        if (!$this->isValid()) {
            return "Domainname isn't valid!";
        }

        $cacheEntry = CacheKey::key(CacheKey::DOMAINS_WHOIS, "{$this->subdomain}.{$this->tlds}");
        $whoisServer = $this->servers[$this->tlds][0];

        if (!$whoisServer) {
            return "No whois server for this tld in list!";
        }

        return $this->data = Cache::remember($cacheEntry, now()->addMinutes(15), function () use ($whoisServer) {
            if (preg_match("/^https?:\/\//i", $whoisServer)) {
                $string = $this->curlRequest($whoisServer);
            } else {
                $string = $this->socketRequest($whoisServer);
            }

            $encoding = mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true);
            $utf8 = mb_convert_encoding($string, "UTF-8", $encoding);

            return htmlspecialchars($utf8, ENT_COMPAT, "UTF-8", true);
        });
    }

    public function parse()
    {
        $data = [];

        foreach (explode("\n", $this->getRaw()) as $line) {
            if (false === strpos($line, ':')) {
                continue;
            }

            list($var, $value) = explode(':', $line, 2);
            $var = strtolower(trim($var));
            $value = trim($value);

            if (!$value) {
                continue;
            }

            switch ($this->tlds) {
                case 'aero':
                case 'biz':
                case 'com':
                case 'info':
                case 'net':
                case 'org':

                    switch ($var) {
                        case 'created on': // aero
                        case 'creation date': // com & net
                        case 'domain registration date': // biz

                            $data['registered_at'] = $value;

                        break;
                        case 'domain expiration date': // biz
                        case 'expiration date': // com & net
                        case 'expires on': // aero
                        case 'registry expiry date':
                        case 'registrar registration expiration date'; // com

                            $data['paid_till'] = $value;

                        break;
                    }

                break;
                case 'com.ua':
                case 'ru':
                case 'su':
                case 'xn--p1ai':

                    switch ($var) {
                        case 'created':

                            $data['registered_at'] = str_replace('.', '-', $value);

                        break;
                        case 'expires': // com.ua
                        case 'paid-till':

                            $data['paid_till'] = str_replace('.', '-', $value);

                        break;
                    }

                break;
                case 'es':

                    switch ($var) {
                        case 'creation date':

                            $data['registered_at'] = str_replace('/', '.', $value);

                        break;
                        case 'expiration date':

                            $data['paid_till'] = str_replace('/', '.', $value);

                        break;
                    }

                break;
            }
        }

        return $data;
    }

    public function isValid()
    {
        if (isset($this->servers[$this->tlds][0]) &&
            strlen($this->servers[$this->tlds][0]) > 6)
        {
            $tmpDomain = strtolower($this->subdomain);

            if (preg_match("/^[a-z0-9\-]{3,}$/", $tmpDomain) &&
                !preg_match("/^-|-$/", $tmpDomain))
            {
                return true;
            }
        }

        return false;
    }

    protected function curlRequest($whoisServer)
    {
        $url = "{$whoisServer}{$this->subdomain}.{$this->tlds}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $data = curl_exec($ch);

        if (curl_error($ch)) {
            return "Connection error!";
        }

        $string = strip_tags($data);
        curl_close($ch);

        return $string;
    }

    protected function fillSubdomainAndTld($domain)
    {
        list($this->subdomain, $this->tlds) = explode('.', $domain, 2);

        if (!isset($this->servers[$this->tlds][0]) && strpos($this->tlds, '.')) {
            $this->fillSubdomainAndTld($this->tlds);
        }
    }

    protected function socketRequest($whoisServer)
    {
        if (false === $fp = fsockopen($whoisServer, 43)) {
            return "Connection error!";
        }

        $dom = "{$this->subdomain}.{$this->tlds}";
        fputs($fp, "$dom\r\n");
        stream_set_timeout($fp, 5);

        $info = stream_get_meta_data($fp);
        $string = '';

        while (!feof($fp) && !$info['timed_out']) {
            $line = fgets($fp, 128);
            $string .= $line;

            $info = stream_get_meta_data($fp);
        }

        if ($info['timed_out']) {
            return 'Connection timed out';
        }

        fclose($fp);

        return $string;
    }
}
