<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use MaxGoryunov\SavingIterator\Src\BsCount;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\Count
 */
final class BsCountTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::value
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsInitialValue(): void
    {
        $init = 7;
        $this->assertEquals(
            $init,
            (new BsCount($init))->value()
        );
    }

    /**
     * @covers ::__construct
     * @covers ::increment
     * @covers ::value
     * 
     * @small
     *
     * @return void
     */
    public function testIncrementReturnsIncrementedValue(): void
    {
        $init = 4;
        $this->assertEquals(
            $init + 1,
            (new BsCount($init))
                ->increment()
                ->value()
        );
    }
}
