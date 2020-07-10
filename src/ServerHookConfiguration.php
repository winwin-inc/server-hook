<?php

declare(strict_types=1);

namespace winwin\server\hook;

use kuiper\di\annotation\Bean;
use kuiper\di\annotation\ConditionalOnProperty;
use kuiper\di\annotation\Configuration;
use wenbinye\tars\rpc\TarsClientFactoryInterface;
use wenbinye\tars\server\ServerProperties;
use winwin\server\hook\client\EventBusServant;

/**
 * @Configuration()
 * @ConditionalOnProperty("tars.application.server.node")
 */
class ServerHookConfiguration
{
    /**
     * @Bean()
     */
    public function serverStartListener(
        ServerProperties $serverProperties,
        EventBusServant $eventBusServant
    ): ServerStartListener {
        return new ServerStartListener($serverProperties, $eventBusServant);
    }

    /**
     * @Bean()
     */
    public function serverShutdownListener(
        ServerProperties $serverProperties,
        EventBusServant $eventBusServant
    ): ServerShutdownListener {
        return new ServerShutdownListener($serverProperties, $eventBusServant);
    }

    /**
     * @Bean()
     */
    public function eventBusServant(TarsClientFactoryInterface $factory): EventBusServant
    {
        return $factory->create(EventBusServant::class);
    }
}
