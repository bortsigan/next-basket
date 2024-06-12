<?php

namespace Tests\Integration;

use Tests\TestCase;
use App\Services\RabbitMQService;

class RabbitMQServiceIntegrationTest extends TestCase
{
    public function testConsume()
    {
        putenv('RABBITMQ_HOST=localhost');
        putenv('RABBITMQ_PORT=5672');
        putenv('RABBITMQ_USER=guest');
        putenv('RABBITMQ_PASSWORD=guest');

        $rabbitMQService = new RabbitMQService();

        ob_start();
        $rabbitMQService->consume();
        $output = ob_get_clean();

        $this->assertStringContainsString('Waiting for new message on test_queue', $output);
    }
}
