<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray
 */
final class RpIteratorToArrayTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::times
     *
     * @uses MaxGoryunov\SavingIterator\Fakes\RepetitionEnvelope
     *
     * @small
     *
     * @return void
     */
    public function testRewindsIteratorMultipleTimes(): void
    {
        $source = new ArrayIterator([5, 72, 85, 94, 9, 37, 4]);
        $this->assertEquals(
            array_fill(0, 3, iterator_to_array($source)),
            (new RpIteratorToArray($source))
                ->times(3)
        );
    }
}
