<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray;
use MaxGoryunov\SavingIterator\Fakes\The;
use MaxGoryunov\SavingIterator\Src\IteratorEnvelope;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\IteratorEnvelope
 */
class IteratorEnvelopeTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::current
     * @covers ::key
     * @covers ::valid
     * @covers ::rewind
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * 
     * @small
     *
     * @return void
     */
    public function testBehavesAsIterator(): void
    {
        (new The(
            [
                "apples"      => 4,
                "bananas"     => 10,
                "oranges"     => 5,
                "tomatoes"    => 7,
                "watermelons" => 18,
                "plums"       => 3
            ]
        ))->act(
            fn(array $greens) => $this->assertEquals(
                $greens,
                iterator_to_array(
                    new IteratorEnvelope(
                        new ArrayIterator($greens)
                    )
                )
            )
        );
    }

    /**
     * @covers ::__construct
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * @covers ::rewind
     * @covers ::valid
     *
     * @uses MaxGoryunov\SavingIterator\Fakes\RepetitionEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\RpIteratorToArray
     * 
     * @small
     *
     * @return void
     */
    public function testRewindsInnerIterator(): void
    {
        $this->assertEquals(
            ...(new RpIteratorToArray(
                new IteratorEnvelope(
                    new ArrayIterator([3, 87, 36, 93, 6, 82, 4])
                )
            ))
                ->times(2)
        );
    }
}