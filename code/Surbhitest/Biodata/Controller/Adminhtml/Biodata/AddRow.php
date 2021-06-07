<?php
namespace Surbhitest\Biodata\Controller\Adminhtml\Biodata;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Surbhitest\Biodata\Model\BiodataFactory
     */
    private $biodataFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Surbhitest\Biodata\Model\BiodataFactory $biodataFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Surbhitest\Biodata\Model\BiodataFactory $biodataFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->biodataFactory = $biodataFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->biodataFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
           $rowData = $rowData->load($rowId);
           $rowTitle = $rowData->getTitle();
           if (!$rowData->getBiodataId()) {
               $this->messageManager->addError(__('row data no longer exist.'));
               $this->_redirect('biodata/biodata/rowdata');
               return;
           }
       }

       $this->coreRegistry->register('row_data', $rowData);
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $title = $rowId ? __('Edit Biodata ').$rowTitle : __('Add Biodata');
       $resultPage->getConfig()->getTitle()->prepend($title);
       return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Surbhitest_Biodata::add_row');
    }
}