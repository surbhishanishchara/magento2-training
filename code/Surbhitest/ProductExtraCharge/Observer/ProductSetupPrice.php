<?php
  
    namespace Surbhitest\ProductExtraCharge\Observer;
 
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;


    class ProductSetupPrice implements ObserverInterface
    {
        public function execute(\Magento\Framework\Event\Observer $observer) {

            $product = $observer->getProduct();
            $customAttribute = $product->getCustomAttribute('product_setup_price');
            $product_setup_price = $customAttribute !== null ? $customAttribute->getValue() : null;

            if(empty($product_setup_price)){
                return;
            }
            $item = $observer->getEvent()->getData('quote_item');         
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
            $price = $item->getPrice() + $product_setup_price;
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            $item->getProduct()->setIsSuperMode(true);
        }
 
    }