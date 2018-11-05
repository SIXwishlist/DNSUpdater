<?php
namespace OCA\DNSUpdater\Service;

class DNSService {
	private $curlresult;

	private function execIPRequest($service){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->ipservices[$service]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla');
		$ip=preg_replace( "/\r|\n/", "", curl_exec($ch) );
		$this->curlresult = curl_getinfo($ch);
		$this->curlresult['ip'] = (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? $ip : false);
		curl_close($ch);
	}
}
