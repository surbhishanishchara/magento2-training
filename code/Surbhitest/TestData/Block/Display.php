<?php
namespace Surbhitest\TestData\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Surbhitest\TestData\Model\Main;

class Display extends Template
{
	protected Main $main;
	
	public function __construct(
		 Context $context,
		 Main $main,
		 array $data = [])
	{
		parent::__construct($context);	
		$this->main = $main;
	}

	public function frontMessage()
	{
		return __('Dependency Injection Demo !!');
	}

	public function getMain() : Main 
	{
		return $this->main;
	}
}