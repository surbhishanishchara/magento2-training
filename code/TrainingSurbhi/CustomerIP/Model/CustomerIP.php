<?php

namespace TrainingSurbhi\CustomerIP\Model;
use Magento\Framework\Model\AbstractModel;

class CustomerIP extends AbstractModel
{
    const CACHE_TAG = 'allowed_customer_ip';

    protected $_cacheTag = 'allowed_customer_ip';

    protected $_eventPrefix = 'allowed_customer_ip';

    protected function _construct()
    {
        $this->_init(\TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIP::class);
    }
}
