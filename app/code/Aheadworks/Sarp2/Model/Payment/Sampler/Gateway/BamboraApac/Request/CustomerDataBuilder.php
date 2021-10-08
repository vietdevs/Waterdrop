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
namespace Aheadworks\Sarp2\Model\Payment\Sampler\Gateway\BamboraApac\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;
use Aheadworks\Sarp2\Model\Payment\Sampler\Gateway\SubjectReader;

/**
 * Class CustomerDataBuilder
 *
 * @package Aheadworks\Sarp2\Model\Payment\Sampler\Gateway\BamboraApac\Request
 */
class CustomerDataBuilder implements BuilderInterface
{
    /**
     * Customer number
     */
    const CUSTOMER_NUMBER = 'CustNumber';

    /**
     * @var SubjectReader
     */
    private $subjectReader;

    /**
     * @param SubjectReader $subjectReader
     */
    public function __construct(SubjectReader $subjectReader)
    {
        $this->subjectReader = $subjectReader;
    }

    /**
     * {@inheritdoc}
     */
    public function build(array $buildSubject)
    {
        $paymentDO = $this->subjectReader->readPayment($buildSubject);

        $profile = $paymentDO->getProfile();
        $billingAddress = $profile->getBillingAddress();

        return [
            self::CUSTOMER_NUMBER => $billingAddress->getCustomerId()
        ];
    }
}
