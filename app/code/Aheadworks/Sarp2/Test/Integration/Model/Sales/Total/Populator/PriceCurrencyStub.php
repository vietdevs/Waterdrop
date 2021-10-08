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
namespace Aheadworks\Sarp2\Test\Integration\Model\Sales\Total\Populator;

use Magento\Directory\Model\PriceCurrency;

/**
 * Class PriceCurrencyStub
 * @package Aheadworks\Sarp2\Test\Integration\Model\Sales\Total\Populator
 */
class PriceCurrencyStub extends PriceCurrency
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function convert($amount, $scope = null, $currency = null)
    {
        return $amount * 1.5;
    }
}
