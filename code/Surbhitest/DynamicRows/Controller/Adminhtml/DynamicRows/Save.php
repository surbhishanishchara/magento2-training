<?php

namespace Surbhitest\DynamicRows\Controller\Adminhtml\DynamicRows;

class Save extends \Magento\Backend\App\Action
{

    protected $dynamicRowsRow;
    protected $dynamicRowsRowResource;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Surbhitest\DynamicRows\Model\DynamicRowsFactory $dynamicRowsFactory,
        \Surbhitest\DynamicRows\Model\ResourceModel\DynamicRowsFactory $dynamicRowsRowResource
    ) {
        parent::__construct($context);
        $this->dynamicRowsRow         = $dynamicRowsFactory;
        $this->dynamicRowsRowResource = $dynamicRowsRowResource;
    }

    public function execute()
    {
        try {
            $dynamicRowsRowResource = $this->dynamicRowsRowResource->create();
            $dynamicRowsData     = $this->getRequest()->getParam('dynamic_rows_container');
            $dynamicRowsRowResource->deletedynamicRows();
            if (is_array($dynamicRowsData) && !empty($dynamicRowsData)) {
                foreach ($dynamicRowsData as $dynamicRowsDatum) {
                    $model = $this->dynamicRowsRow->create();
                    unset($dynamicRowsDatum['dynamic_rows_id']);
                    $model->addData($dynamicRowsDatum);
                    $model->save();
                }
            }
            $this->messageManager->addSuccessMessage(__('Rows have been saved successfully'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('*/*/index/scope/stores');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Surbhitest_DynamicRows::dynamic_rows');
    }
}