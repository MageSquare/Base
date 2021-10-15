<?php

namespace MageSquare\Base\Model\ResourceModel\Module;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_eventPrefix = 'magesquare_base_module_collection';

    protected $_eventObject = 'module_collection';

    /**
     * @var string
     */
    protected $_idFieldName = 'code';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('MageSquare\Base\Model\Module', 'MageSquare\Base\Model\ResourceModel\Module');
    }
}
