<?php

namespace MaxGoryunov\SavingIterator\Src;

use Closure;
use Iterator;

/**
 * Class which checks whether the given iterator is valid and calls consequent
 * path if it is true and alternate path otherwise.
 * @template T
 * @implements Scalar<T>
 */
final class ValidTernary implements Scalar
{
    /**
     * Ctor.
     *
     * @template TKey
     * @template TValue
     * @phpstan-param Iterator<TKey, TValue> $origin
     * @phpstan-param Closure(Iterator<TKey, TValue>):T $cons
     * @phpstan-param Closure(Iterator<TKey, TValue>):T $alter
     * @param Iterator $origin iterator which validity is checked.
     * @param Closure $cons    consequent path if iterator is valid.
     * @param Closure $alter   alternative path if iterator is not valid.
     */
    public function __construct(
        /**
         * Iterator which validity is checked.
         *
         * @phpstan-var Iterator<TKey, TValue>
         * @var Iterator
         */
        private Iterator $origin,

        /**
         * Consequent path if iterator is valid.
         *
         * @phpstan-var Closure(Iterator<TKey, TValue>):T
         * @var Closure
         */
        private Closure $cons,

        /**
         * Alternate path if iterator is not valid.
         *
         * @phpstan-var Closure(Iterator<TKey, TValue>):T
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
