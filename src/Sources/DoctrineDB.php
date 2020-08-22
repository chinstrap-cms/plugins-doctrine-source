<?php

declare(strict_types=1);

namespace Chinstrap\Plugins\DoctrineSource\Sources;

use Chinstrap\Core\Contracts\Objects\Document;
use Chinstrap\Core\Contracts\Sources\Source;
use Chinstrap\Plugins\DoctrineSource\Entities\DoctrineDocument;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use PublishingKit\Utilities\Collections\LazyCollection;
use PublishingKit\Utilities\Contracts\Collectable;

final class DoctrineDB implements Source
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function all(): Collectable
    {
        return LazyCollection::make(function () {
            $query = $this->getRepository()->createQueryBuilder('documents')->getQuery();
            foreach ($query->iterate() as $row) {
                yield $row;
            }
        });
    }

    public function find(string $name): ?Document
    {
        return $this->getRepository()->findOneBy(['path' => $name]);
    }

    private function getRepository(): \Doctrine\Persistence\ObjectRepository
    {
        return $this->em->getRepository(DoctrineDocument::class);
    }
}
