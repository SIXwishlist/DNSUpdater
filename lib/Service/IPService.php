<?php
namespace OCA\DNSUpdater\Service;

use OCP\IConfig;

class IPService {

	/** @var array */
	private $curlresult;

	/** @var IConfig */
    private $config;

    /** @var string */
    private $appName;

    /**
    *@param IConfig $config
    *@param string $appName
	*@param string $service
    */
	public function __construct(IConfig $config, $appName, $service) {
			$this->appName = $appName;
			$this->config = $config;
			$this->execIPRequest($service);
	}

	/**
	*@param string $service
	*/
	private function execIPRequest($service){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, json_decode(
			$this->config->getAppValue($this->appName,'ipservices'),
			true
		)[$service]);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		$ip=preg_replace( "/\r|\n/", "", curl_exec($ch) );
		$this->curlresult = curl_getinfo($ch);
		$this->curlresult['ip'] = (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ? $ip : false);
		curl_close($ch);
	}

	public function getExecutionTime(){
		return ($this->curlresult['http_code']) == 200 ? number_format((float) $this->curlresult['total_time'],2) : 0;
	}


	public function getPublicIP($service){
		$this->execIPRequest($service);
		return $this->curlresult['ip'];
	}

}
