<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
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
     * @small
     *
     * @return void
     */
    public function testCountsHowManyTimesTheMethodWasCalled(): void
    {
        $method = "current";
        $called = new TimesCalled(
            new ArrayIterator([16, 14, 13, 15, 12, 18, 84]),
            $method
        );
        $times = rand(0, 20);

        for ($i = 0; $i < $times; $i++) {
            $called->$method();
        }
        
        $this->assertEquals($times, $called->value());
    }

    /**
     * @covers ::__construct
     * @covers ::__call
     * @covers ::value
     * 
     * @small
     *
     * @return void
     */
    public function testCountsHowManyTimesTheMethodWasCalledAlongWIthOtherMethods(): void
    {
        $method = "key";
        $called = new TimesCalled(
            new ArrayIterator([16, 14, 13, 15, 12, 18]),
            $method
        );
        $times = rand(0, 20);

        for ($i = 0; $i < $times; $i++) {
            $called->$method();

            if (($i % 2 === 0) or ($i % 3 === 0)) {
                $called->current();
            }
        }

        $this->assertEquals($times, $called->value());
    }
}