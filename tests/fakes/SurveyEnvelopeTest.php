<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use Closure;
use MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
 */
final class SurveyEnvelopeTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::act
     *
     * @small
     *
     * @return void
     */
    public function testReturnsParameterComposition(): void
    {
        $this->assertEquals(
            6,
            $this->getMockForAbstractClass(
                SurveyEnvelope::class,
                [
                    3,
                    fn (int $num, Closure $func): int => $func($num)
                ]
            )->act(
                fn (int $num): int => $num * 2
            )
        );
    }
}
