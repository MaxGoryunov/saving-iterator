<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use IteratorIterator;
use MaxGoryunov\SavingIterator\Fakes\TimesCalled;
use MaxGoryunov\SavingIterator\Fakes\TransparentIterator;
use MaxGoryunov\SavingIterator\Src\SavingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\SavingIterator
 */
class SavingIteratorTest extends TestCase
{

    /**
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testIteratesWithGivenIterator(): void
    {
        $input    = [10, 9, 8, 7, 6, 5];
        $iterator = new SavingIterator(
            new ArrayIterator($input)
        );
        $output = [];
        foreach ($iterator as $key => $value) {
            $output[$key] = $value;
        }
        $this->assertEquals($input, $output);
    }

    /**
     * @covers ::rewind
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::next
     * 
     * @small
     *
     * @return void
     */
    public function testDoesNotCallOriginIfValuesAreInCache(): void
    {
        $input  = [1, 2, 3, 4, 5, 6];
        $called = new TimesCalled(
            new ArrayIterator($input),
            "next"
        );
        $iterator = new SavingIterator(
            new TransparentIterator(
                $called
            )
        );
        for ($i = 0; $i < rand(0, 10); $i++) {
            foreach ($iterator as $key => $value) {

            }
        }
        $this->assertEquals(count($input), $called->value());
    }
}
