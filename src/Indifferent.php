<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Interface for objects on which any methods can be called.
 * @template T of object
 * @mixin T
 * 
 * @todo #7:10min Add fakes directory back to infection.json.dist after fakes
 *  folder will be created
 */
interface Indifferent
{

    /**
     * Returns result of any called method.
     *
     * @param string       $name
     * @param array<mixed> $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments): mixed;
}
