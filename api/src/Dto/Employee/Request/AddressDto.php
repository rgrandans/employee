<?php
declare(strict_types=1);

namespace App\Dto\Employee\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class AddressDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 100)]
        public string $countryCode,

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 100)]
        public string $city,

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 100)]
        public string $street,

        #[Assert\NotBlank]
        #[Assert\Length(min: 1, max: 10)]
        public string $streetNumber,

        #[Assert\NotBlank]
        #[Assert\Regex(pattern: "/^LV-\d{4}$/", message: "Invalid postal code format. It should start with 'LV-' followed by 4 digits.")]
        public string $postalCode
    ){}
}
