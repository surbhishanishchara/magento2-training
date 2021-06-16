<?php

namespace TrainingSurbhi\CustomerIP\Controller\Adminhtml\CustomerIP;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\ImportExport\Controller\Adminhtml\Export\Index
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('TrainingSurbhi_CustomerIP::ip_address');
        $resultPage->getConfig()->getTitle()->prepend(__('Customer IP Addresss'));
        $resultPage->getConfig()->getTitle()->prepend(__('Customer IP Addresss'));
        $resultPage->addBreadcrumb(__('Customer IP Addresss'), __('Customer IP Addresss'));
        return $resultPage;

    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingSurbhi_CustomerIP::ip_address');
    }

}