<?php
namespace TrainingSurbhi\AffectedProduct\Model\ResourceModel\Product;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('TrainingSurbhi\AffectedProduct\Model\Product', 'TrainingSurbhi\AffectedProduct\Model\ResourceModel\Product');
    }
}
