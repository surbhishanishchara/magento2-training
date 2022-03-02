<?php

namespace Surbhi\Category\Api\Data;

interface ProductDataInterface
{
    const ENTITY_ID = 'entity_id';
    const PRODUCT_ID = 'product_id';
    const PRODUCT_DATA = 'product_data';
    const CREATED_AT = 'created_at';

    /**
     * Get EntitytId
     * @return int|null
     */
    public function geEntitytId();

    /**
     * Set EntitytId
     * @parm int $id
     * @return $this
     */
    public function setEntitytId($id);

    /**
     * Get ProductId
     * @return string|null
     */
    public function getProductId();

    /**
     * Set ProductId
     * @param string $id
     * @return $this
     */
    public function setProductId($id);


    /**
     * Get ProductData json data
     * @return \Magento\Framework\DataObject[]|string|null
     */
    public function getProductData();

    /**
     * Set ProductData json data
     * @param \Magento\Framework\DataObject[]|string $json
     * @return $this
     */
    public function setProductData($json);


    /**
     * Get created at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at
     * @param string $date
     * @return $this
     */
    public function setCreatedAt($date);
}