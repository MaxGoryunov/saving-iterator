<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\Let;
use MaxGoryunov\SavingIterator\Fakes\The;
use MaxGoryunov\SavingIterator\Src\BsCount;
use MaxGoryunov\SavingIterator\Src\TimesCalled;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\TimesCalled
 */
class TimesCalledTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::__call
     * @covers ::value
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Fakes\Let
     * @uses MaxGoryunov\SavingIterator\Src\BsCount
     * 
     * @small
     *
     * @return void
     */
    public function testCountsHowManyTimesTheMethodWasCalled(): void
    {
        (new The(
            rand(0, 20),
            fn(int $times) => $this->assertEquals(
                $times,
                (new Let(
                    "current",
                    fn(string $method): int => (new The(
                        new TimesCalled(
                            new ArrayIterator([16, 14, 13, 15, 12, 18, 84]),
                            new BsCount(),
                            $method
                        ),
                        function (TimesCalled $called) use ($method, $times) {
                            for ($i = 0; $i < $times; $i++) {
                                $called->$method();
                            }
                        }
                    ))->value()->value()
                ))->value()
            )
        ))->value();
    }

    /**
     * @covers ::__construct
     * @covers ::__call
     * @covers ::value
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * @uses MaxGoryunov\SavingIterator\Fakes\Let
     * @uses MaxGoryunov\SavingIterator\Src\BsCount
     * 
     * @small
     *
     * @return void
     */
    public function testCountsHowManyTimesTheMethodWasCalledAlongWIthOtherMethods(): void
    {
        (new The(
            rand(0, 20),
            fn(int $times) => $this->assertEquals(
                $times,
                (new Let(
                    "key",
                    fn(string $method): int => (new The(
                        new TimesCalled(
                            new ArrayIterator([16, 14, 13, 15, 12, 18]),
                            new BsCount(),
                            $method
                        ),
                        function (TimesCalled $called) use ($method, $times) {
                            /**
                             * @var TimesCalled<ArrayIterator<int, int>> $called
                             */
                            for ($i = 0; $i < $times; $i++) {
                                $called->$method();
                                if (($i % 2 === 0) or ($i % 3 === 0)) {
                                    $called->current();
                                }
                            }
                        }
                    ))->value()->value()
                ))->value()
            )
        ))->value();
    }
}