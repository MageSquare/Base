<?php

namespace MageSquare\Base\Controller\Adminhtml\Installer;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Form extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'MageSquare_Base::installer_form';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Install action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $model = $this->_objectManager->create('MageSquare\Base\Model\Module');
        $model->load($this->getRequest()->getParam('code'));

        $session = $this->_objectManager->get('Magento\Backend\Model\Session');
        $data = $session->getFormData(true);
        if (!empty($data) && !empty($data['general'])) {
            $model->addData($data['general']);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('MageSquare_Base::module_manager')
            ->addBreadcrumb('MageSquare', 'MageSquare')
            ->addBreadcrumb(__('Installer'), __('Installer'));
        $resultPage->getConfig()->getTitle()->prepend(__('MageSquare Installer'));
        $resultPage->getConfig()->getTitle()->prepend($model->getName());

        return $resultPage;
    }
}
