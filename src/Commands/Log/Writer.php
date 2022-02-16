<?php

namespace RabbitEvents\Listener\Commands\Log;

use RabbitEvents\Listener\Events\HandlerExceptionOccurred;
use RabbitEvents\Listener\Events\MessageProcessed;
use RabbitEvents\Listener\Events\MessageProcessing;
use RabbitEvents\Listener\Events\MessageProcessingFailed;

abstract class Writer
{
    public const STATUS_PROCESSING = 'Processing';
    public const STATUS_PROCESSED = 'Processed';
    public const STATUS_EXCEPTION = 'Exception Occurred';
    public const STATUS_FAILED = 'Failed';

    /**
     * @param HandlerExceptionOccurred | MessageProcessing | MessageProcessed | MessageProcessingFailed $event
     */
    abstract public function log($event): void;

    /**
     * @param HandlerExceptionOccurred | MessageProcessing | MessageProcessed | MessageProcessingFailed $event
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
            case MessageProcessingFailed::class:
                return self::STATUS_FAILED;
        }
    }
}
