<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\IteratorTransfer;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Fakes\IteratorTransfer
 */
final class IteratorTransferTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::toTarget
     * 
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testTransfersValuesFromOriginToTarget(): void
    {
        $input = [4, 65, 2, 76, 23, 8, 82, 6,2, 8];
        $this->assertEquals(
            $input,
            iterator_to_array(
                (new IteratorTransfer(
                    new ArrayIterator($input)
                ))
                    ->toTarget(new ArrayAddingIterator())
            )
        );
    }

    /**
     * @covers ::__construct
     * @covers ::toTarget
     * 
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * 
     * @small
     *
     * @return void
     */
    public function testTransfersValuesFromOriginIfOriginIsNotRewound(): void
    {
        $origin = new ArrayIterator([9, 4, 29, 6, 23, 7, 51, 76]);
        $this->assertEquals(
            iterator_to_array($origin),
            iterator_to_array(
                (new IteratorTransfer($origin))
                    ->toTarget(new ArrayAddingIterator())
            )
        );
    }
}
