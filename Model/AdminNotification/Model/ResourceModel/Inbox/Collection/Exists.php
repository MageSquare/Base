<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Model\AdminNotification\Model\ResourceModel\Inbox\Collection;

class Exists extends \Magento\AdminNotification\Model\ResourceModel\Inbox\Collection
{
    /**
     * @param \SimpleXMLElement $item
     * @return bool
     */
    public function execute(\SimpleXMLElement $item)
    {
        $this->addFieldToFilter('url', (string)$item->link);

        return $this->getSize() > 0;
    }
}
