<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Model\LessToCss;

use Magento\Framework\Config\CacheInterface;
use MageSquare\Base\Model\LessToCss\Config\Reader;

/**
 * Extension attributes config
 */
class Config extends \Magento\Framework\Config\Data
{
    const CACHE_ID = 'magesquare_less_to_css';

    /**
     * Initialize reader and cache.
     *
     * @param Reader $reader
     * @param CacheInterface $cache
     */
    public function __construct(
        Reader $reader,
        CacheInterface $cache
    ) {
        parent::__construct($reader, $cache, self::CACHE_ID);
    }
}
