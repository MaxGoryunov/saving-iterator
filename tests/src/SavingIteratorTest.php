<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
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
     * @covers ::__construct
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
        $input    = [10, 9, 8, 7, 6, 5];;
        $this->assertEquals(
            $input, 
            iterator_to_array(
                $iterator = new SavingIterator(
                    new ArrayIterator($input)
                )
            )
        );
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
     * @runInSeparateProcess
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

    /**
     * @covers ::__construct
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
    public function testIterationsGiveSameResults(): void
    {
        $iterator = new SavingIterator(
            new ArrayIterator([1, 15, 73, 234, 65, 23, 71, 76, 9, 23])
        );
        $first = [];
        foreach ($iterator as $key => $value) {
            $first[$key] = $value;
        }
        $second = [];
        foreach ($iterator as $key => $value) {
            $second[$key] = $value;
        }
        $this->assertEquals($first, $second);
    }

    /**
     * @covers ::__construct
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
    public function testContinuesSuccessfullyAfterBeingInterrupted(): void
    {
        $input = [13, 15, 34, 54, 37, 654, 83];
        $iterator = new SavingIterator(
            new ArrayIterator($input)
        );
        foreach ($iterator as $value) {
            if ($value === 90) {
                break;
            }
        }
        $this->assertEquals($input, iterator_to_array($iterator));
    }
}