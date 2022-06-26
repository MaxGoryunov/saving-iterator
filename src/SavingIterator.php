<?php

namespace MaxGoryunov\SavingIterator\Src;

use Iterator;

/**
 * Iterator which stores iterated values.
 * @template TKey
 * @template TValue
 * @extends IteratorEnvelope<TKey, TValue>
 */
final class SavingIterator extends IteratorEnvelope
{
    /**
     * Ctor.
     * 
     * @phpstan-param Iterator<TKey, TValue>       $origin
     * @phpstan-param AddingIterator<TKey, TValue> $target
     * @param Iterator       $origin original iterator.
     * @param AddingIterator $target iterator to which the values are saved.
     */
    public function __construct(
        Iterator $origin,
        AddingIterator $target
    ) {
        parent::__construct(
            /** @phpstan-ignore-next-line */
            new ContextVeil(
                $target,
                new ClosureReaction(
                    function (AddingIterator $stored) use ($origin) {
                        $res = $stored;
                        if ($origin->valid()) {
                            $res = $stored->from($origin);
                            $origin->next();
                        }
                        return $res;
                    }
                )
            )
        );
    }
}
