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
namespace Aheadworks\Sarp2\Model\Plan;

use Aheadworks\Sarp2\Api\PlanRepositoryInterface;
use Aheadworks\Sarp2\Model\Plan\Source\Status as PlanStatus;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Checker
 * @package Aheadworks\Sarp2\Model\Plan
 */
class Checker
{
    /**
     * @var PlanRepositoryInterface
     */
    private $planRepository;

    /**
     * @param PlanRepositoryInterface $planRepository
     */
    public function __construct(
        PlanRepositoryInterface $planRepository
    ) {
        $this->planRepository = $planRepository;
    }

    /**
     * Checks if the plan is enabled
     *
     * @param int $planId
     * @return bool
     */
    public function isEnabled($planId)
    {
        try {
            $plan = $this->planRepository->get($planId);
            $result = $plan->getStatus() == PlanStatus::ENABLED;
        } catch (LocalizedException $e) {
            $result = false;
        }

        return $result;
    }
}
