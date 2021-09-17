<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use Iterator;
use MaxGoryunov\SavingIterator\Src\ArrayAddingIterator;
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
     * @small
     *
     * @return void
     */
    public function testReturnsOriginMethodResults(): void
    {
        /**
         * @todo #94:30min Add a way to provide context which does not do
         *  anything.
         */
        $origin = new ArrayIterator([23, 6, 26, 8, 4, 76, 94, 5]);
        $veil   = new ContextVeil(
            $origin,
            fn (Iterator $iterator) => $iterator,
            []
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
     * @small
     *
     * @return void
     */
    public function testReturnsUpdatedOriginMethodResults(): void
    {
        /**
         * @todo #94:30min Add a way to provide one several contexts for
         *  different methods.
         */
        $source = new ArrayIterator([52, 26, 73, 8, 34, 7, 26]);
        $veil = new ContextVeil(
            new ArrayAddingIterator(),
            fn (ArrayAddingIterator $iterator) => $iterator->from($source),
            ["current" => true]
        );
        $this->assertEquals(
            $source->current(),
            $veil->current()
        );
    }
}
