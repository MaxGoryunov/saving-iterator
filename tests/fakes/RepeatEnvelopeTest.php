<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use MaxGoryunov\SavingIterator\Fakes\RepeatEnvelope;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers MaxGoryunov\SavingIterator\Fakes\RepeatEnvelope
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
            $this->getMockForAbstractClass(
                RepeatEnvelope::class,
                [
                    new stdClass(),
                    fn (stdClass $std) => $std->name = "Jane"
                ]
            )
                ->times($times)
        );
    }
}
