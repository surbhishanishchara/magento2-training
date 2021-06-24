<?php

namespace TrainingSurbhi\AffectedProduct\Model;

use Magento\Framework\DataObject\IdentityInterface;

class Product extends \Magento\Framework\Model\AbstractModel implements IdentityInterface
{

    const CACHE_TAG = 'catalog_product_entity';
    protected $_cacheTag = 'catalog_product_entity';
    protected $_eventPrefix = 'catalog_product_entity';

    protected function _construct()
    {
        $this->_init('TrainingSurbhi\AffectedProduct\Model\ResourceModel\Product');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getProducts(\TrainingSurbhi\AffectedProduct\Model\Product $Product)
    {
        $tbl = $this->getResource()->getTable(\TrainingSurbhi\AffectedProduct\Model\ResourceModel\Product::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['entity_id']
        )
        ->where(
            'entity_id = ?',
            (int)$object->getId()
        );
        return $this->getResource()->getConnection()->fetchCol($select);
    }
}