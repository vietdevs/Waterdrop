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
namespace Aheadworks\Sarp2\Model\Quote\Item\Grouping;

use Magento\Framework\ObjectManagerInterface;

/**
 * Class CriterionFactory
 * @package Aheadworks\Sarp2\Model\Quote\Item\Grouping
 */
class CriterionFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Create grouping criterion instance
     *
     * @param string $className
     * @return CriterionInterface
     */
    public function create($className)
    {
        $instance = $this->objectManager->create($className);
        if (!$instance instanceof CriterionInterface) {
            throw new \InvalidArgumentException(
                $className . ' doesn\'t implement ' . CriterionInterface::class
            );
        }
        return $instance;
    }
}
