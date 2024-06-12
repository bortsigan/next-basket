<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\RabbitMQService;

class RabbitMQServiceUnitTest extends TestCase
{
    public function testPublish()
    {
        $connectionMock = $this->getMockBuilder(\PhpAmqpLib\Connection\AMQPStreamConnection::class)
                              ->disableOriginalConstructor()
                              ->getMock();
        $channelMock = $this->getMockBuilder(\PhpAmqpLib\Channel\AMQPChannel::class)
                            ->disableOriginalConstructor()
                            ->getMock();


        $connectionMock->expects($this->once())->method('channel')->willReturn($channelMock);
        $channelMock->expects($this->once())->method('exchange_declare');
        $channelMock->expects($this->once())->method('queue_declare');
        $channelMock->expects($this->once())->method('queue_bind');
        $channelMock->expects($this->once())->method('basic_publish');
        $channelMock->expects($this->once())->method('close');
        $connectionMock->expects($this->once())->method('close');

        $this->app->instance(\PhpAmqpLib\Connection\AMQPStreamConnection::class, $connectionMock);


        $rabbitMQService = new RabbitMQService();

        $rabbitMQService->publish('test message');
    }
}
