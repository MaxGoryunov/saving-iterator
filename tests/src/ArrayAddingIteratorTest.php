<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\IteratorTransfer;
use MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
use MaxGoryunov\SavingIterator\Src\BsCount;
use MaxGoryunov\SavingIterator\Src\TimesCalled;
use MaxGoryunov\SavingIterator\Src\IteratorEnvelope;
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
     * @uses MaxGoryunov\SavingIterator\Fakes\IteratorTransfer
     * 
     * @small
     *
     * @return void
     */
    public function testWorksAsIteratorWithAddedValues(): void
    {
        $origin = new ArrayIterator([8, 20, 5, 1, 65, 2, 6]);
        $this->assertEquals(
            iterator_to_array($origin),
            iterator_to_array(
                (new IteratorTransfer($origin))
                    ->toTarget(new ArrayAddingIterator())
            )
        );
    }

    /**
     * @covers ::__construct
     * @covers ::from
     * 
     * @uses MaxGoryunov\SavingIterator\Src\TimesCalled
     * @uses MaxGoryunov\SavingIterator\Src\IteratorEnvelope
     * @uses MaxGoryunov\SavingIterator\Src\BsCount
     * 
     * @small
     *
     * @return void
     */
    public function testAddsValueOnlyIfItIsNotPreviouslyStored(): void
    {
        $called = new TimesCalled(
            new ArrayIterator([45, 2, 8, 82, 5, 12]),
            new BsCount(),
            "current"
        );
        /** @phpstan-ignore-next-line */
        $source = new IteratorEnvelope($called);
        (new ArrayAddingIterator())
            ->from($source)
            ->from($source);
        $this->assertEquals(1, $called->value());
    }

    /**
     * @covers ::__construct
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
    public function testGivesSameResultsOverDifferentIterations(): void
    {
        $this->assertEquals(
            ...(new RpIteratorToArray(
                new ArrayAddingIterator([4, 3, 85, 48, 19, 53])
            ))
                ->times(2)
        );
    }

    /**
     * @covers ::__construct
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
    public function testReturnsAddedValuesWithIteratorToArray(): void
    {
        $input = [4, 3, 94, 25, 63, 6, 72, 7];
        $this->assertEquals(
            $input,
            iterator_to_array(
                new ArrayAddingIterator($input)
            )
        );
    }
}
