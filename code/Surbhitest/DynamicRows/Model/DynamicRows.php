<?php

namespace Surbhitest\DynamicRows\Model;
use Magento\Framework\Model\AbstractModel;

class DynamicRows extends AbstractModel
{
    const CACHE_TAG = 'dynamic_rows';

    protected $_cacheTag = 'dynamic_rows';

    protected $_eventPrefix = 'dynamic_rows';

    protected function _construct()
    {
        $this->_init(\Surbhitest\DynamicRows\Model\ResourceModel\DynamicRows::class);
    }
}
