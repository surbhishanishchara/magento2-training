<?php

namespace TrainingSurbhi\CustomerIP\Controller\Adminhtml\CustomerIP;

class Save extends \Magento\Backend\App\Action
{

    protected $customerIPRow;
    protected $customerIPRowResource;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \TrainingSurbhi\CustomerIP\Model\CustomerIPFactory $customerIPFactory,
        \TrainingSurbhi\CustomerIP\Model\ResourceModel\CustomerIPFactory $customerIPRowResource
    ) {
        parent::__construct($context);
        $this->customerIPRow         = $customerIPFactory;
        $this->customerIPRowResource = $customerIPRowResource;
    }

    public function execute()
    {
        try {
            $customerIPRowResource = $this->customerIPRowResource->create();
            $CustomerIPData     = $this->getRequest()->getParam('customer_ip_address_container');
            $customerIPRowResource->deleteCustomerIP();
            if (is_array($CustomerIPData) && !empty($CustomerIPData)) {
                foreach ($CustomerIPData as $CustomerIPDatum) {
                    $model = $this->customerIPRow->create();
                    unset($CustomerIPDatum['customer_ip_id']);
                    $model->addData($CustomerIPDatum);
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
        return $this->_authorization->isAllowed('TrainingSurbhi_CustomerIP::ipaddress');
    }
}