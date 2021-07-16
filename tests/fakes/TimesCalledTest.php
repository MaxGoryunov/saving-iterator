<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\TimesCalled;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Fakes\TimesCalled
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
        $other  = "current";
        $called = new TimesCalled(
            new ArrayIterator([16, 14, 13, 15, 12, 18]),
            $method
        );
        $times = rand(0, 20);

        for ($i = 0; $i < $times; $i++) {
            $called->$method();

            if (($i % 2 === 0) or ($i % 3 === 0)) {
                $called->$other();
            }
        }

        $this->assertEquals($times, $called->value());
    }
}