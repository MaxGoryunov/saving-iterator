<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
 */
final class ArrayAddingIteratorTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::from
     * @covers ::current
     *
     * @return void
     */
    public function testAddsValuesFromGivenIterator(): void
    {
        $origin = new ArrayIterator([4, 3, 18, 9, 5]);
        $this->assertEquals(
            $origin->current(),
            (new ArrayAddingIterator())
                ->from($origin)
                ->current()
        );
    }
}
