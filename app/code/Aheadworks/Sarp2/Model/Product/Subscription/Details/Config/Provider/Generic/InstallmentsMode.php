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
namespace Aheadworks\Sarp2\Model\Product\Subscription\Details\Config\Provider\Generic;

use Aheadworks\Sarp2\Api\Data\ProfileInterface;
use Aheadworks\Sarp2\Api\Data\ProfileItemInterface;
use Aheadworks\Sarp2\Api\Data\SubscriptionOptionInterface;
use Aheadworks\Sarp2\Api\PlanRepositoryInterface;
use Aheadworks\Sarp2\Api\SubscriptionOptionRepositoryInterface;
use Aheadworks\Sarp2\Model\Product\Subscription\Details\Config\Provider\ConfigInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;

class InstallmentsMode implements ConfigInterface
{
    /**
     * @var SubscriptionOptionRepositoryInterface
     */
    private $optionsRepository;

    /**
     * @var PlanRepositoryInterface
     */
    private $planRepository;

    /**
     * @param SubscriptionOptionRepositoryInterface $optionsRepository
     * @param PlanRepositoryInterface $planRepository
     */
    public function __construct(
        SubscriptionOptionRepositoryInterface $optionsRepository,
        PlanRepositoryInterface $planRepository
    ) {
        $this->optionsRepository = $optionsRepository;
        $this->planRepository = $planRepository;
    }

    /**
     * Get installments mode config
     *
     * @param ProductInterface $product
     * @param ProfileItemInterface|null $item
     * @param ProfileInterface|null $profile
     * @return array
     * @throws LocalizedException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getConfig($product, $item = null, $profile = null)
    {
        $installmentsModeInfo = [];
        $subscriptionOptions = $this->optionsRepository->getList($product->getId());

        foreach ($subscriptionOptions as $option) {
            $installmentsModeInfo[$option->getOptionId()] = $this->getInstallmentModeInfo($option);
        }

        return $installmentsModeInfo;
    }

    /**
     * Get installment mode info
     *
     * @param SubscriptionOptionInterface $option
     * @return array
     * @throws LocalizedException
     */
    protected function getInstallmentModeInfo($option)
    {
        $planDefinition = $this->planRepository->get($option->getPlanId())->getDefinition();
        $billingCycles = $planDefinition->getTotalBillingCycles();

        return [
            'enabled' => $option->getIsInstallmentsMode() && $billingCycles > 0,
            'billingCycles' => $billingCycles,
            'isTrial' => (bool)$planDefinition->getIsTrialPeriodEnabled()
        ];
    }
}
