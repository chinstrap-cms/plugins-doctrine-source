<?php

declare(strict_types=1);

namespace Chinstrap\Plugins\DoctrineSource\Providers;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use League\Container\ServiceProvider\AbstractServiceProvider;

final class DoctrineProvider extends AbstractServiceProvider
{
    protected $provides = [
                           'Doctrine\DBAL\Connection',
                           'Doctrine\ORM\EntityManager',
                          ];

    public function register(): void
    {
        // Register items
        $container = $this->getContainer();
        $container->add('Doctrine\DBAL\Connection', function () {
            $dbParams = [
                         'url' => getenv('DB_URL'),
                        ];
            return DriverManager::getConnection($dbParams);
        });
        $container->add('Doctrine\ORM\EntityManager', function () use ($container) {
            $paths = [__DIR__ . '/../Entities'];
            $isDevMode = (getenv('APP_ENV') == 'development');
            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            return EntityManager::create($container->get('Doctrine\DBAL\Connection'), $config);
        });
    }
}
