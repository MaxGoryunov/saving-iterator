<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use ArrayIterator;
use Iterator;
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

    /**
     * @small
     *
     * @return void
     */
    public function testReturnsActualResults(): void
    {
        $source = new ArrayIterator([4, 76, 28, 83, 95, 9, 27]);
        $this->assertEquals(
            [
                iterator_to_array($source),
                iterator_to_array($source)
            ],
            $this->getMockForAbstractClass(
                RepetitionEnvelope::class,
                [
                    $source,
                    fn (Iterator $source): array => iterator_to_array($source)
                ]
            )
                ->times(2)
        );
    }
}
