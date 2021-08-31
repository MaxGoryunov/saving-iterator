<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use Generator;
use InfiniteIterator;
use Iterator;
use LimitIterator;
use MaxGoryunov\SavingIterator\Fakes\The;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
use MaxGoryunov\SavingIterator\Src\BsCount;
use MaxGoryunov\SavingIterator\Src\Indifferent;
use MaxGoryunov\SavingIterator\Src\TimesCalled;
use MaxGoryunov\SavingIterator\Src\TransparentIterator;
use MaxGoryunov\SavingIterator\Src\SavingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\SavingIterator
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
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testIteratesWithGivenIterator(): void
    {
        (new The(
            [10, 9, 8, 7, 6, 5],
            fn(array $nums) => $this->assertEquals(
                $nums,
                iterator_to_array(
                    new SavingIterator(
                        new ArrayIterator($nums),
                        new ArrayAddingIterator()
                    )
                )
            )
        ))->value();
    }

    /**
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * @uses MaxGoryunov\SavingIterator\Src\BsCount
     * 
     * @small
     * 
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testDoesNotCallOriginIfValuesAreInCache(): void
    {
        (new The(
            [1, 2, 3, 4, 5, 6],
            fn(array $input) => $this->assertEquals(
                count($input),
                (new The(
                    new TimesCalled(
                        new ArrayIterator($input),
                        new BsCount(),
                        "next"
                    ),
                    fn(Indifferent $called): array => iterator_to_array(
                        new LimitIterator(
                            new InfiniteIterator(
                                new SavingIterator(
                                    /** @phpstan-ignore-next-line */
                                    new TransparentIterator($called),
                                    new ArrayAddingIterator()
                                )
                            ),
                            0,
                            count($input) * rand(2, 4)
                        )
                    )
                ))->value()->value()
            )
        ))->value();
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testWorksWithGenerator(): void
    {
        (new The(
            6,
            fn(int $limit) => $this->assertEquals(
                range(0, $limit),
                iterator_to_array(
                    new SavingIterator(
                        (function () use ($limit): Generator
                        {
                            for ($i = 0; $i <= $limit; $i++) {
                                yield $i;
                            }
                        })(),
                        new ArrayAddingIterator()
                    )
                )
            )
        ))->value();
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testWorksWithGeneratorMultipleTimes(): void
    {
        (new The(
            new SavingIterator(
                (function (): Generator
                {
                    for ($i = 0; $i < 10; $i++) {
                        yield $i;
                    }
                })(),
                new ArrayAddingIterator()
            ),
            fn(Iterator $iterator) => $this->assertEquals(
                iterator_to_array($iterator),
                iterator_to_array($iterator)
            )
        ))->value();
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testWorksWithEmptyGenerator(): void
    {
        $this->assertEquals(
            [],
            iterator_to_array(
                new SavingIterator(
                    (function (): Generator {/* @phpstan-ignore-next-line */
                        foreach ([] as $value) {
                            yield $value;
                        }
                    })(),
                    new ArrayAddingIterator()
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
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testIterationsGiveSameResults(): void
    {
        (new The(
            new SavingIterator(
                new ArrayIterator([1, 15, 73, 234, 65, 23, 71, 76, 9, 23]),
                new ArrayAddingIterator()
            ),
            fn(Iterator $iterator) => $this->assertEquals(
                iterator_to_array($iterator),
                iterator_to_array($iterator)
            )
        ))->value();
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testContinuesSuccessfullyAfterBeingInterrupted(): void
    {
        (new The(
            [13, 15, 34, 54, 37, 654, 83],
            fn(array $input) => $this->assertEquals(
                $input,
                iterator_to_array(
                    (new The(
                        new SavingIterator(
                            new ArrayIterator($input),
                            new ArrayAddingIterator()
                        ),
                        function (Iterator $iterator) use ($input): void {
                            foreach ($iterator as $value) {
                                if ($value === $input[3]) {
                                    break;
                                }
                            }
                        }
                    ))->value()
                )
            )
        ))->value();
    }

    /**
     * @covers ::__construct
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testWorksWithEmptyIterator(): void
    {
        $this->assertEquals(
            [],
            iterator_to_array(
                new SavingIterator(
                    new ArrayIterator([]),
                    new ArrayAddingIterator()
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
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Src\TimesCalled
     * @uses MaxGoryunov\SavingIterator\Src\TransparentIterator
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * @uses MaxGoryunov\SavingIterator\Src\BsCount
     * 
     * @small
     *
     * @return void
     */
    public function testFillsCacheValueOnlyIfItIsNotStoredYet(): void
    {
        (new The(
            [4, 3, 6, 3, 7, 8],
            fn(array $input) => $this->assertEquals(
                count($input),
                (new The(
                    new TimesCalled(
                        new ArrayIterator($input),
                        new BsCount(),
                        "current"
                    ),
                    fn(Indifferent $called): array => iterator_to_array(
                        new LimitIterator(
                            new InfiniteIterator(
                                new SavingIterator(
                                    /** @phpstan-ignore-next-line */
                                    new TransparentIterator($called),
                                    new ArrayAddingIterator()
                                )
                            ),
                            0,
                            count($input) * 2
                        )
                    )
                ))->value()->value()
            )
        ))->value();
    }
}
