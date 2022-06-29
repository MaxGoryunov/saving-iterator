<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use Iterator;
use MaxGoryunov\SavingIterator\Src\ValidTernary;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\ValidTernary
 */
final class ValidTernaryTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::value
     *
     * @small
     *
     * @return void
     */
    public function testValidIterator(): void
    {
        $this->assertTrue(
            (new ValidTernary(
                new ArrayIterator([28, 8, 289, 57, 6]),
                fn (Iterator $it) => true,
                fn (Iterator $it) => false
            ))->value()
        );
    }

    /**
     * @covers ::__construct
     * @covers ::value
     *
     * @small
     *
     * @return void
     */
    public function testInvalidIterator(): void
    {
        $this->assertFalse(
            (new ValidTernary(
                new ArrayIterator(),
                fn (Iterator $it) => true,
                fn (Iterator $it) => false
            ))->value()
        );
    }
}
