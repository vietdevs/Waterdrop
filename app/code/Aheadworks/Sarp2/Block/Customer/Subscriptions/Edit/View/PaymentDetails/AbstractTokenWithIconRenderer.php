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
namespace Aheadworks\Sarp2\Block\Customer\Subscriptions\Edit\View\PaymentDetails;

use Aheadworks\Sarp2\Model\Payment\Details\IconResolverInterface;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class AbstractTokenWithIconRenderer
 *
 * @package Aheadworks\Sarp2\Block\Customer\Subscriptions\Edit\View\PaymentDetails
 */
abstract class AbstractTokenWithIconRenderer extends AbstractTokenRenderer
{
    /**
     * @var IconResolverInterface
     */
    protected $creditCardIconResolver;

    /**
     * @param Context $context
     * @param IconResolverInterface $iconResolver
     * @param array $data
     */
    public function __construct(
        Context $context,
        IconResolverInterface $iconResolver,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->creditCardIconResolver = $iconResolver;
    }

    /**
     * Retrieve credit card icon url
     *
     * @param string $creditCardType
     * @return string
     */
    public function getIconUrl($creditCardType)
    {
        $iconData = $this->creditCardIconResolver->getIconData($creditCardType);
        return isset($iconData['url']) ? $iconData['url'] : '';
    }

    /**
     * Retrieve credit card icon height
     *
     * @param string $creditCardType
     * @return int
     */
    public function getIconHeight($creditCardType)
    {
        $iconData = $this->creditCardIconResolver->getIconData($creditCardType);
        return isset($iconData['height']) ? $iconData['height'] : 0;
    }

    /**
     * Retrieve credit card icon width
     *
     * @param string $creditCardType
     * @return int
     */
    public function getIconWidth($creditCardType)
    {
        $iconData = $this->creditCardIconResolver->getIconData($creditCardType);
        return isset($iconData['width']) ? $iconData['width'] : 0;
    }
}
