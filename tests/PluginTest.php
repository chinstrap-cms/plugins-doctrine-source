<?php

declare(strict_types=1);

namespace Chinstrap\Plugins\DoctrineSource\Tests;

use Chinstrap\Plugins\DoctrineSource\Plugin;
use Chinstrap\Plugins\DoctrineSource\Tests\TestCase;
use Mockery as m;

final class PluginTest extends TestCase
{
    public function testSetup()
    {
        $container = m::mock('Psr\Container\ContainerInterface');
        $console = m::mock('Symfony\Component\Console\Application');
        $console->shouldReceive('setHelperSet');
        $console->shouldReceive('addCommands');
        $plugin = new Plugin($container, $console);
        $container->shouldReceive('addServiceProvider')
            ->with('Chinstrap\Plugins\DoctrineSource\Providers\DoctrineProvider');
        $conn = m::mock('Doctrine\DBAL\Connection');
        $em = m::mock('Doctrine\ORM\EntityManager');
        $em->shouldReceive('getConnection')->andReturn($conn);
        $container->shouldReceive('get')->with('Doctrine\ORM\EntityManager')
            ->andReturn($em);
        $plugin->register();
    }
}
