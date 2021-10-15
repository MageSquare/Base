<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Test\Unit\Model\Import\Mapping;

use MageSquare\Base\Model\Import\Mapping\Mapping;
use MageSquare\Base\Test\Unit\Traits;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class MappingTest
 *
 * @see Mapping
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * phpcs:ignoreFile
 */
class MappingTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @covers Mapping::processedMapping
     */
    public function testProcessedMapping()
    {
        $model = $this->getObjectManager()->getObject(Mapping::class);
        $this->setProperty($model, 'processedMapping', null, Mapping::class);
        $this->setProperty($model, 'mappings', ['test', 'key' => 'value']);
        $this->assertEquals(['test' => 'test', 'key' => 'value'], $model->processedMapping());
        $this->setProperty($model, 'processedMapping', 'test', Mapping::class);
        $this->assertEquals('test', $model->processedMapping());
    }
}
