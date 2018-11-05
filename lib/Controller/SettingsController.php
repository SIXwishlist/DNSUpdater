<?php
namespace OCA\DNSUpdater\Controller;

use OCA\DNSUpdater\Service\DNSService;
use OCA\DNSUpdater\Service\IPService;
use OCP\IRequest;
use OCP\IConfig;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

class SettingsController extends Controller {
	/** @var IConfig */
	private $config;

	/** @var $userId */
	private $userId;

	/**
	*@param string $appName
	*@param IRequest $request
	*@param IConfig $config
	*@param int $UserId
	*/
	public function __construct($appName, IRequest $request, IConfig $config, $UserId){
		parent::__construct($appName, $request);
		$this->userId = $UserId;
		$this->config = $config;
	}

	/**
	*@param string $service
	*/
	public function getTime($service){
		$ipservice = new IPService($this->config, $this->appName, $service);
		return new DataResponse(array(
			'time' => $ipservice->getExecutionTime($service),
			)
		);
	}

}
