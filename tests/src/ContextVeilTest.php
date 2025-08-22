<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use Iterator;
use MaxGoryunov\SavingIterator\Src\AddingIterator;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
use MaxGoryunov\SavingIterator\Src\ClosureReaction;
use MaxGoryunov\SavingIterator\Src\ContextVeil;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\ContextVeil
 */
final class ContextVeilTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::__call
     * 
     * @uses MaxGoryunov\SavingIterator\Src\ClosureReaction
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsOriginMethodResults(): void
    {
        $origin = new ArrayIterator([23, 6, 26, 8, 4, 76, 94, 5]);
        $veil   = new ContextVeil(
            $origin,
            /** @phpstan-ignore-next-line */
            new ClosureReaction(fn (Iterator $iterator, string $method) => $iterator)
        );
        $this->assertEquals(
            [$origin->current(), $origin->key(), $origin->valid()],
            [$veil->current(), $veil->key(), $veil->valid()]
        );
    }

    /**
     * @covers ::__Construct
     * @covers ::__call
     * 
     * @uses MaxGoryunov\SavingIterator\Src\ArrayAddingIterator
     * @uses MaxGoryunov\SavingIterator\Src\ClosureReaction
     * 
     * @small
     *
     * @return void
     */
    public function testReturnsUpdatedOriginMethodResults(): void
    {
        $source = new ArrayIterator([52, 26, 73, 8, 34, 7, 26]);
        $veil = new ContextVeil(
            new ArrayAddingIterator(),
            new ClosureReaction(
                fn (
                    AddingIterator $iterator,
                    string $method
                ) => ($method === "current")
                ? $iterator->from($source)
                : $iterator
            )
        );
        $this->assertEquals(
            $source->current(),
            $veil->current()
        );
    }
}
