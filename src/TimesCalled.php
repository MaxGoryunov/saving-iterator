<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * This class checks how many times a specified method was called.
 * @template T of object
 * @mixin T
 * @implements Indifferent<T>
 * @todo #45:15min Class MaxGoryunov\SavingIterator\Src\TimesCalled implements
 *  generic interface MaxGoryunov\SavingIterator\Src\Scalar but does not
 *  specify its types: T 
 * @phpstan-ignore-next-line
 */
class TimesCalled implements Indifferent, Scalar
{
    /**
     * Original object.
     * 
     * @var T
     */
    private object $origin;

    /**
     * Method to pay attention to.
     * 
     * @var string
     */
    private string $method;

    /**
     * How many times the method was called.
     * 
     * @var int
     */
    private int $times = 0;

    /**
     * Ctor.
     *
     * @param T      $origin
     * @param string $method
     */
    public function __construct(object $origin, string $method)
    {
        $this->origin = $origin;
        $this->method = $method;
    }

    /**
     * Returns the number of calls to the specified method.
     *
     * @return int
     */
    public function value(): int
    {
        return $this->times;
    }

    /**
     * Sends calls through itself and counts how many times a specific method was called.
     * {@inheritDoc}
     */
    public function __call(string $name, array $arguments): mixed
    {
        if ($name === $this->method) {
            $this->times++;
        }
        return $this->origin->$name(...$arguments);
    }
}
