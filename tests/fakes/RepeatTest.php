<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use MaxGoryunov\SavingIterator\Fakes\Repeat;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers MaxGoryunov\SavingIterator\Fakes\Repeat
 */
final class RepeatTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::times
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsExactAmountOfResults(): void
    {
        $times = 3;
        $this->assertCount(
            $times,
            (new Repeat(
                new stdClass(),
                fn (stdClass $std) => $std->name = "Jane"
            ))
                ->times(3)
        );
    }
}
