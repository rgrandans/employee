<?php
declare(strict_types=1);

namespace App\Dto\Employee\Response;

use JsonSerializable;

final readonly class EmployeeListDto implements JsonSerializable
{
    public function __construct(
        public array $list
    ){}

    public function jsonSerialize(): array
    {
        return $this->list;
    }
}
