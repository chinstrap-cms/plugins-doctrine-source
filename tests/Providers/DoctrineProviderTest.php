<?php

declare(strict_types=1);

namespace Chinstrap\Plugins\DoctrineSource\Tests\Providers;

use Chinstrap\Plugins\DoctrineSource\Tests\TestCase;

final class DoctrineProviderTest extends TestCase
{
    public function testCreateDoctrineDBAL(): void
    {
        $conn = $this->container->get('Doctrine\DBAL\Connection');
        $this->assertInstanceOf('Doctrine\DBAL\Connection', $conn);
    }

    public function testCreateEntityManager(): void
    {
        $em = $this->container->get('Doctrine\ORM\EntityManager');
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $em);
    }
}
