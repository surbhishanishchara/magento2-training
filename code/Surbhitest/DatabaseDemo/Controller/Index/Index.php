<?php
namespace Surbhitest\DatabaseDemo\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_postFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Surbhitest\DatabaseDemo\Model\PostFactory $postFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_postFactory = $postFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$post = $this->_postFactory->create();
		// $posting = $post->load(1);
		// $posting->delete();

		// $posting->setName("Updated Name");
		// $posting->save();

		// $posting->setName("Updated Name");
		// $posting->save();
		
		$post->setData(["name"=>"Test","post_content"=>"New data","email"=>"surbhi.s@krishtechnolabs.com","comment_data"=>"test comment"]);
		$post->save();

		//$collection = $post->getCollection();
		// foreach($collection as $item){
		// 	echo "<pre>";
		// 	print_r($item->getData());
		// 	echo "</pre>";
		// }
		// exit();
		// return $this->_pageFactory->create();
	}
}