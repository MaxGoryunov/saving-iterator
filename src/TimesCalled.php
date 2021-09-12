<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * This class checks how many times a specified method was called.
 * @template T of object
 * @mixin T
 * @implements Indifferent<T>
 * @implements \MaxGoryunov\SavingIterator\Src\Scalar<int>
 */
class TimesCalled implements Indifferent, Scalar
{

    /**
     * Ctor.
     * 
     * @phpstan-param T $origin
     * @param object $origin original object.
     * @param Count  $count  how many times the method was called.
     * @param string $method method to pay attention to.
     */
    public function __construct(
        /**
         * Original object.
         *
         * @phpstan-var T
         * @var object
         */
        private object $origin,

        /**
         * How many times the method was called.
         *
         * @var Count
         */
        private Count $count,

        /**
         * MEthod to pay attention to.
         *
         * @var string
         */
        private string $method
    ) {
    }

    /**
     * Returns the number of calls to the specified method.
     *
     * @return int
     */
    public function value(): int
    {
        return $this->count->value();
    }

    /**
     * Sends calls through itself and counts how many times a specific method was called.
     * {@inheritDoc}
     */
    public function __call(string $name, array $arguments): mixed
    {
        if ($name === $this->method) {
            $this->count = $this->count->increment();
        }
        return $this->origin->$name(...$arguments);
    }
}
