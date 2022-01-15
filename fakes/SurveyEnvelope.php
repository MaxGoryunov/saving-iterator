<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;
use MaxGoryunov\SavingIterator\Src\Scalar;

/**
 * Class for wrapping divergent program flows. It allows to structure a program
 * in such a way that there will be no need for a variable if it exists only in
 * order to be used in two places.
 * @template X subject type
 * @template Y result type
 * @implements Block<Y>
 */
abstract class SurveyEnvelope implements Block
{

    /**
     * Ctor.
     * 
     * @phpstan-param X                                $subject
     * @phpstan-param Closure(X, Closure(X): mixed): Y $usage
     * @param mixed   $subject element to be used in some context
     * @param Closure $usage   way of combining element and context
     */
    public function __construct(
        /**
         * Element to be used in some context.
         * 
         * @phpstan-var X
         * @var mixed
         */
        private mixed $subject,

        /**
         * way of combining element and context.
         * 
         * @phpstan-var Closure(X, Closure(X): mixed): Y
         * @var Closure
         */
        private Closure $usage
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public final function act(Closure $context): mixed
    {
        return ($this->usage)($this->subject, $context);
    }
}
