<?php

namespace TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIP;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'customer_ip_id';

    protected function _construct()
    {
        $this->_init(
            'TrainingSurbhi\CustomerIP\Model\CustomerIP',
            'TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIP'
        );

    }

}
