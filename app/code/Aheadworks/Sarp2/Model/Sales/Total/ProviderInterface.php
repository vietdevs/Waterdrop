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
namespace Aheadworks\Sarp2\Model\Sales\Total;

use Aheadworks\Sarp2\Api\Data\ProfileAddressInterface;
use Aheadworks\Sarp2\Api\Data\ProfileItemInterface;
use Magento\Quote\Model\Quote\Address;
use Magento\Quote\Model\Quote\Address\Item as AddressItem;

/**
 * Interface ProviderInterface
 * @package Aheadworks\Sarp2\Model\Sales\Total
 */
interface ProviderInterface
{
    /**
     * Get unit price
     *
     * @param AddressItem|ProfileItemInterface $item
     * @param bool $useBaseCurrency
     * @return float
     */
    public function getUnitPrice($item, $useBaseCurrency);

    /**
     * Get unit price including tax
     *
     * @param AddressItem|ProfileItemInterface $item
     * @param bool $useBaseCurrency
     * @return float
     */
    public function getUnitPriceInclTax($item, $useBaseCurrency);

    /**
     * Get shipping amount
     *
     * @param Address|ProfileAddressInterface $address
     * @param bool $useBaseCurrency
     * @return float
     */
    public function getShippingAmount($address, $useBaseCurrency);

    /**
     * Get address subtotal
     *
     * @param Address|ProfileAddressInterface $address
     * @param bool $useBaseCurrency
     * @return float
     */
    public function getAddressSubtotal($address, $useBaseCurrency);

    /**
     * Get address subtotal including tax
     *
     * @param Address|ProfileAddressInterface $address
     * @param bool $useBaseCurrency
     * @return float
     */
    public function getAddressSubtotalInclTax($address, $useBaseCurrency);

    /**
     * Get discount amount
     *
     * @param AddressItem|ProfileItemInterface $item
     * @param bool $useBaseCurrency
     * @return float
     */
    public function getDiscountAmount($item, $useBaseCurrency);
}
