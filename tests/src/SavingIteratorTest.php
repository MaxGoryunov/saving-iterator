<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use Generator;
use MaxGoryunov\SavingIterator\Src\TimesCalled;
use MaxGoryunov\SavingIterator\Src\TransparentIterator;
use MaxGoryunov\SavingIterator\Src\SavingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\SavingIterator
 * 
 * @todo #7:30min Let's introduce real fake objects which could be helpful
 *  for testing in the future. For example, a class which would contain a
 *  loop inside for easier Iterator checks.
 */
class SavingIteratorTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testIteratesWithGivenIterator(): void
    {
        $input    = [10, 9, 8, 7, 6, 5];;
        $this->assertEquals(
            $input, 
            iterator_to_array(
                $iterator = new SavingIterator(
                    new ArrayIterator($input)
                )
            )
        );
    }

    /**
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     * 
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testDoesNotCallOriginIfValuesAreInCache(): void
    {
        $input  = [1, 2, 3, 4, 5, 6];
        $called = new TimesCalled(
            new ArrayIterator($input),
            "next"
        );
        $iterator = new SavingIterator(/* @phpstan-ignore-next-line */
            new TransparentIterator($called)
        );
        for ($i = 0; $i < rand(2, 5); $i++) {
            iterator_to_array($iterator);
        }
        $this->assertEquals(count($input), $called->value());
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testWorksWithGenerator(): void
    {
        $limit = 6;
        $this->assertEquals(
            range(0, $limit), 
            iterator_to_array(
                new SavingIterator(
                    (
                        function () use ($limit): Generator
                        {
                            for ($i = 0; $i <= $limit; $i++) {
                                yield $i;
                            }
                        }
                    )()
                )
            )
        );
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testWorksWithGeneratorMultipleTimes(): void
    {
        $iterator = new SavingIterator(
            (function (): Generator
            {
                for ($i = 0; $i < 10; $i++) {
                    yield $i;
                }
            })()
        );
        $this->assertEquals(
            iterator_to_array($iterator),
            iterator_to_array($iterator)
        );
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testIterationsGiveSameResults(): void
    {
        $iterator = new SavingIterator(
            new ArrayIterator([1, 15, 73, 234, 65, 23, 71, 76, 9, 23])
        );
        $first = [];
        foreach ($iterator as $key => $value) {
            $first[$key] = $value;
        }
        $second = [];
        foreach ($iterator as $key => $value) {
            $second[$key] = $value;
        }
        $this->assertEquals($first, $second);
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testContinuesSuccessfullyAfterBeingInterrupted(): void
    {
        $input = [13, 15, 34, 54, 37, 654, 83];
        $iterator = new SavingIterator(
            new ArrayIterator($input)
        );
        foreach ($iterator as $value) {
            if ($value === $input[3]) {
                break;
            }
        }
        $this->assertEquals($input, iterator_to_array($iterator));
    }
}
