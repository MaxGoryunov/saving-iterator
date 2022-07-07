<?php

declare(strict_types=1);

namespace MaxGoryunov\SavingIterator\Fakes;

use Closure;

/**
 * Class for applying contexts to elements without changing them.
 *
 * @template T subject type
 *
 * @extends SurveyEnvelope<T, T>
 */
final class The extends SurveyEnvelope
{

    /**
     * Ctor.
     *
     * @phpstan-param T $subject
     *
     * @param mixed $subject repeating element.
     */
    public function __construct(mixed $subject) {
        parent::__construct(
            $subject,
            static function (mixed $subject, Closure $context): mixed {
                $context($subject);
                return $subject;
            }
        );
    }
}
