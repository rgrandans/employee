<?php

namespace App\Dto\Employee\Response;

use App\Enum\Gender;

final readonly class EmployeeDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $surname,
        public string $personalIdentityNumber,
        public Gender $gender,
        public string $phone,
        public string $email,
        public AddressDto $address
    ){}
}
