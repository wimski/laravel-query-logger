<?php

declare(strict_types=1);

namespace Wimski\LaravelQueryLogger\Tests\Unit;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

abstract class AbstractUnitTest extends TestCase
{
    use MockeryPHPUnitIntegration;
}
