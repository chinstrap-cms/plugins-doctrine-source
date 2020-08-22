<?php

declare(strict_types=1);

namespace Chinstrap\Plugins\DoctrineSource\Tests\Sources;

use Chinstrap\Core\Utilities\Collection;
use Chinstrap\Plugins\DoctrineSource\Sources\DoctrineDB;
use Chinstrap\Plugins\DoctrineSource\Tests\TestCase;
use Mockery as m;

final class DoctrineDBSourceTest extends TestCase
{
    public function testAll()
    {
        $this->markTestIncomplete();
        $document = m::mock('Chinstrap\Plugins\DoctrineSource\Entities\DoctrineDocument');
        $repo = m::mock('Doctrine\Persistence\ObjectRepository');
        $repo->shouldReceive('findAll')->once()->andReturn([$document]);
        $em = m::mock('Doctrine\ORM\EntityManager');
        $em->shouldReceive('getRepository')->once()->andReturn($repo);
        $source = new DoctrineDB($em);
        $response = $source->all();
        $this->assertInstanceOf('Chinstrap\Core\Utilities\Collection', $response);
        $this->assertEquals($document, $response[0]);
    }

    public function testFind()
    {
        $document = m::mock('Chinstrap\Plugins\DoctrineSource\Entities\DoctrineDocument');
        $repo = m::mock('Doctrine\Persistence\ObjectRepository');
        $repo->shouldReceive('findOneBy')
            ->with(['path' => 'foo/'])
            ->once()
            ->andReturn($document);
        $em = m::mock('Doctrine\ORM\EntityManager');
        $em->shouldReceive('getRepository')->once()->andReturn($repo);
        $source = new DoctrineDB($em);
        $response = $source->find('foo/');
        $this->assertEquals($document, $response);
    }
}
