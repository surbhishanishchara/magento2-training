<?php
  
namespace TrainingSurbhi\CustomerIP\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Exception\LocalizedException;
 
class CustomerIPRestriction implements ObserverInterface
{
    private $remoteAddress;
    protected $rowCollection;
    protected $collection;
    protected $helperData;

    public function __construct(
        RemoteAddress $remoteAddress,
        \TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIP\Collection $collection,
        \TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIP\CollectionFactory $collectionFactory,
        \TrainingSurbhi\CustomerIP\Helper\Data $helperData
    ) {
        $this->remoteAddress = $remoteAddress;
        $this->collection    = $collection;
        $this->rowCollection = $collectionFactory;
        $this->helperData = $helperData;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $current_visitor_ip = $this->remoteAddress->getRemoteAddress();

      /*$collection = $this->rowCollection->create();
        $items      = $collection->getItems();
        foreach ($items as $item) {
            $ipaddress_data = '';
            $ipaddress_data = $item->getData();
            $allowed_ip_address_arr[] = $ipaddress_data['ip_address'];
        }*/
        $is_module_enable = $this->helperData->getGeneralConfig('enable');
        if(!$is_module_enable){
            return;
        }

        $restricted_ip_address_arr = array();
        $restricted_ip_address = $this->helperData->getGeneralConfig('restricted_ip_address');
        $restricted_ip_address_arr = explode(",",$restricted_ip_address);

        if(!empty($restricted_ip_address_arr)){
            if(in_array($current_visitor_ip,$restricted_ip_address_arr)){
                throw new LocalizedException(__('Your IP Address has been blocked for Login !! Please contact admin for further details.'));
            }else {
               return;
            }
        }else {
            return;
        }
    }
}