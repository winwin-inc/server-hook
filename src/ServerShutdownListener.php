<?php

declare(strict_types=1);

namespace winwin\server\hook;

use kuiper\event\annotation\EventListener;
use kuiper\event\EventListenerInterface;
use kuiper\swoole\event\ShutdownEvent;
use wenbinye\tars\server\ServerProperties;
use winwin\server\hook\client\EventBusServant;

/**
 * @EventListener()
 */
class ServerShutdownListener implements EventListenerInterface
{
    /**
     * @var ServerProperties
     */
    private $serverProperties;

    /**
     * @var EventBusServant
     */
    private $eventBusServant;

    public function __construct(ServerProperties $serverProperties, EventBusServant $eventBusServant)
    {
        $this->serverProperties = $serverProperties;
        $this->eventBusServant = $eventBusServant;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke($event): void
    {
        $this->eventBusServant->publishNow(EventName::TOPIC, EventName::SERVER_SHUTDOWN, json_encode([
            'server' => $this->serverProperties->getServer(),
            'ip_address' => $this->serverProperties->getLocalIp(),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvent(): string
    {
        return ShutdownEvent::class;
    }
}
