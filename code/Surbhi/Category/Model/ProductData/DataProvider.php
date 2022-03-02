<?php

namespace Surbhi\Category\Model\ProductData;

use Surbhi\Category\Model\ResourceModel\ProductData\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Stdlib\ArrayManager;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Surbhi\Category\Model\ResourceModel\ProductData\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var
     */
    protected $loadedData;


    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlInterface;

    /**
     * @var \Magento\Framework\Json\Helper\Data
     */
    protected $jsonHelper;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        ArrayManager $arrayManager,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->arrayManager = $arrayManager;
        $this->urlInterface = $urlInterface;
        $this->jsonHelper = $jsonHelper;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var $model \Surbhi\Category\Model\ProductData */
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $this->_extractData($model->getData());
        }
        $data = $this->dataPersistor->get('product_details');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('product_details');
        }
        return $this->loadedData;
    }

}