<?php

namespace Tests\Unit\Console\Commands;

use Tests\TestCase;
use App\Console\Commands\MQConsumerCommand;
use App\Services\RabbitMQService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MQConsumerCommandUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_handle_mq_consume_command()
    {
        $mockService = $this->createMock(RabbitMQService::class);
        $mockService->expects($this->once())->method('consume');

        $command = new MQConsumerCommand($mockService);
        $command->handle();
    }
}
