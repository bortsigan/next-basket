<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Services\RabbitMQService;

class RabbitMQServiceFunctionalTest extends TestCase
{
    public function testPublishAndConsume()
    {
        // Simulate RabbitMQ connection
        putenv('RABBITMQ_HOST=localhost');
        putenv('RABBITMQ_PORT=5672');
        putenv('RABBITMQ_USER=guest');
        putenv('RABBITMQ_PASSWORD=guest');

        // Create RabbitMQService instance
        $rabbitMQService = new RabbitMQService();

        // Publish message
        $rabbitMQService->publish('test message');

        // Start consuming in a separate process
        Artisan::call('rabbitmq:consume');

        // Sleep for a moment to allow consumption
        sleep(1);

        // Assert that the message was consumed
        $this->assertTrue(/* Check if the message was consumed */);
    }
}
