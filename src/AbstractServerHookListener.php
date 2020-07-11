<?php

declare(strict_types=1);

namespace winwin\server\hook;

use kuiper\event\annotation\EventListener;
use kuiper\event\EventListenerInterface;
use wenbinye\tars\server\ServerProperties;
use winwin\server\hook\client\EventBusServant;

/**
 * @EventListener()
 */
abstract class AbstractServerHookListener implements EventListenerInterface
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
        $this->eventBusServant->publishNow(EventName::TOPIC, $this->getEventName(), $this->createPayload());
    }

    abstract protected function getEventName(): string;

    /**
     * @return false|string
     */
    protected function createPayload()
    {
        return json_encode([
            'server' => $this->serverProperties->getServerName(),
            'ip_address' => (string) $this->serverProperties->getPrimaryAdapter()->getEndpoint()->getAddress(),
        ]);
    }
}
