<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use BadMethodCallException;
use MaxGoryunov\SavingIterator\Src\EmptyReaction;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\EmptyReaction
 */
final class EmptyReactionTest extends TestCase
{
    /**
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
            (new EmptyReaction())
                ->edited($origin, "current")
        );
    }

    /**
     * @covers ::edited
     *
     * @small
     *
     * @return void
     */
    public function testThrowsExceptionIfMethodIsAnEmptyString(): void
    {
        $this->expectException(BadMethodCallException::class);
        (new EmptyReaction())->edited(new stdClass(), "");
    }
}
