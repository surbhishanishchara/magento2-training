<?php
namespace Surbhitest\RoutingExample\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
class ResposeTypeExample extends Action
{
 
    protected $pageFactory;
    protected $jsonFactory;
    protected $raw;
    protected $forwardFactory;
    protected $redirectFactory;
    public function __construct(Context $context,PageFactory $pageFactory,
JsonFactory $jsonFactory,Raw $raw,ForwardFactory $forwardFactory,
RedirectFactory $redirectFactory)
    {
        $this->forwardFactory=$forwardFactory;
        $this->jsonFactory=$jsonFactory;
        $this->pageFactory=$pageFactory;
        $this->raw=$raw;
        $this->redirectFactory=$redirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
   //     return $this->pageFactory->create();
      // return $this->jsonFactory->create()->setData(['key'=>'value','key2'=>['one','two']]);
       /* $result=$this->raw->setContents('Hey, This is raw response type');
       return $result; */
        $result=$this->forwardFactory->create();
       $result->setModule('routing')->setController('index')->forward('index');
       return $result; 
         /* $result=$this->redirectFactory->create();
        $result->setPath('learning'); 
       return $result; */
    }

}