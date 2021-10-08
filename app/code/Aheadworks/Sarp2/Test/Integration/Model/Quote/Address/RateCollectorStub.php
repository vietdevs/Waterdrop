<?php
/**
 * Aheadworks Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://aheadworks.com/end-user-license-agreement/
 *
 * @package    Sarp2
 * @version    2.15.3
 * @copyright  Copyright (c) 2021 Aheadworks Inc. (https://aheadworks.com/)
 * @license    https://aheadworks.com/end-user-license-agreement/
 */
namespace Aheadworks\Sarp2\Test\Integration\Model\Quote\Address;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Shipping\Model\Shipping;
use Magento\TestFramework\Helper\Bootstrap;

/**
 * Class RateCollectorStub
 * @package Aheadworks\Sarp2\Test\Integration\Model\Quote\Address
 */
class RateCollectorStub extends Shipping
{
    /**
     * Shipping amount
     */
    const SHIPPING_AMOUNT = 5;

    /**
     * {@inheritdoc}
     */
    public function collectRates(RateRequest $request)
    {
        /** @var Method $method */
        $method = Bootstrap::getObjectManager()->create(
            Method::class,
            [
                'data' => [
                    'code' => 'flatrate_flatrate',
                    'carrier' => 'flatrate',
                    'carrier_title' => 'Flat Rate',
                    'method' => 'flatrate',
                    'method_title' => 'Flat Rate',
                    'method_description' => 'Flat Rate - Flat Rate',
                    'price' => self::SHIPPING_AMOUNT
                ]
            ]
        );
        $this->getResult()->append($method);
        return $this;
    }
}
