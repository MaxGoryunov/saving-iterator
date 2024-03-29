<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray;
use Iterator;
use MaxGoryunov\SavingIterator\Fakes\IteratorTransfer;
use MaxGoryunov\SavingIterator\Src\BsCount;
use MaxGoryunov\SavingIterator\Src\OpenAddingIterator;
use MaxGoryunov\SavingIterator\Src\SafeArrayIterator;
use MaxGoryunov\SavingIterator\Src\TimesCalled;
use MaxGoryunov\SavingIterator\Src\IteratorEnvelope;
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
        /** @phpstan-var OpenAddingIterator<int, int> $iterator */
        $iterator = new OpenAddingIterator(new ArrayIterator());
        $this->assertEquals(
            $input[0],
            ($iterator)
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
     * @uses MaxGoryunov\SavingIterator\Fakes\IteratorTransfer
     * 
     * @small
     *
     * @return void
     */
    public function testWorksAsIteratorWithAddedValues(): void
    {
        $origin = new ArrayIterator([34, 0, 39, 7, 65, 82, 79]);
        $this->assertEquals(
            iterator_to_array($origin),
            iterator_to_array(
                (new IteratorTransfer($origin))
                    ->toTarget(
                        new OpenAddingIterator(
                            new ArrayIterator()
                        )
                    )
            )
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
     * @uses MaxGoryunov\SavingIterator\Src\IteratorEnvelope
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
        $transparent = new IteratorEnvelope($called);
        /** @phpstan-var OpenAddingIterator<int, int> $iterator */
        $iterator = new OpenAddingIterator(
            new ArrayIterator()
        );
        ($iterator)
            ->from($transparent)
            ->from($transparent)
            ->from($transparent);
        $this->assertEquals(1, $called->value());
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
     * @uses MaxGoryunov\SavingIterator\Src\SafeArrayIterator
     *
     * @small
     *
     * @return void
     */
    public function testWorksWithNewIteratorAfterValueAddition(): void
    {
        $origin = new SafeArrayIterator(
            [
                "apples"  => 16,
                "bananas" => 8,
                "oranges" => 3
            ]
        );
        $this->assertNotEquals(
            ...array_map(
                fn (Iterator $iterator) => iterator_to_array($iterator),
                [
                    $origin,
                    (new OpenAddingIterator($origin))
                        ->from(new ArrayIterator(["plums" => 13]))
                ]
            )
        );
    }
}
