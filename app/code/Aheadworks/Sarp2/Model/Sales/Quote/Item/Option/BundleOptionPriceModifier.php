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
 * @version    2.15.0
 * @copyright  Copyright (c) 2021 Aheadworks Inc. (https://aheadworks.com/)
 * @license    https://aheadworks.com/end-user-license-agreement/
 */
namespace Aheadworks\Sarp2\Model\Sales\Quote\Item\Option;

use Aheadworks\Sarp2\Api\Data\SubscriptionOptionInterface;
use Aheadworks\Sarp2\Api\SubscriptionOptionRepositoryInterface;
use Aheadworks\Sarp2\Model\Plan\Resolver\ByPeriod\StrategyPool;
use Aheadworks\Sarp2\Model\Plan\Source\PriceRounding;
use Aheadworks\Sarp2\Model\Product\Subscription\Price\Calculation\Calculator;
use Magento\Catalog\Model\Product\Configuration\Item\ItemInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class BundleOptionPriceModifier
 *
 * @package Aheadworks\Sarp2\Model\Sales\Quote\Item\Option
 */
class BundleOptionPriceModifier
{
    /**
     * @var SubscriptionOptionRepositoryInterface
     */
    private $optionRepository;

    /**
     * @var Calculator
     */
    private $priceCalculator;

    /**
     * @param SubscriptionOptionRepositoryInterface $optionRepository
     * @param Calculator $priceCalculator
     */
    public function __construct(
        SubscriptionOptionRepositoryInterface $optionRepository,
        Calculator $priceCalculator
    ) {
        $this->optionRepository = $optionRepository;
        $this->priceCalculator = $priceCalculator;
    }

    /**
     * Recalculate bundle option price
     *
     * @param ItemInterface $item
     * @param float $basePrice
     * @return float
     * @throws LocalizedException
     */
    public function recalculateOptionPrice(ItemInterface $item, $basePrice)
    {
        $price = $basePrice;
        $subscriptionOption = $this->getSubscriptionOption($item);
        if ($subscriptionOption) {
            $price = $this->priceCalculator->calculateAccordingPlan(
                $basePrice,
                $subscriptionOption->getPlanId(),
                StrategyPool::TYPE_REGULAR,
                PriceRounding::DONT_ROUND
            );
        }

        return $price;
    }

    /**
     * Retrieve subscription option
     *
     * @param ItemInterface $item
     * @return SubscriptionOptionInterface|null
     */
    private function getSubscriptionOption($item)
    {
        $itemOption = $item->getOptionByCode('aw_sarp2_subscription_type');
        if ($itemOption && $itemOption->getValue()) {
            try {
                return $this->optionRepository->get($itemOption->getValue());
            } catch (NoSuchEntityException $exception) {
                return null;
            }
        }

        return null;
    }
}