<?php

namespace MaxGoryunov\SavingIterator\Src;

use ArrayAccess;

/**
 * Safe array iterator. Copies array when cloned.
 * @template TKey
 * @template TValue
 * @implements ArrayAccess<TKey, TValue>
 * 
 * @since 0.3
 */
final class SafeArrayIterator implements ArrayAccess
{

    /**
     * Ctor.
     * 
     * @phpstan-param array<TKey, TValue> $stored
     * @param array<mixed, mixed> $stored array for stored values.
     */
    public function __construct(
        /**
         * Array for stored values.
         *
         * @phpstan-var array<TKey, TValue>
         * @var array
         */
        private array $stored = []
    ) {
    }

    /**
     * {@inheritDoc}
     * @phpstan-param TKey   $offset
     * @phpstan-param TValue $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->stored[$offset] = $value;
    }

    /**
     * {@inheritDoc}
     * @phpstan-param TKey $offset
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->stored[$offset];
    }

    /**
     * {@inheritDoc}
     * @phpstan-param TKey $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->stored);
    }

    /**
     * {@inheritDoc}
     * @phpstan-param TKey $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->stored);
    }
}
