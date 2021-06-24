<?php

namespace TrainingSurbhi\AffectedProduct\Model\ResourceModel;

class Product extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    const TBL_ATT_PRODUCT = 'catalog_product_entity';

   
    protected $_date;


    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }


    protected function _construct()
    {
        $this->_init('catalog_product_entity', 'entity_id');
    }

 
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }

        $object->setUpdateTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }
}