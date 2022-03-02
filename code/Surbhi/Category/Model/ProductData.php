<?php

namespace Surbhi\Category\Model;

use Surbhi\Category\Api\Data\ProductDataInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class ProductData extends AbstractModel implements ProductDataInterface
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'category_collection';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Surbhi\Category\Model\ResourceModel\ProductData::class);
    }

    /**
     * Get EntitytId
     * @return int
     */
    public function geEntitytId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntitytId
     * @param int $id
     * @return $this
     */
    public function setEntitytId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Get ProductId
     * @return string|null
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Set ProductId
     * @param string $id
     * @return $this
     */
    public function setProductId($id)
    {
        return $this->setData(self::PRODUCT_ID, $id);
    }


    /**
     * Get looks ProductData
     * @return \Magento\Framework\DataObject[]|string|null
     */
    public function getProductData()
    {
        return $this->getData(self::PRODUCT_DATA);
    }

    /**
     * Set looks ProductData
     * @param \Magento\Framework\DataObject[]|string $json
     * @return $this
     */
    public function setProductData($json)
    {
        return $this->setData(self::PRODUCT_DATA, $json);
    }

    /**
     * Get created at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created at
     * @param string $date
     * @return $this
     */
    public function setCreatedAt($date)
    {
        return $this->setData(self::CREATED_AT, $date);
    }

}