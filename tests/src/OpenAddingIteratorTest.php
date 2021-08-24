<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Src\OpenAddingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\OpenAddingIterator
 */
final class OpenAddingIteratorTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::from
     * @covers ::current
     * 
     * @small
     *
     * @return void
     */
    public function testAddsValuesFromSource(): void
    {
        $input = [4, 29, 49, 84, 5, 28, 50];
        $this->assertEquals(
            $input[0],
            (new OpenAddingIterator(new ArrayIterator()))
                ->from(new ArrayIterator($input))
                ->current()
        );
    }
}
