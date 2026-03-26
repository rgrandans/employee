<?php
declare(strict_types=1);

namespace App\Dto\Employee\Request;

use App\Enum\Gender;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class UpdateEmployeeRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public int $id,

        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 100)]
        public string $name,

        #[Assert\NotBlank]
        #[Assert\Length(min: 3, max: 100)]
        public string $surname,

        #[Assert\NotBlank]
        #[Assert\Regex(pattern: "/^\d{6}-\d{5}$/", message: "Invalid Personal Identity Number format")]
        public string $personalIdentityNumber,

        #[Assert\NotNull]
        #[Assert\Choice(choices: [Gender::MALE, Gender::FEMALE], message: "Invalid gender")]
        public Gender $gender,

        #[Assert\NotBlank]
        #[Assert\Regex(pattern: "/^\+?[1-9]\d{1,14}$/", message: "Invalid phone number format")]
        public string $phone,

        #[Assert\NotBlank]
        #[Assert\Email]
        #[Assert\Length(max: 200)]
        public string $email,

        #[Assert\Valid]
        public AddressDto $address
    ){}
}
