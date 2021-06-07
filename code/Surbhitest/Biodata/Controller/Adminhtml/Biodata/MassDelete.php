<?php

namespace Surbhitest\Biodata\Controller\Adminhtml\Biodata;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Surbhitest\Biodata\Model\ResourceModel\Biodata\CollectionFactory;
use Magento\Framework\UrlInterface;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Massactions filter.​_
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    protected $urlBuilder;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        UrlInterface $urlBuilder
    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;
        foreach ($collection->getItems() as $record) {
            $record->setId($record->getBiodataId());
            $biodata_image_name = $record->getCandidateImage();
            $biodata_image_path = $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]).'biodata_image/';
          
            if(file_exists(UrlInterface::URL_TYPE_MEDIA.'/biodata_image/'.$biodata_image_name)){
                unlink(UrlInterface::URL_TYPE_MEDIA.'/biodata_image/'.$biodata_image_name);
            }
            $record->delete();
            $recordDeleted++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $recordDeleted));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    /**
     * Check Category Map recode delete Permission.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Surbhitest_Biodata::row_data_delete');
    }
}