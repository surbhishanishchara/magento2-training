<?php

namespace TrainingSurbhi\Car\Block;

use Magento\Framework\View\Element\Template\Context;
use TrainingSurbhi\Car\Model\CarFactory;
/**
 * Car List block
 */
class CarListData extends \Magento\Framework\View\Element\Template
{
    /**
     * @var carfactory
     */
    protected $_carfactory;
    public function __construct(
        Context $context,
        CarFactory $carfactory
    ) {
        $this->_carfactory = $carfactory;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Car List Page'));
        
        if ($this->getCarCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'trainingsurbhi.car.pager'
            )->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
                $this->getCarCollection()
            );
            $this->setChild('pager', $pager);
            $this->getCarCollection()->load();
        }
        return parent::_prepareLayout();
    }

    public function getCarCollection()
    {
        $page = ($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;

        $carfactory = $this->_carfactory->create();
        $collection = $carfactory->getCollection();
       // $collection->addFieldToFilter('status','1');
        //$carfactory->setOrder('car_id','ASC');
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);

        return $collection;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
