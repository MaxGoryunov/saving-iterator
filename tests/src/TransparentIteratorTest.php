<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\The;
use MaxGoryunov\SavingIterator\Src\TransparentIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\TransparentIterator
 */
class TransparentIteratorTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::current
     * @covers ::key
     * @covers ::valid
     * @covers ::rewind
     * @covers ::next
     * 
     * @uses MaxGoryunov\SavingIterator\Fakes\The
     * 
     * @small
     *
     * @return void
     */
    public function testBehavesAsIterator(): void
    {
        (new The(
            [
                "apples"      => 4,
                "bananas"     => 10,
                "oranges"     => 5,
                "tomatoes"    => 7,
                "watermelons" => 18,
                "plums"       => 3
            ],
            fn(array $greens) => $this->assertEquals(
                $greens,
                iterator_to_array(
                    new TransparentIterator(
                        new ArrayIterator($greens)
                    )
                )
            )
        ))->value();
    }
}