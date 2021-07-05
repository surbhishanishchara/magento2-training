<?php
namespace Surbhitest\DynamicRows\Model;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $loadedData;
    protected $rowCollection;
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Surbhitest\DynamicRows\Model\ResourceModel\DynamicRows\Collection $collection,
        \Surbhitest\DynamicRows\Model\ResourceModel\DynamicRows\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection    = $collection;
        $this->rowCollection = $collectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $collection = $this->rowCollection->create();
        $items      = $collection->getItems();
        foreach ($items as $item) {
            $this->loadedData['stores']['dynamic_rows_container'][] = $item->getData();
        }

        return $this->loadedData;
    }
}
