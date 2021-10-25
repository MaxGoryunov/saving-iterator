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
}
