<?php

namespace Tests\Feature\Console\Commands;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MQConsumerCommandIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mq_consume_command_executes_successfully()
    {
        $this->artisan('mq:consume')
             ->assertExitCode(0);
    }
}
