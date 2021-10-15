<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Model\Response;

use Magento\Framework\App;
use Magento\Framework\Filesystem\File\ReadInterface;

interface OctetResponseInterface extends App\Response\HttpInterface, App\PageCache\NotCacheableInterface
{
    const FILE = 'file';
    const FILE_URL = 'url';

    public function sendOctetResponse();

    public function getContentDisposition(): string;

    public function getReadResourceByPath(string $readResourcePath): ReadInterface;

    public function setReadResource(ReadInterface $readResource): OctetResponseInterface;

    public function getFileName(): ?string;

    public function setFileName(string $fileName): OctetResponseInterface;
}
