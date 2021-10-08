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
namespace Aheadworks\Sarp2\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface PlanTitleInterface
 * @package Aheadworks\Sarp2\Api\Data
 */
interface PlanTitleInterface extends ExtensibleDataInterface
{
    /**#@+
     * Constants defined for keys of the data array.
     * Identical to the name of the getter in snake case
     */
    const PLAN_ID = 'plan_id';
    const STORE_ID = 'store_id';
    const TITLE = 'title';
    /**#@-*/

    /**
     * Get plan ID
     *
     * @return int|null
     */
    public function getPlanId();

    /**
     * Set plan ID
     *
     * @param int $planId
     * @return $this
     */
    public function setPlanId($planId);

    /**
     * Get store Id
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Set store Id
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Retrieve existing extension attributes object or create a new one
     *
     * @return \Aheadworks\Sarp2\Api\Data\PlanTitleExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object
     *
     * @param \Aheadworks\Sarp2\Api\Data\PlanTitleExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Aheadworks\Sarp2\Api\Data\PlanTitleExtensionInterface $extensionAttributes
    );
}
