<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * Safe array iterator. Copies array when cloned.
 *
 * @template TKey
 * @template TValue
 *
 * @implements ArrayAccess<TKey, TValue>
 * @implements Iterator<TKey, TValue>
 *
 * @since 0.3
 */
final class SafeArrayIterator implements ArrayAccess, Countable, Iterator
{

    /**
     * Ctor.
     *
     * @phpstan-param array<TKey, TValue> $stored
     *
     * @param array<mixed, mixed> $stored array for stored values.
     */
    public function __construct(
        /**
         * Array for stored values.
         *
         * @phpstan-var array<TKey, TValue>
         *
         * @var array
         */
        private array $stored = []
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-param TKey   $offset
     * @phpstan-param TValue $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->stored[$offset] = $value;
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-param TKey $offset
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->stored[$offset];
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-param TKey $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->stored[$offset]);
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-param TKey $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->stored[$offset]);
    }

    public function count(): int
    {
        return count($this->stored);
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-return TValue|false
     */
    public function current(): mixed
    {
        return current($this->stored);
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-return TKey|null
     */
    public function key(): mixed
    {
        return key($this->stored);
    }

    public function next(): void
    {
        next($this->stored);
    }

    public function valid(): bool
    {
        return key($this->stored) !== null;
    }

    public function rewind(): void
    {
        reset($this->stored);
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-return array<TKey, TValue>
     */
    public function __serialize(): array
    {
        return $this->stored;
    }

    /**
     * {@inheritDoc}
     *
     * @phpstan-param array<TKey, TValue> $data data for deserialization
     */
    public function __unserialize(array $data): void
    {
        $this->stored = $data;
    }
}
