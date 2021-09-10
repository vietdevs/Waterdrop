<?php
/**
 * Venustheme
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Venustheme.com license that is
 * available through the world-wide-web at this URL:
 * http://www.landofcoder.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Venustheme
 * @package    Lof_SmtpEmail
 * @copyright  Copyright (c) 2016 Venustheme (http://www.landofcoder.com/)
 * @license    http://www.landofcoder.com/LICENSE-1.0.html
 */
namespace Lof\SmtpEmail\Model\ResourceModel\Spam;

use \Lof\SmtpEmail\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{

     /**
     * @var string
     */
    protected $_idFieldName = 'spam_id';

    protected function _construct()
    {
        $this->_init('Lof\SmtpEmail\Model\Spam', 'Lof\SmtpEmail\Model\ResourceModel\Spam');
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }

}
