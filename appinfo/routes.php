<?php
/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\DNSUpdater\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
	   ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
	   ['name' => 'page#do_echo', 'url' => '/echo', 'verb' => 'POST'],
	   ['name' => 'settings#gettime', 'url' => '/time/{service}', 'verb' => 'POST'],
       ['name' => 'settings#getProviders', 'url' => '/providers', 'verb' => 'POST'],
       ['name' => 'settings#saveDNSentries', 'url' => '/savedns', 'verb' => 'POST'],
    ]
];
