<?php

namespace TrainingSurbhi\Car\Block;

use Magento\Framework\View\Element\Template\Context;
use TrainingSurbhi\Car\Model\CarFactory;
use Magento\Cms\Model\Template\FilterProvider;
/**
 * CarView View block
 */
class CarView extends \Magento\Framework\View\Element\Template
{
    /**
     * @var carfactory
     */
    protected $_carfactory;
    public function __construct(
        Context $context,
        CarFactory $carfactory,
        FilterProvider $filterProvider
    ) {
        $this->_carfactory = $carfactory;
        $this->_filterProvider = $filterProvider;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Car View Page'));
        
        return parent::_prepareLayout();
    }

    public function getSingleData()
    {
        $id = $this->getRequest()->getParam('id');
        $carfactory = $this->_carfactory->create();
        $singleData = $carfactory->load($id);
        if($singleData->getCarId() && $singleData->getIsActive() == 1){
            return $singleData;
        }else{
            return false;
        }
    }
}