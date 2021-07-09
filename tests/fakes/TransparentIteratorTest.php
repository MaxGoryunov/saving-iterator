<?php

namespace MaxGoryunov\SavingIterator\Tests\Fakes;

use ArrayIterator;
use MaxGoryunov\SavingIterator\Fakes\TransparentIterator;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Fakes
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
     * @small
     *
     * @return void
     */
    public function testBehavesAsIterator(): void
    {
        $input = [
            "apples"      => 4,
            "bananas"     => 10,
            "oranges"     => 5,
            "tomatoes"    => 7,
            "watermelons" => 18,
            "plums"       => 3
        ];
        $output = [];
        foreach (
            new TransparentIterator(
                new ArrayIterator($input)
            ) as $key => $value
        ) {
            $output[$key] = $value;
        }
        $this->assertEquals($input, $output);
    }
}