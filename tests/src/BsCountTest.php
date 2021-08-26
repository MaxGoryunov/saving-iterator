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
}
