<?php

namespace Surbhi\Category\Model\ResourceModel\ProductData;

use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'category_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'product_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Surbhi\Category\Model\ProductData::class,
            \Surbhi\Category\Model\ResourceModel\ProductData::class
        );
    }
}