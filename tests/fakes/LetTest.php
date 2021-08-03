<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use MaxGoryunov\SavingIterator\Fakes\Let;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Fakes\Let
 */
class LetTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::value
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsContextResult(): void
    {
        $this->assertEquals(
            [15, 120],
            (new Let(
                [1, 2, 3, 4, 5],
                fn(array $nums): array => [
                    array_sum($nums), array_product($nums)
                ]
            ))->value()
        );
    }
}
