<?php

use DI\Container;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return [
    EntityManagerInterface::class => function(Container $container) {
        $configContainer = $container->get('config')['doctrine'];
        $config = Setup::createAnnotationMetadataConfiguration(
            $configContainer['metadata_dirs'],
            $configContainer['dev_mode'],
            $configContainer['proxy_dir'],
            DoctrineProvider::wrap(
                $configContainer['cache_dir'] ? new FilesystemAdapter(
                    'doctrine_metadata',
                    0,
                    $configContainer['cache_dir']
                ) : new ArrayAdapter()
            ),
            false
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        return EntityManager::create($configContainer['connection'], $config);
    },
    'config' => [
        'doctrine' => [
            'dev_mode' => false,
            'proxy_dir' => __DIR__ . '/../../var/cache/doctrine/proxy',
            'cache_dir' => __DIR__ . '/../../var/cache/doctrine/cache',
            'metadata_dirs' => [],
            'connection' => [
                'driver' => 'pdo_pgsql',
                'dbname' => getenv('DB_NAME'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'host' => getenv('DB_HOST'),
                'charset' => 'utf-8'
            ]
        ]
    ]
];