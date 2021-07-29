<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Allows to use context instead of creating a new variable.
 * 
 * @todo #44:25min Classes Let and The contain some repeated cdde which could
 *  be extracted into a separate class.
 */
class Let extends SurveyEnvelope
{

    /**
     * Ctor.
     *
     * @param mixed   $subject element to be put into context
     * @param Closure $context context for element
     */
    public function __construct(mixed $subject, Closure $context)
    {
        parent::__construct(
            $subject,
            $context,
            fn(mixed $subject, Closure $context): mixed => $context($subject)
        );
    }
}
