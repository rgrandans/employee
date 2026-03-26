<?php
declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Attribute;

#[Attribute]
class Phone extends Constraint
{
    public string $message = 'The phone number "{{ string }}" is not valid.';
    public string $mode = 'strict';

    public function __construct(?string $mode = null, ?string $message = null, ?array $groups = null, $payload = null)
    {
        $this->mode = $mode ?? $this->mode;
        $this->message = $message ?? $this->message;

        parent::__construct(null, $groups, $payload);
    }
}
