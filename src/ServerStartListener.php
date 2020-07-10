<?php

declare(strict_types=1);

namespace winwin\server\hook;

use kuiper\event\annotation\EventListener;
use kuiper\event\EventListenerInterface;
use kuiper\swoole\event\StartEvent;
use wenbinye\tars\server\ServerProperties;
use winwin\server\hook\client\EventBusServant;

/**
 * @EventListener()
 */
class ServerStartListener implements EventListenerInterface
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
        $this->eventBusServant->publishNow('Tars', 'ServerStart', json_encode([
            'server' => $this->serverProperties->getServer(),
            'ip_address' => $this->serverProperties->getLocalIp(),
        ]));
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvent(): string
    {
        return StartEvent::class;
    }
}
