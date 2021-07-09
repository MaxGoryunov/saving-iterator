<?php

namespace MaxGoryunov\SavingIterator\Fakes;

class TimesCalled
{
    /**
     * Original object.
     * 
     * @var object
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
     * @param object $origin
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
    public function value(): int {
        return $this->times;
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments): mixed
    {
        if ($name === $this->method) {
            $this->times++;
        }

        if ($arguments === []) {
            $result = $this->origin->$name();
        } else {
            $result = $this->origin->$name($arguments);
        }
        return $result;
    }
}
