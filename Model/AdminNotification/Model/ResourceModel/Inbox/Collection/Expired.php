<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Model\AdminNotification\Model\ResourceModel\Inbox\Collection;

class Expired extends \Magento\AdminNotification\Model\ResourceModel\Inbox\Collection
{
    /**
     * @return \Magento\AdminNotification\Model\ResourceModel\Inbox\Collection\Unread
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addFieldToFilter('is_remove', 0)
            ->addFieldToFilter('is_magesquare', 1)
            ->addFieldToFilter('expiration_date', ['notnull' => true]);
        $this->getSelect()->where('expiration_date < NOW()');

        return $this;
    }
}
