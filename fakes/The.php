<?php

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Class for applying contexts to elements without changing them.
 * @todo #92:30min Remove extension of SurveyEnvelope because it is not needed
 *  anymore.
 * @template T subject type
 * @extends SurveyEnvelope<T, T>
 * @implements Block<mixed>
 */
class The extends SurveyEnvelope implements Block
{

    /**
     * Subject for a context.
     *
     * @var mixed
     */
    private mixed $subject;

    /**
     * Ctor.
     *
     * @phpstan-param T                 $subject repeating element
     * @phpstan-param Closure(T): mixed $context context for element
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
        $this->subject = $subject;
    }

    /**
     * {@inheritDoc}
     */
    public function act(Closure $context): mixed
    {
        $context($this->subject);
        return $this->subject;
    }
}
