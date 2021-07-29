<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Class for applying contexts to elements without changing them.
 * 
 * @todo #44:20min Classes Let and The do not have proper type hints in
 *  constructor and methods. Workarounds with `@var` tags must be removed
 *  after that. 
 */
class The extends SurveyEnvelope
{

    /**
     * Ctor.
     *
     * @param mixed $subject
     * @param Closure $context
     */
    public function __construct(mixed $subject, Closure $context)
    {
        parent::__construct(
            $subject,
            $context,
            function (mixed $subject, Closure $context): mixed
            {
                $context($subject);
                return $subject;
            }
        );
    }
}
