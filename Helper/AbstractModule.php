<?php

namespace MageSquare\Base\Helper;

abstract class AbstractModule extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $edition;
    protected $extId;
    protected $configPath;
    protected $module;

    /**
     * Registry
     * @var \Magento\Framework\Registry
     */
    protected $registry;


    /**
     * @var Utils
     */
    protected $utilsHelper;

    /**
     * AbstractModule constructor.
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param Server $serverHelper
     * @param Utils $utilsHelper
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Registry $registry,
        \MageSquare\Base\Helper\Utils $utilsHelper
    ) {
        $this->registry = $registry;
        $this->utilsHelper = $utilsHelper;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isModuleEnabled()
    {   
       
        if (!$this->scopeConfig->isSetFlag($this->getConfigPath() . 'enabled')) {
            return false;
        }
        $moduleEnabled = $this->scopeConfig->getValue($this->getConfigPath() . str_rot13('frevny'));
        if (empty($moduleEnabled) || !$moduleEnabled ) {
            return false;
        }
        
        return true;
    }

    public function getConfigPath()
    {
        return $this->configPath;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getModuleEdition()
    {
        return $this->edition;
    }

    /**
     * Check if module is installed in wrong Magento edition
     *
     * @return bool
     */
    public function isWrongEdition()
    {
        $versionString = 'version';
        if ($this->getModuleEdition() !== '%!'.$versionString.'!%' && $this->getModuleEdition() !== '') {
            if ($this->utilsHelper->isMagentoEnterprise() && $this->getModuleEdition() !== 'EE') {
                return true;
            }
        }
        return false;
    }
}

