<?php

namespace TrainingSurbhi\AdditionalFee\Model\Total;


class OrderFee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
  
    protected $quoteValidator = null; 
    protected $helperData;
    protected $cart;

    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator, 
    \TrainingSurbhi\AdditionalFee\Helper\Data $helperData,
    \Magento\Checkout\Model\Cart $cart
    )
    {
        $this->quoteValidator = $quoteValidator;
        $this->helperData = $helperData;
        $this->cart = $cart;
    }
  public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        $order_fee =  $this->helperData->getGeneralConfig('order_processing_fee');

        $totals = $this->cart->getQuote()->getTotals();
        $subtotal = $totals['subtotal']['value'];

        if(!empty($subtotal) && !empty($order_fee)){
            $order_fee = (($subtotal * $order_fee)/100);
        }
        $exist_amount = 0; 
        $order_fee = $order_fee;
        $balance = $order_fee - $exist_amount;

        $total->setTotalAmount('order_fee', $balance);
        $total->setBaseTotalAmount('order_fee', $balance);

        $total->setFee($balance);
        $total->setBaseFee($balance);

      //  $total->setGrandTotal($total->getGrandTotal() + $balance);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() + $balance);


        return $this;
    } 

    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }
   
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $order_fee =  $this->helperData->getGeneralConfig('order_processing_fee');
 
        if(!empty($subtotal) && !empty($order_fee)){
            $order_fee = (($subtotal * $order_fee)/100);
        }
        return [
            'code' => 'order_fee',
            'title' => 'Order Processing Fee',
            'value' => $order_fee
        ];
    }

    public function getLabel()
    {
        return __('Order Processing Fee');
    }
}