<?php

namespace RabbitEvents\Listener\Tests\Stubs;

class ListenerWithAttributeMiddleware
{
    public array $middleware = [
        'RabbitEvents\Listener\Tests\Stubs\ListenerMiddleware@action',
        ListenerMiddleware::class
    ];

    public function __construct()
    {
        ListenerMiddleware::$calledTimes = 0;
    }

    public function handle($payload): int
    {
        return ListenerMiddleware::$calledTimes;
    }
}
