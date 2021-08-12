<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use Iterator;
use MaxGoryunov\SavingIterator\Src\BaseStorage;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\BaseStorage
 * @todo #66:30min Introduce a fake iterator class for testing.
 */
final class BaseStorageTest extends TestCase
{

    /**
     * @covers ::__Construct
     * @covers ::added
     * @covers ::value
     * 
     * @small
     *
     * @return void
     */
    public function testAddsValueFromIterator(): void
    {
        $input  = "value from iterator";
        $source = $this->getMockBuilder(Iterator::class)
            ->onlyMethods(["key", "current", "rewind", "next", "valid"])
            ->getMock();
        $source->expects($this->once())->method("valid")->willReturn(true);
        $source->expects($this->once())->method("key")->willReturn(0);
        $source->expects($this->once())->method("current")->willReturn($input);
        $this->assertEquals(
            $input,
            (new BaseStorage())->added($source)->value()
        );
    }

    /**
     * @covers ::__construct
     * @covers ::added
     * @covers ::key
     *
     * @return void
     */
    public function testAddsValueFromIteratorAtCorrectKey(): void
    {
        $key    = "test key";
        $source = $this->getMockBuilder(Iterator::class)
            ->onlyMethods(["key", "current", "rewind", "next", "valid"])
            ->getMock();
        $source->expects($this->once())->method("valid")->willReturn(true);
        $source->expects($this->once())->method("key")->willReturn($key);
        $source->expects($this->once())->method("current")->willReturn("101");
        $this->assertEquals(
            $key,
            (new BaseStorage())->added($source)->key()
        );
    }
}
