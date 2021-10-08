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
 * @package    Sarp2Stripe
 * @version    1.0.6
 * @copyright  Copyright (c) 2021 Aheadworks Inc. (https://aheadworks.com/)
 * @license    https://aheadworks.com/end-user-license-agreement/
 */
namespace Aheadworks\Sarp2Stripe\Observer\Base;

use Aheadworks\Sarp2\Model\Payment\Method\Data\DataAssignerInterface;
use Magento\Framework\Event\Observer;
use Magento\Payment\Observer\AbstractDataAssignObserver;
use Magento\Quote\Api\Data\PaymentInterface;

/**
 * Class DataAssignObserver
 * @package Aheadworks\Sarp2Stripe\Observer\Base
 */
class DataAssignObserver extends AbstractDataAssignObserver
{
    /**
     * {@inheritdoc}
     */
    public function execute(Observer $observer)
    {
        $data = $this->readDataArgument($observer);
        $additionalData = $data->getData(PaymentInterface::KEY_ADDITIONAL_DATA);
        if (is_array($additionalData)) {
            $paymentInfo = $this->readPaymentModelArgument($observer);
            if (isset($additionalData[DataAssignerInterface::IS_SARP_TOKEN_ENABLED])) {
                $paymentInfo->setAdditionalInformation(
                    DataAssignerInterface::IS_SARP_TOKEN_ENABLED,
                    $additionalData[DataAssignerInterface::IS_SARP_TOKEN_ENABLED]
                );
                if ($additionalData[DataAssignerInterface::IS_SARP_TOKEN_ENABLED]) {
                    $additionalData['cc_save'] = true;
                    $data->setAdditionalData($additionalData);
                }
            }
        }
    }
}
