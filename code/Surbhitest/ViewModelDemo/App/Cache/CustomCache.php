<?php

namespace Surbhitest\ViewModelDemo\App\Cache;

use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\Frontend\Decorator\TagScope;
use Magento\Framework\Config\CacheInterface;

class CustomCache extends TagScope implements CacheInterface
{
    const TYPE_IDENTIFIER = 'custom cache';

    const CACHE_TAG = "CUSTOM CACHE";

    public function __construct(FrontendPool $frontendPool)
    {
        parent::__construct($frontendPool->get(self::TYPE_IDENTIFIER),self::CACHE_TAG);
    }
}

?>