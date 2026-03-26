<?php
declare(strict_types=1);

namespace App\Dto\Employee\Response;

final readonly class EmployeeListItemDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $surname,
        public string $phone,
        public string $email
    ){}
}
