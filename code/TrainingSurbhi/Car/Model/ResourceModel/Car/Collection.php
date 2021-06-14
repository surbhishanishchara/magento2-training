<?php
namespace TrainingSurbhi\Car\Model\ResourceModel\Car;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'car_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('TrainingSurbhi\Car\Model\Car', 'TrainingSurbhi\Car\Model\ResourceModel\Car');
    }
}