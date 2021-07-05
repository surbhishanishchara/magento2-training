<?php

namespace Surbhitest\DynamicRows\Model\ResourceModel\DynamicRows;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'dynamic_rows_id';

    protected function _construct()
    {
        $this->_init(
            'Surbhitest\DynamicRows\Model\DynamicRows',
            'Surbhitest\DynamicRows\Model\ResourceModel\DynamicRows'
        );

    }

}
