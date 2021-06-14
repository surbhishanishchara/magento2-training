<?php

namespace TrainingSurbhi\Car\Controller\Adminhtml\Car;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \TrainingSurbhi\Car\Model\CarFactory
     */
    var $carFactory;
    var $_fileUploaderFactory;
    var $_filesystem;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \TrainingSurbhi\Car\Model\CarFactory $carFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \TrainingSurbhi\Car\Model\CarFactory $carFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->carFactory = $carFactory;
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
            $this->_redirect('car/car/addrow');
            return;
        }
        try {
            $rowData = $this->carFactory->create();
            
            /* for upload image */
            /* $uploader = $this->_fileUploaderFactory->create(['fileId' => 'candidate_image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
            $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
            ->getAbsolutePath('car_image/');
            $uploader->save($path);

            if(isset($_FILES['candidate_image']['name']) && !empty($_FILES['candidate_image']['name'])){
                $data['candidate_image'] = $_FILES['candidate_image']['name'];
            } */
            if(is_array($data['extra_feature']) && !empty($data['extra_feature'])){
                $data['extra_feature'] = implode(',',$data['extra_feature']);
            }
            if(is_array($data['country']) && !empty($data['country'])){
                $data['country'] = implode(',',$data['country']);
            }
            if(!empty($data['image']))$data['image'] = $data['image'][0]['name'] ;
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setCarId($data['id']);
            }
            $rowData->save();

            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('car/car/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingSurbhi_Car::save');
    }
}