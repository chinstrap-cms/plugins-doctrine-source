<?php

declare(strict_types=1);

namespace Chinstrap\Plugins\DoctrineSource\Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class SimpleTestCase extends \PHPUnit\Framework\TestCase
{
    use MockeryPHPUnitIntegration;
}
