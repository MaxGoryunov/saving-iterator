<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use MaxGoryunov\SavingIterator\Fakes\RepetitionEnvelope;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers MaxGoryunov\SavingIterator\Fakes\RepetitionEnvelope
 */
final class RepetitionEnvelopeTest extends TestCase
{
    /**
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
                RepetitionEnvelope::class,
                [
                    new stdClass(),
                    fn (stdClass $std) => $std->name = "Jane"
                ]
            )
                ->times($times)
        );
    }
}
