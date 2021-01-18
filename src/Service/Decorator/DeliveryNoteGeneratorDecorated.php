<?php declare(strict_types = 1);
/**
 * Copyright (c) Web Loupe. All rights reserved.
 * This file is part of software that is released under a proprietary license.
 * You must not copy, modify, distribute, make publicly available, or execute
 * its contents or parts thereof without express permission by the copyright
 * holder, unless otherwise permitted by law.
 */

namespace Welo\PlatformInvoicePhoneNumber\Service\Decorator;

use Shopware\Core\Checkout\Document\DocumentConfiguration;
use Shopware\Core\Checkout\Document\DocumentGenerator\DocumentGeneratorInterface;
use Shopware\Core\Checkout\Order\OrderEntity;
use Shopware\Core\Framework\Context;
use Welo\PlatformInvoicePhoneNumber\Service\Configuration;

/**
 * Class DeliveryNoteGeneratorDecorated
 *
 * @author    Cyprien Nkeneng <cyprien.nkeneng@webloupe.de> - www.webloupe.de
 * @copyright Copyright (c) 2017-2020 WEB LOUPE
 * @package   Welo\PlatformInvoicePhoneNumber\Service\Decorator
 * @link      https://www.webloupe.de
 * @version   1
 */
class DeliveryNoteGeneratorDecorated implements DocumentGeneratorInterface
{
    /** @var DocumentGeneratorInterface  */
    private $decoratedService;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * InvoiceGeneratorDecorated constructor.
     *
     * @param DocumentGeneratorInterface $invoiceGenerator
     * @param Configuration $configuration
     */
    public function __construct(
        DocumentGeneratorInterface $invoiceGenerator,
        Configuration $configuration
    ) {
        $this->decoratedService = $invoiceGenerator;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(): string
    {
        return $this->decoratedService->supports();
    }

    /**
     * {@inheritdoc}
     */
    public function generate(
        OrderEntity $order,
        DocumentConfiguration $config,
        Context $context,
        ?string $templatePath = null
    ): string {

        $invoicePhoneNumber = [
            'DisplayPhoneNumber' => (bool)$this->configuration->getPluginConfig('DisplayPhoneNumberDeliveryNote'),
            'DisplayLabel' => (bool)$this->configuration->getPluginConfig('DisplayLabel'),
        ];
        $config->assign(['invoicePhoneNumberDeliveryNote' => $invoicePhoneNumber]);
        return $this->decoratedService->generate($order, $config, $context, $templatePath);
    }

    /**
     * {@inheritdoc}
     */
    public function getFileName(DocumentConfiguration $config): string
    {
        return $this->decoratedService->getFileName($config);
    }
}
