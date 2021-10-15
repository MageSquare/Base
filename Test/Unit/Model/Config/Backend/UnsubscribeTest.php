<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Test\Unit\Model\Config\Backend;

use MageSquare\Base\Model\Config\Backend\Unsubscribe;
use MageSquare\Base\Model\Source\NotificationType;
use MageSquare\Base\Test\Unit\Traits;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class UnsubscribeTest
 *
 * @see Unsubscribe
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * phpcs:ignoreFile
 */
class UnsubscribeTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @covers Unsubscribe::prepareMessage
     */
    public function testPrepareMessage()
    {
        $model = $this->createPartialMock(
            Unsubscribe::class,
            ['generateMessage', 'getOldValue']
        );
        $model->setValue('test');
        $messageManager = $this->createMock(\MageSquare\Base\Model\AdminNotification\Messages::class);

        $model->expects($this->any())->method('generateMessage')->willReturn(10);
        $model->expects($this->any())->method('getOldValue')->willReturnOnConsecutiveCalls('test', null);
        $messageManager->expects($this->once())->method('addMessage');
        $messageManager->expects($this->once())->method('clear');

        $this->setProperty($model, 'messageManager', $messageManager, Unsubscribe::class);

        $this->invokeMethod($model, 'prepareMessage');
        $this->invokeMethod($model, 'prepareMessage');
    }

    /**
     * @covers Unsubscribe::generateMessage
     * @dataProvider generateMessageDataProvider
     */
    public function testGenerateMessage($data, $result)
    {
        $notificationType = $this->getObjectManager()->getObject(NotificationType::class);
        $model = $this->getObjectManager()->getObject(
            Unsubscribe::class,
            [
                'notificationType' => $notificationType
            ]
        );

        $this->assertEquals($result, $this->invokeMethod($model, 'generateMessage', [$data]));
    }

    /**
     * Data provider for generateMessage test
     * @return array
     */
    public function generateMessageDataProvider()
    {
        return [
            ['test', ''],
            [
                NotificationType::UNSUBSCRIBE_ALL,
                '<img src="https://notification.magesquare.com/unsubscribe_all.svg"/>'
                . '<span>You have successfully unsubscribed from All Notifications.</span>'
            ],
            [
                NotificationType::GENERAL,
                '<img src="https://notification.magesquare.com/info.svg"/>'
                . '<span>You have successfully unsubscribed from General Info.</span>'
            ],
        ];
    }
}
