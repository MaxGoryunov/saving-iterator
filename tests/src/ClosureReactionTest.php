<?php

namespace MaxGoryunov\SavingIterator\Tests\Src;

use MaxGoryunov\SavingIterator\Src\ClosureReaction;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass MaxGoryunov\SavingIterator\Src\ClosureReaction
 */
final class ClosureReactionTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::edited
     *
     * @small
     *
     * @return void
     */
    public function testExecutesClosure(): void
    {
        $origin = new stdClass();
        $name   = "Jeff";
        $this->assertEquals(
            $name,
            (new ClosureReaction(
                function (stdClass $obj, string $method) use ($name) {
                    $obj->name = $name;
                    return $obj;
                }
            ))
                ->edited($origin, "name")
                ->name
        );
    }
}
