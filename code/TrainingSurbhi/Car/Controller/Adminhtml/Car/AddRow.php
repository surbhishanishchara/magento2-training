<?php
namespace TrainingSurbhi\Car\Controller\Adminhtml\Car;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \TrainingSurbhi\Car\Model\CarFactory
     */
    private $carFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \TrainingSurbhi\Car\Model\CarFactory $carFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \TrainingSurbhi\Car\Model\CarFactory $carFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->carFactory = $carFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->carFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
           $rowData = $rowData->load($rowId);
           $rowTitle = $rowData->getTitle();
           if (!$rowData->getCarId()) {
               $this->messageManager->addError(__('row data no longer exist.'));
               $this->_redirect('car/car/rowdata');
               return;
           }
       }
       $this->coreRegistry->register('row_data', $rowData);
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $title = $rowId ? __('Edit Car').$rowTitle : __('Add Car');
       $resultPage->getConfig()->getTitle()->prepend($title);
       return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingSurbhi_Car::add_row');
    }
}