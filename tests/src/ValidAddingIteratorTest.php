<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
use MaxGoryunov\SavingIterator\Src\ValidAddingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\ValidAddingIterator
 */
final class ValidAddingIteratorTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::from
     * 
     * @small
     *
     * @return void
     */
    public function testDoesNotAddValuesIfSourceIsNotValid(): void
    {
        $iterator = new ValidAddingIterator(new ArrayAddingIterator());
        $this->assertSame(
            $iterator,
            $iterator->from(new ArrayIterator())
        );
    }
}
