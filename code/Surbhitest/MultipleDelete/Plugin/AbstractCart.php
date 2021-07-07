<?php

namespace Surbhitest\MultipleDelete\Plugin;

class AbstractCart
{
    public function afterGetItemRenderer(\Magento\Checkout\Block\Cart\AbstractCart $subject, $result)
    {
        $result->setTemplate('Surbhitest_MultipleDelete::cart/item/default.phtml');
        return $result;
    }
}