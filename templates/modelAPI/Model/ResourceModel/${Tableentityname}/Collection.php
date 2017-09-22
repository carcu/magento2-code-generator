<?php

namespace ${Vendorname}\${Modulename}\Model\ResourceModel\${Tableentityname};

/**
 * Class Collection.
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = '${tableentityname}_id';

    protected function _construct()
    {
        $this->_init('${Vendorname}\${Modulename}\Model\${Tableentityname}', '${Vendorname}\${Modulename}\Model\ResourceModel\${Tableentityname}');
    }
}
