<?php
/**
 * Copyright (c) Web Loupe. All rights reserved.
 * This file is part of software that is released under a proprietary license.
 * You must not copy, modify, distribute, make publicly available, or execute
 * its contents or parts thereof without express permission by the copyright
 * holder, unless otherwise permitted by law.
 */

namespace Welo\PlatformInvoicePhoneNumber\Service;

use Shopware\Core\System\SystemConfig\SystemConfigService;

/**
 * Class Configuration
 *
 * @author    Cyprien Nkeneng <cyprien.nkeneng@webloupe.de>
 * @copyright Copyright (c) 2017-2020 WEB LOUPE
 * @package   Welo\PlatformInvoicePhoneNumber\Service
 * @version   1
 */
class Configuration
{
    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    public const WELO_CONFIG_DOMAIN = 'WeloPlatformInvoicePhoneNumber.config.';

    /**
     * Configuration constructor.
     *
     * @param SystemConfigService $systemConfigService
     */
    public function __construct(SystemConfigService $systemConfigService) {
        $this->systemConfigService = $systemConfigService;
    }

    /**
     * @param $key
     * @return bool|mixed
     * @throws \Exception
     */
    public function getPluginConfig($key)
    {
        return $this->systemConfigService->get(self::WELO_CONFIG_DOMAIN . $key);
    }
}
