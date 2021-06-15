<?php

namespace TrainingSurbhi\Car\Block;

/**
 * Crudimage content block
 */
class CarData extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Car Details'));
        
        return parent::_prepareLayout();
    }
}