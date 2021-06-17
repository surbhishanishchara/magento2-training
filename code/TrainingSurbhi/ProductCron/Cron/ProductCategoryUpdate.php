<?php
namespace TrainingSurbhi\ProductCron\Cron;

use Psr\Log\LoggerInterface;

class ProductCategoryUpdate {
    protected $logger;
    protected $_productCollectionFactory;

    public function __construct(LoggerInterface $logger,
    \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory        
    ) {
        $this->logger = $logger;
        $this->_productCollectionFactory = $productCollectionFactory;    
    }

    public function execute() {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        $to = date("Y-m-d h:i:s"); // current date
        $from = strtotime('-3 day', strtotime($to));
        $from = date('Y-m-d h:i:s', $from); // 3 days before

        $collection->addFieldToFilter('created_at', array('from'=>$from, 'to'=>$to));
        //->addAttributeToFilter('category_ids','');
        $collection->addAttributeToSort('entity_id', 'DESC');
        $items = $collection->getItems();
        foreach($items as $item){
            $prd_data = $item->getName();
            $this->logger->info($prd_data);
        }
       // $this->logger->info("In collection data");
    }
}