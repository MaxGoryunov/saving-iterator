<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray;
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
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
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

    /**
     * @covers ::__construct
     * @covers ::from
     *
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     *
     * @small
     *
     * @return void
     */
    public function testAddsValuesIfSourceIsValid(): void
    {
        $iterator = new ValidAddingIterator(new ArrayAddingIterator());
        $this->assertNotSame(
            $iterator,
            $iterator->from(new ArrayIterator([34, 7, 23, 81, 75, 16]))
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
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     *
     * @small
     *
     * @return void
     */
    public function testBehavesAsIterator(): void
    {
        $input = [34, 7, 85, 72, 54, 71, 8];
        $this->assertEquals(
            $input,
            iterator_to_array(
                new ValidAddingIterator(new ArrayAddingIterator($input))
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
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     *
     * @small
     *
     * @return void
     */
    public function testRewindsStoredIterator(): void
    {
        $this->assertEquals(
            ...(new RpIteratorToArray(
                new ValidAddingIterator(
                    new ArrayAddingIterator([23, 6, 10, 658, 27, 3])
                )
            ))->times(2)
        );
    }
}
