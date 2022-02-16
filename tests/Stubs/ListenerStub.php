<?php

namespace RabbitEvents\Listener\Tests\Stubs;

class ListenerStub
{
    public function handle(): array
    {
        return func_get_args();
    }

    public function middleware(): array
    {
        return func_get_args();
    }
}
