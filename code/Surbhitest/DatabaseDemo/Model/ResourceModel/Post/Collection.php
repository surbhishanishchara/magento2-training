<?php
namespace Surbhitest\DatabaseDemo\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'contactus_id';
	protected $_eventPrefix = 'surbhitest_databasedemo_post_collection';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Surbhitest\DatabaseDemo\Model\Post', 'Surbhitest\DatabaseDemo\Model\ResourceModel\Post');
	}

}