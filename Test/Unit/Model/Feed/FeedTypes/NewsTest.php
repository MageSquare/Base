<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Test\Unit\Model\Feed\FeedTypes;

use MageSquare\Base\Helper\Module;
use MageSquare\Base\Model\Feed\FeedTypes\News;
use MageSquare\Base\Model\ModuleInfoProvider;
use MageSquare\Base\Test\Unit\Traits;
use Magento\Framework\DataObjectFactory;

class NewsTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @var News
     */
    private $model;

    /**
     * @var Module
     */
    private $moduleInfoProvider;

    protected function setUp(): void
    {
        $moduleList = $this->createMock(\Magento\Framework\Module\ModuleListInterface::class);
        $this->moduleInfoProvider = $this->createMock(ModuleInfoProvider::class);

        $moduleList->expects($this->any())->method('getNames')->willReturn(['Magento_Catalog', 'MageSquare_Seo']);

        $dataObjectFactory = $this->createPartialMock(DataObjectFactory::class, ['create']);
        $dataObjectFactory->expects($this->any())->method('create')->willReturn(
            new \Magento\Framework\DataObject()
        );

        $this->model = $this->getObjectManager()->getObject(
            News::class,
            [
                'moduleList' => $moduleList,
                'moduleInfoProvider' => $this->moduleInfoProvider,
                'dataObjectFactory' => $dataObjectFactory
            ]
        );
    }

    /**
     * @covers NewsProcessor::getInstalledMageSquareExtensions
     */
    public function testGetInstalledMageSquareExtensions()
    {
        $this->assertEquals([1 => 'MageSquare_Seo'], $this->invokeMethod($this->model, 'getInstalledMageSquareExtensions'));
    }

    /**
     * @covers NewsProcessor::validateByExtension
     * @dataProvider validateByExtensionDataProvider
     */
    public function testValidateByExtension($extensions, $result)
    {
        $this->assertEquals($result, $this->invokeMethod($this->model, 'validateByExtension', [$extensions, true]));
    }

    /**
     * Data provider for validateByExtension test
     * @return array
     */
    public function validateByExtensionDataProvider()
    {
        return [
            ['', true],
            ['Magento_Catalog,MageSquare_Seo', true],
            ['test', false],
        ];
    }

    /**
     * @covers NewsProcessor::validateByNotInstalled
     * @dataProvider validateByNotInstalledDataProvider
     */
    public function testValidateByNotInstalled($extensions, $result)
    {
        $this->assertEquals($result, $this->invokeMethod($this->model, 'validateByNotInstalled', [$extensions, true]));
    }

    /**
     * Data provider for validateByNotInstalled test
     * @return array
     */
    public function validateByNotInstalledDataProvider()
    {
        return [
            ['', true],
            ['Magento_Catalog,MageSquare_Seo', true],
            ['MageSquare_Seo', false],
        ];
    }

    /**
     * @covers NewsProcessor::getDependModules
     */
    public function testGetDependModules()
    {
        $this->moduleInfoProvider->expects($this->any())->method('getModuleInfo')
            ->willReturn(['name' => 'magesquare', 'require' => ['magento' => 'catalog', 'magesquare' => 'shopby']]);
        $this->assertEquals(['MageSquare_Seo'], $this->invokeMethod($this->model, 'getDependModules', [['MageSquare_Seo']]));
    }
}
