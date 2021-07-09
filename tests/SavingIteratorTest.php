<?php

namespace MaxGoryunov\SavingIterator\Tests;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Src\SavingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov/SavingIterator/SavingIterator
 */
class SavingIteratorTest extends TestCase
{

    /**
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     *
     * @return void
     */
    public function testIteratesWithGivenIterator(): void
    {
        $input    = [10, 9, 8, 7, 6, 5];
        $iterator = new SavingIterator(
            new ArrayIterator($input)
        );
        $output = [];
        foreach ($iterator as $key => $value) {
            $output[$key] = $value;
        }
        $this->assertEquals($input, $output);
    }
}