<?php

declare(strict_types=1);

namespace winwin\server\hook;

use kuiper\event\annotation\EventListener;
use kuiper\swoole\event\ShutdownEvent;

/**
 * @EventListener()
 */
class ServerShutdownListener extends AbstractServerHookListener
{
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvent(): string
    {
        return ShutdownEvent::class;
    }

    protected function getEventName(): string
    {
        return EventName::SERVER_SHUTDOWN;
    }
}
