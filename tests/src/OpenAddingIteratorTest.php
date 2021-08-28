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

    /**
     * @covers ::__connstruct
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * @covers ::rewind
     * @covers ::valid
     * 
     * @small
     *
     * @return void
     */
    public function testWorksAsIteratorWithAddedValues(): void
    {
        /**
         * @todo #83:15min Replace algorithm with a fake class.
         */
        $origin   = new ArrayIterator([34, 0, 39, 7, 65, 82, 79]);
        $iterator = (new OpenAddingIterator(new ArrayIterator([])));
        while ($origin->valid()) {
            $iterator = $iterator->from($origin);
            $origin->next();
        }
        $this->assertEquals(
            iterator_to_array($origin),
            iterator_to_array($iterator)
        );
    }
}
