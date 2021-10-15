<?php

namespace MageSquare\Base\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
// use MageSquare\Base\Model\ModuleFactory;

class ModuleActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_PATH_INSTALL = 'magesquare/installer/form';
    const URL_PATH_UPGRADE = 'magesquare/installer/upgrade';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;


    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        // ModuleFactory $moduleFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        // $this->moduleFactory = $moduleFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {

            // add installer links
            // $module = $this->moduleFactory->create()->load($item['code']);
            // if ($module->getInstaller()->hasUpgradesDir()) {
            //     $item[$this->getData('name')]['installer'] = [
            //         'href' => $this->urlBuilder->getUrl(
            //             static::URL_PATH_INSTALL,
            //             [
            //                 'code' => $item['code']
            //             ]
            //         ),
            //         'label' => __('Open Installer')
            //     ];

            //     if ($module->isInstalled() &&
            //         $module->getInstaller()->getUpgradesToRun()) {

            //         $item[$this->getData('name')]['upgrade'] = [
            //             'href' => $this->urlBuilder->getUrl(
            //                 static::URL_PATH_UPGRADE,
            //                 [
            //                     'code' => $item['code']
            //                 ]
            //             ),
            //             'label' => __('Run Upgrades')
            //         ];
            //     }
            // }

            // add external links
            foreach ($this->getData('links') as $link) {
                if (empty($item[$link['key']])) {
                    continue;
                }

                $item[$this->getData('name')][$link['key']] = [
                    'href'  => $item[$link['key']],
                    'label' => __($link['label'])
                ];
            }
        }
        return $dataSource;
    }
}
