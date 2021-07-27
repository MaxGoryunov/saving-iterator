<?php

namespace MaxGoryunov\SavingIterator\Src;

/**
 * Scalar object.
 * @template T
 */
interface Scalar
{

    /**
     * Scalar's contained value.
     *
     * @return T
     */
    public function value(): mixed;
}
