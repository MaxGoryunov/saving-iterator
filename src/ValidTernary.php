<?php

namespace MaxGoryunov\SavingIterator\Src;

use Closure;
use Iterator;

/**
 * Class which checks whether the given iterator is valid and calls consequent
 * path if it is true and alternate path otherwise.
 */
final class ValidTernary implements Scalar
{
    /**
     * Ctor.
     *
     * @param Iterator $origin iterator which validity is checked.
     * @param Closure $cons    consequent path if iterator is valid.
     * @param Closure $alter   alternative path if iterator is not valid.
     */
    public function __construct(
        /**
         * Iterator which validity is checked.
         *
         * @var Iterator
         */
        private Iterator $origin,

        /**
         * Consequent path if iterator is valid.
         *
         * @var Closure
         */
        private Closure $cons,

        /**
         * Alternate path if iterator is not valid.
         *
         * @var Closure
         */
        private Closure $alter
    ) {
    }

    public function value(): mixed
    {
        if ($this->origin->valid()) {
            $path = $this->cons;
        } else {
            $path = $this->alter;
        }
        return $path($this->origin);
    }
}
