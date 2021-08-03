<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use MaxGoryunov\SavingIterator\Fakes\Let;
use MaxGoryunov\SavingIterator\Fakes\The;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Fakes\The
 */
class TheTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::value
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\SurveyEnvelope
     * @uses MaxGoryunov\SavingIterator\Fakes\Let
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsSubjectAfterApplyingContext(): void
    {
        $this->assertEquals(
            ...(new Let(
                [1, 2, 3, 4, 5],
                fn(array $nums): array => [
                    $nums,
                    (new The(
                        $nums,
                        fn(array $nums): array => [
                            array_sum($nums), array_product($nums)
                        ]
                    ))->value()
                ]
            ))->value()
        );
    }
}
