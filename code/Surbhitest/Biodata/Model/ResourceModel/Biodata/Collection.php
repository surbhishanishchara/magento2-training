<?php
namespace Surbhitest\Biodata\Model\ResourceModel\Biodata;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'biodata_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Surbhitest\Biodata\Model\Biodata', 'Surbhitest\Biodata\Model\ResourceModel\Biodata');
    }
}