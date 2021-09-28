<?php

namespace MaxGoryunov\SavingIterator\Src;

use Closure;

/**
 * Veil which applies context to origin if the condition is met.
 * @template T of object origin type.
 * @implements Indifferent<T>
 * @mixin T
 */
final class ContextVeil implements Indifferent
{

    /**
     * Ctor.
     * 
     * @phpstan-param T                    $origin
     * @phpstan-param Closure(T): T        $context
     * @phpstan-param array<string, mixed> $methods
     * @param object               $origin  original element.
     * @param Closure              $context context for the element.
     * @param array<string, mixed> $methods methods on which the element must
     * be modified.
     */
    public function __construct(
        /**
         * Original element.
         *
         * @phpstan-var T
         * @var object
         */
        private object $origin,

        /**
         * Context for the element.
         * Modifies the element and returns the result.
         *
         * @phpstan-var Closure(T): T
         * @var Closure
         */
        private Closure $context,

        /**
         * Methods on which the element must be modified.\
         * Does not accept nulls as values.
         *
         * @var array<string, mixed>
         */
        private array $methods
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function __call(string $name, array $arguments): mixed
    {
        if (isset($this->methods[$name])) {
            $this->origin = ($this->context)($this->origin);
        }
        return $this->origin->$name(...$arguments);
    }
}
