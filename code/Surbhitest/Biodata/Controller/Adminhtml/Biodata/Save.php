<?php

namespace  Surbhitest\Biodata\Controller\Adminhtml\Biodata;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Surbhitest\Biodata\Model\BiodataFactory
     */
    var $biodataFactory;
    var $_fileUploaderFactory;
    var $_filesystem;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Surbhitest\Biodata\Model\BiodataFactory $biodataFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Surbhitest\Biodata\Model\BiodataFactory $biodataFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->biodataFactory = $biodataFactory;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_filesystem = $filesystem;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('biodata/biodata/addrow');
            return;
        }
        try {
            $rowData = $this->biodataFactory->create();
            
            /* for upload image */
            /* $uploader = $this->_fileUploaderFactory->create(['fileId' => 'candidate_image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
            $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
            ->getAbsolutePath('biodata_image/');
            $uploader->save($path);

            if(isset($_FILES['candidate_image']['name']) && !empty($_FILES['candidate_image']['name'])){
                $data['candidate_image'] = $_FILES['candidate_image']['name'];
            } */
            
            if(is_array($data['hobby']) && !empty($data['hobby'])){
                $data['hobby'] = implode(',',$data['hobby']);
            }
            if(!empty($data['candidate_image']))$data['candidate_image'] = $data['candidate_image'][0]['name'] ;
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setBiodataId($data['id']);
            }
            $rowData->save();

            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('biodata/biodata/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Surbhitest_Biodata::save');
    }
}