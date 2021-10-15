<?php


namespace MageSquare\Base\Helper;

use Magento\Framework\Exception\LocalizedException;

class Utils extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\App\ProductMetadataInterface
     */
    protected $productMetadata;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Utils constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\ProductMetadataInterface $productMetadata
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\ProductMetadataInterface $productMetadata,
        \Magento\Framework\ObjectManagerInterface $objectManager

    ) {
        parent::__construct($context);
        $this->productMetadata = $productMetadata;
        $this->objectManager = $objectManager;
    }
  
    /**
     * Is the module running in a Magento Enterprise Edition installation?
     *
     * @return bool
     */
    public function isMagentoEnterprise()
    {
        return ($this->productMetadata->getEdition() == 'Enterprise' || $this->productMetadata->getEdition() == 'B2B');
    }
   
}
