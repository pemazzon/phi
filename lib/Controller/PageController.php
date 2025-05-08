<?php

namespace OCA\HIP\Controller;

use OCA\HIP\AppInfo\Application;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\IRequest;
use OCP\ILogger;

/**
 * Class PageController
 *
 * @package OCA\HIP\Controller
 */
class PageController extends Controller
{
	public function __construct(ILogger $logger, IRequest $request)
	{
		parent::__construct(Application::APP_ID, $request);
		$this->logger = $logger;
	}
	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @return TemplateResponse
	 */
	public function index()
	{
		// Util::addScript(Application::APP_ID, 'index');
		
		$response = new TemplateResponse(
			Application::APP_ID,
			'index',
			[
				'appId' => $this->appName,
				'inline-settings' => 'false'
			]
		);

		$csp = new ContentSecurityPolicy();
        $csp->addAllowedFrameDomain('phi.pnc.unipd.it');
        $csp->addAllowedFrameDomain('backend.pnc.unipd.it');
        $csp->addAllowedFrameDomain('keycloak.pnc.unipd.it');
        $csp->addAllowedFrameDomain('hip-frontend');
        $csp->addAllowedFrameDomain('hip-backend02');
        $csp->addAllowedFrameDomain('keycloak');        

        $csp->addAllowedConnectDomain('phi.pnc.unipd.it');
        $csp->addAllowedConnectDomain('backend.pnc.unipd.it');
        $csp->addAllowedConnectDomain('keycloak.pnc.unipd.it');
        $csp->addAllowedConnectDomain('hip-frontend');
        $csp->addAllowedConnectDomain('hip-backend02');
        $csp->addAllowedConnectDomain('keycloak');
		$csp->addAllowedConnectDomain('stats.humanbrainproject.eu');

		$response->setContentSecurityPolicy($csp);

		return $response;
	}
}

