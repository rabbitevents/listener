<?php

namespace RabbitEvents\Listener\Tests\Stubs;

class ListenerWithMixOfMiddleware extends ListenerWithMethodMiddleware
{
    public array $middleware = [
        'RabbitEvents\Listener\Tests\Stubs\ListenerMiddleware@action',
        [ListenerMiddleware::class, 'staticMiddleware'],
        ListenerMiddleware::class
    ];

    public function __construct()
    {
        ListenerMiddleware::$calledTimes = 0;
    }

    public function handle($payload): int
    {
        $this->handleCalls++;

        return $this->middlewareCalls | $this->handleCalls | ListenerMiddleware::$calledTimes;
    }
}
