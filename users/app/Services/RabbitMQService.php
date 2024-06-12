<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    public function publish($message)
    {
        try {
            $connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST'), 
                env('RABBITMQ_PORT'),
                env('RABBITMQ_USER'), 
                env('RABBITMQ_PASSWORD'), 
                "/"
            );
    
            $msg = new AMQPMessage($message);
            $channel = $connection->channel();
            $channel->exchange_declare('test_exchange', 'direct', false, false, false);
            $channel->queue_declare('test_queue', false, false, false, false);
            $channel->queue_bind('test_queue', 'test_exchange', 'test_key');
            $channel->basic_publish($msg, 'test_exchange', 'test_key');
    
            \Log::info("[x] Sent " . $message . " to test_exchange / test_queue.\n");
    
            $channel->close();
            $connection->close();
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function consume()
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'), 
            env('RABBITMQ_PORT'), 
            env('RABBITMQ_USER'), 
            env('RABBITMQ_PASSWORD'),
            "/"
        );
        $channel = $connection->channel();
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };
        $channel->queue_declare('test_queue', false, false, false, false);
        $channel->basic_consume('test_queue', '', false, true, false, false, $callback);
        echo 'Waiting for new message on test_queue', " \n";
        while ($channel->is_consuming()) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }
}