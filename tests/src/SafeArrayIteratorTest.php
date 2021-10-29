<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

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
     * @covers ::offsetUnset
     * @covers ::offsetExists
     *
     * @small
     *
     * @return void
     */
    public function testUnsetsValues(): void
    {
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
            (new SafeArrayIterator(range(1, 5)))
        );
    }
}
