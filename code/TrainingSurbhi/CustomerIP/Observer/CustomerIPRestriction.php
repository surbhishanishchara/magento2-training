<?php
  
namespace TrainingSurbhi\CustomerIP\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Exception\LocalizedException;
 
class CustomerIPRestriction implements ObserverInterface
{
    private $remoteAddress;

    public function __construct(
        RemoteAddress $remoteAddress
    ) {
        $this->remoteAddress = $remoteAddress;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $current_visitor_ip = $this->remoteAddress->getRemoteAddress();
        if($current_visitor_ip == '127.0.0.1'){
            return;
        }else {
            throw new LocalizedException(__('Your IP Address has been blocked for Login !! Please contact admin for further details.'));
        }
    }

}