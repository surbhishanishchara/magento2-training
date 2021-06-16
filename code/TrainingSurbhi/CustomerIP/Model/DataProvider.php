<?php
namespace TrainingSurbhi\CustomerIP\Model;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $loadedData;
    protected $rowCollection;
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIP\Collection $collection,
        \TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIP\CollectionFactory $collectionFactory,
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
            $this->loadedData['stores']['customer_ip_address_container'][] = $item->getData();
        }

        return $this->loadedData;
    }
}
