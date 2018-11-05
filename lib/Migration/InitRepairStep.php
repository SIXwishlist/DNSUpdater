<?php
namespace OCA\DNSUpdater\Migration;


use OCP\Migration\IOutput;
use OCP\Migration\IRepairStep;
use OCP\IConfig;

class InitRepairStep implements IRepairStep {

    /** @var array */
    private $dnsservices = array(
		'Strato' => array(
			'baseUrl' => 'dyndns.strato.com/nic/update?system=dyndns',
			'domain' => 'hostname=',
			'ip' => 'myip=',
		),
		'Strato2' => array(
				'baseUrl' => 'dyndns.strato.com/nic/update?system=dyndns',
				'domain' => 'hostname=',
				'ip' => 'myip=',
			),
	);

    /** @var array */
    private $ipservices = array(
        'ipinfo.io' => 'http://ipinfo.io/ip',
        'ifconfig.me' => 'http://ifconfig.me/ip',
        'ipecho.net' => 'https://ipecho.net/plain',
        'ident.me' => 'http://v4.ident.me/',
        'whatismyipaddress.com' => 'http://ipv4bot.whatismyipaddress.com/',
        'ipify.org' => 'https://api.ipify.org/',
    );

    /** @var IConfig */
    private $config;

    /** @var string */
    private $appName;

    /**
    *@param IConfig $config
    *@param string $appName
    */
      public function __construct(IConfig $config, $appName) {
              $this->appName = $appName;
              $this->config = $config;
      }

      /**
       * Returns the step's name
       *@return string
       */
      public function getName() {
              return 'Initial step to set IP-Services and DNS-Providers as AppValues.';
      }

      /**
       * @param IOutput $output
       */
      public function run(IOutput $output) {
          $this->config->setAppValue($this->appName, 'ipservices',json_encode($this->ipservices));
          $this->config->setAppValue($this->appName, 'dnsservices',json_encode($this->dnsservices));
      }
}
