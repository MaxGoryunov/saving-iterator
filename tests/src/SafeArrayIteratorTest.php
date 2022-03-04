<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray;
use MaxGoryunov\SavingIterator\Src\SafeArrayIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\SafeArrayIterator
 */
final class SafeArrayIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::offsetSet
     * @covers ::offsetGet
     *
     * @small
     *
     * @return void
     */
    public function testStoresValues(): void
    {
        /** @phpstan-var SafeArrayIterator<string, int> */
        $iterator       = new SafeArrayIterator();
        $key            = "apples";
        $value          = 18;
        $iterator[$key] = $value;
        $this->assertEquals(
            $value,
            $iterator[$key]
        );
    }

    /**
     * @covers ::__construct
     * @covers ::offsetSet
     * @covers ::offsetUnset
     * @covers ::offsetExists
     *
     * @small
     *
     * @return void
     */
    public function testUnsetsValues(): void
    {
        /** @phpstan-var SafeArrayIterator<string, int> */
        $iterator       = new SafeArrayIterator();
        $key            = "bananas";
        $value          = 6;
        $iterator[$key] = $value;
        unset($iterator[$key]);
        $this->assertFalse(
            $iterator->offsetExists($key)
        );
    }

    /**
     * @covers ::__construct
     * @covers ::count
     *
     * @small
     *
     * @return void
     */
    public function testCountReturnsActualNumberOfElementsInIterator(): void
    {
        $count = 5;
        $this->assertCount(
            $count,
            (new SafeArrayIterator(range(1, $count)))
        );
    }

    /**
     * @covers ::__construct
     * @covers ::current
     * @covers ::key
     * @covers ::valid
     * @covers ::next
     * @covers ::rewind
     *
     * @small
     *
     * @return void
     */
    public function testWorksAsIterator(): void
    {
        $input = [83, 86, 36, 83, 5, 8, 75];
        $this->assertEquals(
            $input,
            iterator_to_array(
                new SafeArrayIterator($input)
            )
        );
    }

    /**
     * @covers ::__construct
     * @covers ::current
     * @covers ::key
     * @covers ::valid
     * @covers ::next
     * @covers ::rewind
     *
     * @uses MaxGoryunov\SavingIterator\Fakes\RepetitionEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray
     *
     * @small
     *
     * @return void
     */
    public function testIterationsGiveSameResults(): void
    {
        $this->assertEquals(
            ...(new RpIteratorToArray(
                new SafeArrayIterator([7, 73, 45, 9, 24, 72, 6])
            ))
                ->times(2)
        );
    }

    /**
     * @covers ::__construct
     * @covers ::current
     * @covers ::key
     * @covers ::valid
     * @covers ::next
     * @covers ::rewind
     * @covers ::__serialize
     * @covers ::__unserialize
     *
     * @small
     *
     * @return void
     */
    public function testSerializationWorks(): void
    {
        $iterator = new SafeArrayIterator(([72, 8, 84, 37, 94, 27, 4]));
        $this->assertEquals(
            iterator_to_array($iterator),
            iterator_to_array(
                unserialize(serialize($iterator))
            )
        );
    }
}
