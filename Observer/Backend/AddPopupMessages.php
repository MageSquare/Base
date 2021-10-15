<?php

namespace MageSquare\Base\Observer\Backend;

class AddPopupMessages implements \Magento\Framework\Event\ObserverInterface
{
    protected $popupMessageManager;

    public function __construct(\MageSquare\Base\Helper\PopupMessageManager $popupMessageManager)
    {
        $this->popupMessageManager = $popupMessageManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->popupMessageManager->getPopups()) {
            $block = $observer->getLayout()->addBlock(
                'Magento\Framework\View\Element\Template',
                'magesquare_popup_messages',
                'before.body.end'
            );
            $block->setTemplate('MageSquare_Base::popup_messages.phtml')
                ->setData('popup_messenger', $this->popupMessageManager);
        }
    }
}
