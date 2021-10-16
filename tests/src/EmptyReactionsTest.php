<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Src\EmptyReactions;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\EmptyReactions
 */
final class EmptyReactionsTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::edited
     *
     * @small
     *
     * @return void
     */
    public function testReactsToAllMethods(): void
    {
        $origin = new ArrayIterator([48, 8, 23, 83, 9, 55]);
        $this->assertSame(
            $origin,
            (new EmptyReactions())
                ->edited($origin, "current")
        );
    }
}
