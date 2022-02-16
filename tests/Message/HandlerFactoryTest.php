<?php

namespace RabbitEvents\Listener\Tests\Message;

use Illuminate\Container\Container;
use Mockery as m;
use RabbitEvents\Foundation\Contracts\Transport;
use RabbitEvents\Foundation\Message;
use RabbitEvents\Listener\Message\Handler;
use RabbitEvents\Listener\Message\HandlerFactory;
use RabbitEvents\Listener\Tests\Payload;
use RabbitEvents\Listener\Tests\TestCase;

class HandlerFactoryTest extends TestCase
{
    public function testMakeJob(): void
    {
        $transport = m::mock(Transport::class);

        $message = new Message('item.created', new Payload([]), $transport);

        $factory = new HandlerFactory(m::mock(Container::class));
        $handler = $factory->make($message, static function() {}, 'ClassName');

        self::assertInstanceOf(Handler::class, $handler);

        self::assertSame($message, $handler->getMessage());
    }
}
