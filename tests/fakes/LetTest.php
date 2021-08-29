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

    /**
     * @covers ::__construct
     * @covers ::do
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsSubjectWithDynamicContext(): void
    {
        $nums = range(1, 5);
        $this->assertEquals(
            array_sum($nums),
            (new Let($nums, fn ($nums) => $nums))
                ->do(fn (array $nums) => array_sum($nums))
        );
    }
}
