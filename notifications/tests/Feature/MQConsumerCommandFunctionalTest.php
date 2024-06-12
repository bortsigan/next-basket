<?php

namespace Tests\Feature\Console\Commands;

use Tests\TestCase;
use App\Services\RabbitMQService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MQConsumerCommandFunctionalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_consumes_messages_from_mq()
    {
        $mockService = $this->createMock(RabbitMQService::class);
        $mockService->expects($this->once())->method('consume');

        $this->instance(RabbitMQService::class, $mockService);

        $this->artisan('mq:consume')
             ->assertExitCode(0);
    }
}
