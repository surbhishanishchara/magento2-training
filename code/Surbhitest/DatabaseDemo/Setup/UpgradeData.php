<?php

namespace Surbhitest\DatabaseDemo\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
	protected $_postFactory;

	public function __construct(\Surbhitest\DatabaseDemo\Model\PostFactory $postFactory)
	{
		$this->_postFactory = $postFactory;
	}

	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		if (version_compare($context->getVersion(), '1.3.0', '<')) {
			$data = [
				'name'         => "Surbhi",
                'post_content' => "Hey there, This is first entry of table",
                'email'      => 'surbhi.s@krishtechnolabs.com',
			];
			$post = $this->_postFactory->create();
			$post->addData($data)->save();
		}
	}
}
