<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Src\ContextVeil;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\ContextVeil
 */
final class ContextVeilTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::__call
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsOriginMethodResults(): void
    {
        $origin = new ArrayIterator([23, 6, 26, 8, 4, 76, 94, 5]);
        $veil   = new ContextVeil($origin);
        $this->assertEquals(
            [$origin->current(), $origin->key(), $origin->valid()],
            [$veil->current(), $veil->key(), $veil->valid()]
        );
    }
}
