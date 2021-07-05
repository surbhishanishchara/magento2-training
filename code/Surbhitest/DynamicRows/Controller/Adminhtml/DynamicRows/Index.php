<?php

namespace Surbhitest\DynamicRows\Controller\Adminhtml\DynamicRows;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\ImportExport\Controller\Adminhtml\Export\Index
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Surbhitest_DynamicRows::dynamic_rows');
        $resultPage->getConfig()->getTitle()->prepend(__('Dynamic Rows'));
        $resultPage->getConfig()->getTitle()->prepend(__('Dynamic Rows'));
        $resultPage->addBreadcrumb(__('Dynamic Rows'), __('Dynamic Rows'));
        return $resultPage;

    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Surbhitest_DynamicRows::dynamic_rows');
    }

}