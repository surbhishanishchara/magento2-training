<?php
namespace TrainingSurbhi\Car\Controller\Adminhtml\Car;
 
use Magento\Backend\App\Action;
use Magento\Framework\UrlInterface;
 
class Delete extends Action
{
    protected $_model;
 
 
    public function __construct(
        Action\Context $context,
        \TrainingSurbhi\Car\Model\Car $model,
        UrlInterface $urlBuilder
    ) {
        parent::__construct($context);
        $this->_model = $model;
        $this->urlBuilder = $urlBuilder;
    }
 
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingSurbhi_Car::row_data_delete');
    }
 

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);

                $car_image_name = $model->getImage();
                $car_image_path = $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]).'car_image/';
            
                if(file_exists(UrlInterface::URL_TYPE_MEDIA.'/car_image/'.$car_image_name)){
                    unlink(UrlInterface::URL_TYPE_MEDIA.'/car_image/'.$car_image_name);
                }

                $model->delete();
                $this->messageManager->addSuccess(__('Car details deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Car details does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}