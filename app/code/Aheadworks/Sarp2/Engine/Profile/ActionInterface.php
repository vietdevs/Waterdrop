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
namespace Aheadworks\Sarp2\Engine\Profile;

use Magento\Framework\DataObject;

/**
 * Interface ActionInterface
 * @package Aheadworks\Sarp2\Engine\Profile
 */
interface ActionInterface
{
    /**#@+
     * Action types
     * @var string
     */
    const ACTION_TYPE_CHANGE_STATUS = 'change_status';
    const ACTION_TYPE_CHANGE_ADDRESS = 'change_address';
    const ACTION_TYPE_CHANGE_PLAN = 'change_plan';
    const ACTION_TYPE_CHANGE_NEXT_PAYMENT_DATE = 'change_next_payment_date';
    const ACTION_TYPE_CHANGE_PAYMENT_INFORMATION = 'change_payment_information';
    const ACTION_TYPE_REMOVE_ITEM = 'remove_item';
    const ACTION_TYPE_EXTEND = 'extend';
    const ACTION_TYPE_CHANGE_PRODUCT_ITEM = 'change_product_item';
    const ACTION_TYPE_SET_PAYMENT_TOKEN = 'set_payment_token';
    const ACTION_TYPE_ADD_ITEMS_FROM_QUOTE_TO_NEAREST_PROFILE = 'add_items_from_quote_to_nearest';
    /**#@-*/

    /**
     * Get action type
     *
     * @return string
     */
    public function getType();

    /**
     * Get action data
     *
     * @return DataObject
     */
    public function getData();
}
