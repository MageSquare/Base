<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Observer;

use MageSquare\Base\Model\Feed\FeedTypes\Ads;
use Magento\Framework\Config\CacheInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SaveConfig for clear cache data
 */
class SaveConfig implements ObserverInterface
{
    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct(
        CacheInterface $cache
    ) {
        $this->cache = $cache;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($this->cache->test(Ads::CSV_CACHE_ID)) {
            $this->cache->remove(Ads::CSV_CACHE_ID);
        }
    }
}
