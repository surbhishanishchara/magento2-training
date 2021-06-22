<?php

namespace TrainingSurbhi\AdditionalFee\Block\Sales\Order;



class OrderFee extends \Magento\Framework\View\Element\Template
{
    
    protected $_config;

  
    protected $_order;

    protected $_source;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Tax\Model\Config $taxConfig,
        array $data = []
    ) {
        $this->_config = $taxConfig;
        parent::__construct($context, $data);
    }

    public function displayFullSummary()
    {
        return true;
    }

   
    public function getSource()
    {
        return $this->_source;
    } 
    public function getStore()
    {
        return $this->_order->getStore();
    }

 
    public function getOrder()
    {
        return $this->_order;
    }

  
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }

  
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }

     public function initTotals()
    {

        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();

        $store = $this->getStore();

        $order_fee = new \Magento\Framework\DataObject(
                [
                    'code' => 'order_fee',
                    'strong' => false,
                    'value' => 100,
                    //'value' => $this->_source->getFee(),
                    'label' => __('Order Processing Fee'),
                ]
            );

            $parent->addTotal($order_fee, 'order_fee');
           // $this->_addTax('grand_total');
            $parent->addTotal($order_fee, 'order_fee');


            return $this;
    }

}
