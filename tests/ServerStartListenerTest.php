<?php

declare(strict_types=1);

namespace winwin\server\hook;

use kuiper\annotations\AnnotationReader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Validator\Validation;
use wenbinye\tars\server\Config;
use wenbinye\tars\server\PropertyLoader;
use winwin\server\hook\client\EventBusServant;

class ServerStartListenerTest extends TestCase
{
    public function testInvoke()
    {
        Config::parseFile(__DIR__.'/fixtures/config.conf');
        $annotationReader = AnnotationReader::getInstance();
        $validator = Validation::createValidator();
        $propertyLoader = new PropertyLoader($annotationReader, $validator);
        $serverProperties = $propertyLoader->loadServerProperties(Config::getInstance());
        $eventBusServant = \Mockery::mock(EventBusServant::class);
        $eventBusServant->shouldReceive('publishNow')
            ->with('Tars', 'ServerStart', \Mockery::capture($payload));
        $listener = new ServerStartListener($serverProperties, $eventBusServant);
        $listener(new GenericEvent());
        $this->assertEquals(json_decode($payload, true), [
            'server' => 'PHPDemo.SimpleHttpServer',
            'ip_address' => '127.0.0.1:18080',
        ]);
    }
}
