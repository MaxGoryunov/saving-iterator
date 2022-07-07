<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Iterator which stores iterated values.
 *
 * @template TKey
 * @template TValue
 *
 * @extends IteratorEnvelope<TKey, TValue>
 */
final class SavingIterator extends IteratorEnvelope
{
    /**
     * Ctor.
     *
     * @phpstan-param Iterator<TKey, TValue>       $origin
     * @phpstan-param AddingIterator<TKey, TValue> $target
     *
     * @param Iterator       $origin original iterator.
     * @param AddingIterator $target iterator to which the values are saved.
     */
    public function __construct(
        Iterator $origin,
        AddingIterator $target
    ) {
        parent::__construct(
            /**
             * @todo #179:30min Consider making ValidTernary a variable. Maybe
             *  it is possible to implement this with a constant expression.
             */
            /** @phpstan-ignore-next-line */
            new ContextVeil(
                $target,
                new ClosureReaction(
                    static function (AddingIterator $stored) use ($origin) {
                        return (new ValidTernary(
                            $origin,
                            static function (Iterator $source) use ($stored) {
                                $temp = $stored->from($source);
                                $source->next();
                                return $temp;
                            },
                            static fn () => $stored
                        ))->value();
                    }
                )
            )
        );
    }
}
