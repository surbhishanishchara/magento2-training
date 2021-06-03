<?php

// namespace Surbhitest\DatabaseDemo\Setup;

// use Magento\Framework\Setup\InstallDataInterface;
// use Magento\Framework\Setup\ModuleContextInterface;
// use Magento\Framework\Setup\ModuleDataSetupInterface;

// class InstallData implements InstallDataInterface
// {
// 	// protected $_postFactory;

// 	// public function __construct(\Surbhitest\DatabaseDemo\Model\PostFactory $postFactory)
// 	// {
// 	// 	$this->_postFactory = $postFactory;
// 	// }

// 	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
// 	{
// 		$data = [
// 			'name'         => "Surbhi",
// 			'post_content' => "Hey there, This is first entry of table",
// 			'email'      => 'surbhi.s@krishtechnolabs.com',
// 		];
// 		$post = $this->_postFactory->create();
// 		$post->addData($data)->save();
// 	}
// }