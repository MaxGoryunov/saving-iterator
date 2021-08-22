<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
use MaxGoryunov\SavingIterator\Src\TimesCalled;
use MaxGoryunov\SavingIterator\Src\TransparentIterator;
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
     * @small
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

    /**
     * @covers ::__construct
     * @covers ::from
     * @covers ::current
     * @covers ::key
     * @covers ::valid
     * @covers ::rewind
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testWorksAsIteratorWithAddedValues(): void
    {
        /**
         * @todo #66:40min Add a fake class for putting the values into Adding
         *  Iterator from source.
         */
        $origin   = new ArrayIterator([8, 20, 5, 1, 65, 2, 6]);
        $iterator = (new ArrayAddingIterator())->from($origin);
        for ($i = 0; $i < $origin->count() - 1; $i++) {
            $origin->next();
            $iterator = $iterator->from($origin);
        }
        $this->assertEquals(
            iterator_to_array($origin),
            iterator_to_array($iterator)
        );
    }

    /**
     * @covers ::__construct
     * @covers ::from
     * 
     * @uses MaxGoryunov\SavingIterator\Src\TimesCalled
     * @uses MaxGoryunov\SavingIterator\Src\TransparentIterator
     * 
     * @small
     *
     * @return void
     */
    public function testAddsValueOnlyIfItIsNotPreviouslyStored(): void
    {
        $called = new TimesCalled(
            new ArrayIterator([45, 2, 8, 82, 5, 12]),
            "current"
        );
        $source = new TransparentIterator($called);
        (new ArrayAddingIterator())
            ->from($source)
            ->from($source);
        $this->assertEquals(1, $called->value());
    }
}
