<?php
declare(strict_types=1);

namespace Surbhitest\DatabaseDemo\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'contact_us_data';

	protected $_cacheTag = 'contact_us_data';

	protected $_eventPrefix = 'contact_us_data';

	protected function _construct()
	{
		$this->_init('Surbhitest\DatabaseDemo\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}