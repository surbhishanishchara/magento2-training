<?php
namespace Surbhitest\TaskDemo\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class AddFreeProduct implements ObserverInterface
{
    protected $_product;
    protected $_cart;

    protected $formKey;

    public function __construct(
        \Magento\Catalog\Model\ProductFactory $product,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\Cart $cart
    ){
        $this->_product = $product;
        $this->formKey = $formKey;
        $this->_cart = $cart;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        /*$product = $observer->getEvent()->getData('product');*/
        $items = $this->_cart->getQuote()->getAllVisibleItems();
        $isFreeItem = 0;
        $isXItem = 0;
        foreach($items as $item) {
            // X is product id
            if($item->getProductId()=="164"){
                $isXItem = 1;
            }
            // Y is free product id
            if($item->getProductId()=="10"){
                $isFreeItem = 1;
            }
        }

        if(!$isFreeItem && $isXItem) {
            $params = array(
                'form_key' => $this->formKey->getFormKey(),
                'product_id' => 10, //product Id
                'qty'   =>1 //quantity of product                
            );
            $_product = $this->_product->create()->load(10);       
            $this->_cart->addProduct($_product, $params);
            $this->_cart->save();
        }
         if(!$isXItem) {
            foreach($items as $item) {
                if($item->getProductId()=="10"){
                    $itemId = $item->getItemId();
                    $this->_cart->removeItem($itemId)->save();
                }
            }
          //  $this->_cart->save();
        } 
    }
}

?>