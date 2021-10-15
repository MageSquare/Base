<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */

declare(strict_types=1);

namespace MageSquare\Base\Cron;

use MageSquare\Base\Model\Feed\FeedTypes\Ads;
use MageSquare\Base\Model\Feed\FeedTypes\Extensions;

class RefreshFeedData
{
    /**
     * @var Ads
     */
    private $adsFeed;

    /**
     * @var Extensions
     */
    private $extensionsFeed;

    public function __construct(
        Ads $adsFeed,
        Extensions $extensionsFeed
    ) {
        $this->adsFeed = $adsFeed;
        $this->extensionsFeed = $extensionsFeed;
    }

    /**
     * Force reload feeds data
     */
    public function execute()
    {
        $this->extensionsFeed->getFeed();
        $this->adsFeed->getFeed();
    }
}
