<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


declare(strict_types=1);

namespace MageSquare\Base\Model\Response\File;

use MageSquare\Base\Model\MagentoVersion;
use MageSquare\Base\Model\Response\AbstractOctetResponse;
use MageSquare\Base\Model\Response\DownloadOutput;
use Magento\Framework\App;
use Magento\Framework\Filesystem;
use Magento\Framework\Session\Config\ConfigInterface;
use Magento\Framework\Stdlib;

class FileUrlOctetResponse extends AbstractOctetResponse
{
    /**
     * @var Filesystem\File\ReadFactory
     */
    private $fileReadFactory;

    public function __construct(
        Filesystem\File\ReadFactory $fileReadFactory,
        DownloadOutput $downloadHelper,
        MagentoVersion $magentoVersion,
        App\Request\Http $request,
        Stdlib\CookieManagerInterface $cookieManager,
        Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        App\Http\Context $context,
        Stdlib\DateTime $dateTime,
        ConfigInterface $sessionConfig = null
    ) {
        $this->fileReadFactory = $fileReadFactory;

        parent::__construct(
            $downloadHelper,
            $magentoVersion,
            $request,
            $cookieManager,
            $cookieMetadataFactory,
            $context,
            $dateTime,
            $sessionConfig
        );
    }

    public function getReadResourceByPath(string $readResourcePath): Filesystem\File\ReadInterface
    {
        switch (true) {
            case (bool)preg_match('/^https:\/\//', $readResourcePath):
                $resourceType = Filesystem\DriverPool::HTTPS;
                break;
            case (bool)preg_match('/^http:\/\//', $readResourcePath):
                $resourceType = Filesystem\DriverPool::HTTP;
                break;
            default:
                $resourceType = Filesystem\DriverPool::HTTP;
        }

        $readResourcePath = str_replace($resourceType . '://', '', $readResourcePath);

        return $this->fileReadFactory->create($readResourcePath, $resourceType);
    }
}
