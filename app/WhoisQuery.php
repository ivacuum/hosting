<?php

class WhoisQuery
{
	protected $data;
    protected $domain;
    protected $servers;
    protected $subdomain;
    protected $tlds;

    public function __construct($domain)
    {
        $this->domain = idn_to_ascii($domain);
		
		list($this->subdomain, $this->tlds) = explode('.', $this->domain, 2);
		
        $this->servers = json_decode(file_get_contents(__DIR__ . '/whois.servers.json'), true);
    }

    public function getDnsRecords()
    {
	    $ipv4 = $ipv6 = $mx = $ns = [];
	    $ips = dns_get_record("{$this->domain}.", DNS_A | DNS_AAAA | DNS_MX | DNS_NS);
	    
	    foreach ($ips as $row) {
	    	switch ($row['type']) {
		    	case 'A':    $ipv4[] = $row['ip']; break;
		    	case 'AAAA': $ipv6[] = $row['ipv6']; break;
		    	case 'MX':   $mx[] = $row['target']; break;
		    	case 'NS':   $ns[] = $row['target']; break;
	    	}
	    }
	    
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
		
        $whois_server = $this->servers[$this->tlds][0];

		if (!$whois_server) {
			return "No whois server for this tld in list!";
		}
		
        // If tlds have been found
        // if whois server serve replay over HTTP protocol instead of WHOIS protocol
        if (preg_match("/^https?:\/\//i", $whois_server)) {
            $ch = curl_init();
            $url = $whois_server . $this->subdomain . '.' . $this->tlds;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $data = curl_exec($ch);

            if (curl_error($ch)) {
                return "Connection error!";
            } else {
                $string = strip_tags($data);
            }
            curl_close($ch);
        } else {
            // Getting whois information
            if (false === $fp = fsockopen($whois_server, 43)) {
                return "Connection error!";
            }

            $dom = $this->subdomain . '.' . $this->tlds;
            fputs($fp, "$dom\r\n");
			stream_set_timeout($fp, 5);
			
			$info = stream_get_meta_data($fp);
			
            // Getting string
            $string = '';

            // Checking whois server for .com and .net
            if ($this->tlds == 'com' || $this->tlds == 'net') {
                while (!feof($fp) && !$info['timed_out']) {
                    $line = trim(fgets($fp, 128));

                    $string .= $line;

                    $lineArr = explode(':', $line);

                    if (strtolower($lineArr[0]) == 'whois server') {
                        $whois_server = trim($lineArr[1]);
						fclose($fp);
						break;
                    }
					
					$info = stream_get_meta_data($fp);
                }
				
				if ($info['timed_out']) {
					return 'Connection timed out';
				}
				
                // Getting whois information
                if (false === $fp = fsockopen($whois_server, 43)) {
                    return "Connection error!";
                }

                fputs($fp, "$dom\r\n");
				stream_set_timeout($fp, 5);
				
				$info = stream_get_meta_data($fp);
				
                // Getting string
                $string = '';

                while (!feof($fp) && !$info['timed_out']) {
                    $string .= fgets($fp, 128);
					$info = stream_get_meta_data($fp);
                }
				
				if ($info['timed_out']) {
					return 'Connection timed out!';
				}

                // Checking for other tld's
            } else {
                while (!feof($fp)) {
                    $string .= fgets($fp, 128);
                }
            }
			
            fclose($fp);
        }

        $string_encoding = mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true);
        $string_utf8 = mb_convert_encoding($string, "UTF-8", $string_encoding);

        return $this->data = htmlspecialchars($string_utf8, ENT_COMPAT, "UTF-8", true);
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
		    			case 'creation date':
			    		case 'domain registration date': // biz
		    			
		    				$data['registered_at'] = $value;
		    				
		    			break;
		    			case 'domain expiration date': // biz
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
		    }
	    }
	    
	    return $data;
    }

    public function isValid()
    {
        if (
            isset($this->servers[$this->tlds][0])
            && strlen($this->servers[$this->tlds][0]) > 6
        ) {
            $tmp_domain = strtolower($this->subdomain);
            if (
                preg_match("/^[a-z0-9\-]{3,}$/", $tmp_domain)
                && !preg_match("/^-|-$/", $tmp_domain) //&& !preg_match("/--/", $tmp_domain)
            ) {
                return true;
            }
        }

        return false;
    }
}
