<?php

declare(strict_types=1);

namespace winwin\server\hook;

use kuiper\event\annotation\EventListener;
use kuiper\swoole\event\StartEvent;

/**
 * @EventListener()
 */
class ServerStartListener extends AbstractServerHookListener
{
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvent(): string
    {
        return StartEvent::class;
    }

    protected function getEventName(): string
    {
        return EventName::SERVER_START;
    }
}
