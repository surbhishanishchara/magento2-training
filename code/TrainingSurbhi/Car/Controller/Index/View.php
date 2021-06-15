<?php

namespace TrainingSurbhi\Car\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\NotFoundException;
use TrainingSurbhi\Car\Block\CarView;

class View extends \Magento\Framework\App\Action\Action
{
	protected $_carview;

	public function __construct(
        Context $context,
        CarView $carview
    ) {
        $this->_carview = $carview;
        parent::__construct($context);
    }

	public function execute()
    {
    	if(!$this->_carview->getSingleData()){
    		throw new NotFoundException(__('Parameter is incorrect.'));
    	}
    	
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}
