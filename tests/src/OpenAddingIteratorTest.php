<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray;
use MaxGoryunov\SavingIterator\Src\BsCount;
use MaxGoryunov\SavingIterator\Src\OpenAddingIterator;
use MaxGoryunov\SavingIterator\Src\TimesCalled;
use MaxGoryunov\SavingIterator\Src\TransparentIterator;
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
     * @covers ::__construct
     * @covers ::from
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

    /**
     * @covers ::__construct
     * @covers ::from
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * @covers ::rewind
     * @covers ::valid
     *
     * @uses MaxGoryunov\SavingIterator\Fakes\RepetitionEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray
     *
     * @small
     *
     * @return void
     */
    public function testRewindsStoredIterator(): void
    {
        $this->assertEquals(
            ...(new RpIteratorToArray(
                new OpenAddingIterator(
                    new ArrayIterator([4, 72, 7, 26, 46, 92, 14])
                )
            ))
                ->times(2)
        );
    }

    /**
     * @covers ::__construct
     * @covers ::from
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * @covers ::rewind
     * @covers ::valid
     * 
     * @small
     * 
     * @uses MaxGoryunov\SavingIterator\Src\TimesCalled
     * @uses MaxGoryunov\SavingIterator\Src\BsCount
     * @uses MaxGoryunov\SavingIterator\Src\TransparentIterator
     *
     * @return void
     */
    public function testDoesNotStoreValuesIfTheyAreAlreadyStored(): void
    {
        $called = new TimesCalled(
            new ArrayIterator([56, 82, 5, 27, 92, 38]),
            new BsCount(),
            "current"
        );
        /** @phpstan-ignore-next-line */
        $transparent = new TransparentIterator($called);
        (new OpenAddingIterator(
            new ArrayIterator()
        ))
            ->from($transparent)
            ->from($transparent)
            ->from($transparent);
        $this->assertEquals(1, $called->value());
    }
}
