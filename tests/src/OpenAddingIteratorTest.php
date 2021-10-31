<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\IteratorTransfer;
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
     * @small
     *
     * @return void
     */
    public function testRewindsStoredIterator(): void
    {
        $iterator = new OpenAddingIterator(
            new ArrayIterator([4, 72, 7, 26, 46, 92, 14])
        );
        $this->assertEquals(
            iterator_to_array($iterator),
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
    public function testWorksWithNewIteratorAfterValueAddition(): void
    {

    }
}
