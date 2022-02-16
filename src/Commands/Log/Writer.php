<?php

namespace RabbitEvents\Listener\Commands\Log;

use Illuminate\Queue\Events\HandlerFailed;
use RabbitEvents\Listener\Events\HandlerExceptionOccurred;
use RabbitEvents\Listener\Events\MessageProcessed;
use RabbitEvents\Listener\Events\MessageProcessing;

abstract class Writer
{
    public const STATUS_PROCESSING = 'Processing';
    public const STATUS_PROCESSED = 'Processed';
    public const STATUS_EXCEPTION = 'Exception Occurred';
    public const STATUS_FAILED = 'Failed';

    /**
     * @param HandlerExceptionOccurred | MessageProcessing | MessageProcessed | HandlerFailed $event
     */
    abstract public function log($event): void;

    /**
     * @param HandlerExceptionOccurred | MessageProcessing | MessageProcessed | HandlerFailed $event
     * @return string
     */
    protected function getStatus($event): string
    {
        switch (get_class($event)) {
            case MessageProcessing::class:
                return self::STATUS_PROCESSING;
            case MessageProcessed::class:
                return self::STATUS_PROCESSED;
            case HandlerExceptionOccurred::class:
                return self::STATUS_EXCEPTION;
            case HandlerFailed::class:
                return self::STATUS_FAILED;
        }
    }
}
