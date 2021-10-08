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
namespace Aheadworks\Sarp2\Controller\Adminhtml\Subscription;

use Aheadworks\Sarp2\Api\ProfileManagementInterface;
use Aheadworks\Sarp2\Model\Profile\Source\Status;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Renew
 *
 * @package Aheadworks\Sarp2\Controller\Adminhtml\Subscription
 */
class Renew extends Action
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Aheadworks_Sarp2::subscriptions';

    /**
     * @var ProfileManagementInterface
     */
    private $profileManagement;

    /**
     * @param Context $context
     * @param ProfileManagementInterface $profileManagement
     */
    public function __construct(
        Context $context,
        ProfileManagementInterface $profileManagement
    ) {
        parent::__construct($context);
        $this->profileManagement = $profileManagement;
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $profileId = $this->getRequest()->getParam('profile_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($profileId) {
            try {
                $this->profileManagement->renew($profileId);
                $this->messageManager->addSuccessMessage(__('The subscription was successfully renewed.'));
                return $resultRedirect->setPath('*/subscription/view/', ['profile_id' => $profileId]);
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            } catch (\Exception $exception) {
                $this->messageManager->addExceptionMessage(
                    $exception,
                    __('Something went wrong while renew the subscription.')
                );
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
