<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Block\Adminhtml;

use MageSquare\Base\Model\ModuleListProcessor;
use Magento\Backend\Block\Template;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Store\Model\ScopeInterface;
use MageSquare\Base\Model\Source\NotificationType;
use MageSquare\Base\Model\Config;

class Notification extends Field
{
    protected $_template = 'MageSquare_Base::notification.phtml';

    /**
     * @var ModuleListProcessor
     */
    private $moduleListProcessor;

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Template\Context $context,
        ModuleListProcessor $moduleListProcessor,
        Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->moduleListProcessor = $moduleListProcessor;
        $this->config = $config;
    }

    protected function _toHtml()
    {
        if ($this->isSetNotification()) {
            return parent::_toHtml();
        }

        return '';
    }

    /**
     * @return int|null
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function getUpdatesCount()
    {
        $modules = $this->moduleListProcessor->getModuleList();

        return count($modules['hasUpdate']);
    }

    /**
     * @return bool
     */
    protected function isSetNotification()
    {
        $value = $this->config->getEnabledNotificationTypes();

        return in_array(NotificationType::AVAILABLE_UPDATE, $value);
    }
}
